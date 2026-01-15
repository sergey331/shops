<?php

namespace Shop\service;

use Kernel\Service\BaseService;
use Shop\model\Post;
use Kernel\Form\Form;
use Kernel\Table\Table;
use Shop\rules\PostRules;
use Kernel\Validator\Validator;
use Shop\rules\PostUpdateRules;
use Shop\rules\PostCommentRules;

class PostsService extends BaseService
{
    public function getPosts()
    {

        $posts =  model('post')->with(['category','tags'])->paginate();
        return [
            'posts' => $posts,
            'tableData' => $this->getTableData($posts)
        ];
    }

    public function getForms($url, ?Post $post = null) 
    {
        
        $errors = session()->getCLean('errors') ?? [];
        $form  = new Form($url,'POST', ['enctype' => 'multipart/form-data',"class" => 'form-html'],$errors);
        $form->setInput('title','Title', [
            'class' => 'form-control',
            'value' => $post->title ?? ''
        ]);
        $form->setInput('slug','Slug', [
            'class' => 'form-control',
            'value' => $post->slug ?? ''
        ]);
        
        $form->setSelect('status','Status',
        Post::STATUS, 
        [
            'class' => 'form-control',
            'value' => $post->status ?? ''
        ]);
        $form->setFile('image','Image', [
            'class' => 'form-control',
        ]);
        $form->setTextarea('content','Content',[
            'class' => 'form-control',
            'value' => $post->content ?? ''
        ]);
        $form->setTextarea('excerpt','Excerpt',[
            'class' => 'form-control',
            'value' => $post->content ?? ''
        ]);
        $form->setInput('published_at','Published at', [
            'class' => 'form-control',
            'value' => $post->published_at ?? ''
        ]);
        $form->setInput('meta_title','Meta title', [
            'class' => 'form-control',
            'value' => $post->meta_title ?? ''
        ]);

         $form->setTextarea('meta_description','Meta description',[
            'class' => 'form-control',
            'value' => $post->meta_description ?? ''
        ]);

        $form->setSelect('category_id','Category',
        model('category')->get(), 
        [
            'class' => 'form-control',
            'value' => $post->category_id ?? ''
        ]);

        $form->setSelect('tag_id','Tags',
        model('tag')->get(), 
        [
            'class' => 'form-control',
            'multiple' => 'multiple',
            'value' => $post ? $post->pluck('tags.id') ?? [] : []
        ]);

        return $form;
    }

    public function getFilteredPosts()
    {
        $posts = model('post')->with(['category']);

        $filteredData = [];
        if (request()->has('search')) {
            $search = request()->input('search');
            $posts->whereLike([
                'title' => "%$search%"
            ])->orWhereHas('category', function ($e) use ($search) {
                return $e->whereLike(['categories.name' => "%$search%"]);
            })->orWhereHas('tags', function ($e) use ($search) {
                return $e->whereLike(['tags.name' => "%$search%"]);
            });
            $filteredData['search'] = $search;
        }
        if (request()->has('category_id')) {
            $category_id = request()->get('category_id');
           $posts->whereHas('category', function ($e) use ($category_id) {
                return $e->where(['id' => $category_id]);
            });
            $filteredData['category_id'] = $category_id;
        }
        if (request()->has('tags_id')) {
            $tags_id = request()->get('tags_id');
            $posts->whereHas('tags', function ($e) use ($tags_id) {
                return $e->whereIn(['tags.id' => (array)$tags_id]);
            });
            $filteredData['tags_id'] = $tags_id;
        }


        $posts = $posts->paginate()->appends($filteredData);
        return [$posts,$filteredData];
    }

    public function writeComment(Post $post)
    {
        $data = request()->all();
        $data['user_id'] = auth()->id();
        $validator = Validator::make($data, PostCommentRules::rules(), PostCommentRules::messages());
        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
        } else {
            $post->comments()->create($data);
        }
    }

    public function store()
    {
        $data = request()->all();

        $validator = Validator::make($data, PostRules::rules(), PostRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }
        $tag_ids = [];
        if (isset($data['tag_id'])) {
            $tag_ids = $data['tag_id'];
            unset($data['tag_id']);
        }

        $data = $this->handleImageUpload("image",APP_PATH . '/public/uploads/posts',$data);

        if ($post = model('post')->create($data)) {
            foreach ($tag_ids as $tag_id) {
                model('PostTag')->create([
                    'post_id' => $post->id,
                    'tag_id' => $tag_id
                ]);
            }
        }
        session()->set('success', 'created');
        return true;
    }

    public function update(Post $post)
    {
        $data = request()->all();
        $validator = Validator::make($data, PostUpdateRules::rules(), PostUpdateRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $tag_ids = [];
        if (isset($data['tag_id'])) {
            $tag_ids = $data['tag_id'];
            unset($data['tag_id']);
        }

        model('PostTag')->where(['post_id' => $post->id])->delete();



        $data = $this->handleImageUpload("image",APP_PATH . '/public/uploads/posts',$data);
        $post->update($data);


            foreach ($tag_ids as $tag_id) {
                model('PostTag')->create([
                    'post_id' => $post->id,
                    'tag_id' => $tag_id
                ]);
            }

        session()->set('success', 'updated');
        return true;
    }

    public function delete(Post $post)
    {
        if ($post->image) {
            $this->deleteImage("image",APP_PATH . '/public/uploads/posts/');
        }
        $post->delete();
        session()->set('success', 'deleted');
        return true;
    }

    private function getTableData($posts): Table
    {
        $table = new Table($posts->data,[
            "#" => ['field' => 'id'],
            "Title" => ['field' => 'title'],
            "Slug" => ['field' => 'slug'],
            "Content" => ['field' => 'content'],
            "Excerpt" => ['field' => 'excerpt'],
            "Tags" => ['field' => 'tags.*.name'],
            "Categories" => ['field' => 'category.name'],
            "Status" => ['field' => 'status'],
            "Image" => ['field' => 'image','data' => ['type' => 'image','path' => "/uploads/posts"]],
            "Actions" => [
                'callback' => function($row) {
                    $id = $row->id;
                    return '
                        <a href="/admin/posts/'.$id.'" class="btn btn-sm btn-primary">Edit</a>
                        <a href="/admin/posts/delete/'.$id.'" class="btn btn-sm btn-danger">Delete</a>
                    ';
                }
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}