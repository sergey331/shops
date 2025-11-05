<?php

namespace Shop\service;

use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Post;
use Shop\rules\PostRules;

class PostsService
{
    public function getPosts()
    {
        return model('post')->get();
    }

    public function store()
    {
        $data = request()->all();

        $validator = Validator::make($data, PostRules::rules(), PostRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload($data);

        model('post')->create($data);

        session()->set('success', 'created');
        return true;
    }

    public function update(Post $post)
    {
        $data = request()->all();
        $validator = Validator::make($data, PostRules::rules(), PostRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload($data);
        $post->update($data);
        session()->set('success', 'updated');
        return true;
    }

    public function delete(Post $post)
    {
        if ($post->image) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/uploads/posts/');
            $file->delete($post->image);
        }
        $post->delete();
        session()->set('success', 'deleted');
        return true;
    }

    private function handleImageUpload(array $data): array
    {

        if (request()->hasFile('image')) {
            $uploader = new File();
            $uploader->setFile(request()->file('image'));
            $uploader->setPath(APP_PATH . '/public/uploads/posts/');

            if ($uploader->upload()) {
                $data['image'] = $uploader->getName();
            }
        } else {
            if (isset($data['image'])) {
                unset($data['image']);
            }
        }
        return $data;
    }
}