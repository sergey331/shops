<?php

namespace Shop\service;

use Exception;
use Shop\model\Book;
use Kernel\Form\Form;
use Kernel\Table\Table;
use Kernel\Databases\DB;
use Shop\model\BookImage;
use Shop\rules\BookRules;
use Kernel\Service\BaseService;
use Kernel\Validator\Validator;
use Shop\rules\BookEditRules;
use Shop\rules\BookDiscountRules;

class BooksService extends BaseService
{

    /**
     * @throws Exception
     */
    public function getFilteredBooks()
    {
        $query = model('Book');
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->whereLike([
                'title' => "%$search%"
            ])->orWhereLike([
                'slug' => "%$search%"
            ])->orWhereLike([
                'isbn' => "%$search%"
            ]);
        }

        if (request()->has('categories')) {
            $categories = request()->input('categories');
            $query->whereHas('categories',function ($q) use ($categories) {
                $q->whereIn(['categories.id' => $categories]);
            });
        }

        if (request()->has('authors')) {
            $authors = request()->input('authors');
            $query->whereHas('authors',function ($q) use ($authors) {
                $q->whereIn(['authors.id' => $authors]);
            });
        }

        if (request()->has('tags')) {
            $tags = request()->input('tags');
            $query->whereHas('tags',function ($q) use ($tags) {
                $q->whereIn(['tags.id' => $tags]);
            });
        }

        return $query->paginate();
    }
    public function getBooks()
    {
        $books = model('Book')->with(['publisher', 'authors', 'categories'])->paginate();
        return [
            'books' => $books,
            'tableData' => $this->getTableData($books)
        ];
    }

    public function getForms(string $url, ?Book $book = null)
    {
        $errors = session()->getCLean('errors') ?? [];
        $form = new Form($url, 'POST', ['enctype' => 'multipart/form-data', "class" => 'form-html'], $errors);

        $form->setInput('title', 'Title', [
            'class' => 'form-control',
            'value' => $book->title ?? ''
        ]);
        $form->setInput('slug', 'Slug', [
            'class' => 'form-control',
            'value' => $book->slug ?? ''
        ]);

        $form->setNumber('price', 'Price', [
            'class' => 'form-control',
            'value' => $book->price ?? ''
        ]);

        $form->setSelect('currency_id', 'Currency', model('Currency')->get(), [
            'class' => 'form-control',
            'option_default_label' => "Select Currency",
            'value' => $book->currency_id ?? ''
        ]);

        $form->setInput('isbn', 'Isbn', [
            'class' => 'form-control',
            'value' => $book->isbn ?? ''
        ]);

        $form->setNumber('pages', 'Pages', [
            'class' => 'form-control',
            'value' => $book->pages ?? ''
        ]);


        $form->setFile('cover_image', 'Cover Image', [
            'class' => 'form-control'
        ]);

        $form->setFile('images', 'Images', [
            'class' => 'form-control',
            'multiple' => 'multiple',
        ]);

        $form->setTextarea('description', 'Description', [
            'class' => 'form-control',
            'value' => $book->description ?? ''
        ]);

        $form->setSelect('publisher_id', 'Publisher', model('Publisher')->get(), [
            'class' => 'form-control',
            'option_default_label' => "Select Publishor",
            'value' => $book->publisher_id ?? ''
        ]);

        $form->setSelect('language_id', 'Language', model('Language')->get(), [
            'class' => 'form-control',
            'option_default_label' => "Select Language",
            'value' => $book->language_id ?? ''
        ]);

        $form->setSelect(
            'status',
            'Status',
            Book::STATUS,
            [
                'class' => 'form-control',
                'option_default_label' => "Set Status",
                'value' => $book->status ?? ''
            ]
        );

        $form->setDate('publication_date', 'Publication Date', [
            'class' => 'form-control',
            'value' => $book->publication_date ?? ''
        ]);

        $form->setSelect(
            'author_id',
            'Author',
            model('Author')->get(),
            [
                'class' => 'form-control',
                'multiple' => 'multiple',
                'value' => $book ? $book->pluck('authors.id') ?? [] : []
            ]
        );

        $form->setSelect(
            'category_id',
            'Categories',
            model('category')->get(),
            [
                'class' => 'form-control',
                'multiple' => 'multiple',
                'value' => $book ? $book->pluck('categories.id') ?? [] : []
            ]
        );

        $form->setSelect(
            'tag_id',
            'Tags',
            model('tag')->get(),
            [
                'class' => 'form-control',
                'multiple' => 'multiple',
                'value' => $book ? $book->pluck('tags.id') ?? [] : []
            ]
        );

        $form->setCheckbox('stock', 'Stock', [
            'class' => 'form-check-input',
            'checked' => (bool) ($book?->stock ?? false),

            'value' => 1
        ]);
        $form->setCheckbox('featured', 'Featured', [
            'class' => 'form-check-input',
            'checked' => (bool) ($book?->featured ?? false),
            'value' => 1
        ]);

        return $form;
    }

    public function updateOrCreate(?Book $book = null): bool
    {
        $data = request()->all();
        $rules = $book ? BookEditRules::rules() : BookRules::rules();

        $validator = Validator::make($data, $rules);
        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        // Paths
        $basePath = APP_PATH . '/public/uploads/books';
        $bookPath = $book ? $basePath . '/' . $book->id : $basePath;

        // Remove old cover image if updating
        if (
            $book &&
            request()->hasFile('cover_image') &&
            !empty($book->cover_image)
        ) {
            $oldImage = $bookPath . '/' . $book->cover_image;
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        // Upload cover image
        $data = $this->handleImageUpload('cover_image', $bookPath, $data);

        // Extract relations
        $authors    = $data['author_id']   ?? [];
        $categories = $data['category_id'] ?? [];
        $tags       = $data['tag_id']      ?? [];
        $images     = is_array($data['images'] ?? null) ? $data['images'] : [];

        // Remove non-book fields
        unset(
            $data['author_id'],
            $data['category_id'],
            $data['tag_id'],
            $data['images']
        );

        // Normalize booleans
        $data['stock']    = !empty($data['stock']) ? 1 : 0;
        $data['featured'] = !empty($data['featured']) ? 1 : 0;

        if (!$book) {
            // Create
            $book = model('Book')->create($data);

            $newPath = $basePath . '/' . $book->id;
            if (!is_dir($newPath)) {
                mkdir($newPath, 0755, true);
            }

            if (!empty($data['cover_image'])) {
                rename(
                    $basePath . '/' . $data['cover_image'],
                    $newPath . '/' . $data['cover_image']
                );
            }
        } else {
            // Update
            $book->update($data);
            DB::table('book_author')->where(['book_id' =>  $book->id])->delete();
            DB::table('book_category')->where(['book_id' =>  $book->id])->delete();
            DB::table('book_tag')->where(['book_id' =>  $book->id])->delete();
        }

        // Save relations & images
        $this->saveRelatedTable($book, $authors, $categories, $tags);
        $this->upload_images($images, $book->id);

        return true;
    }

    public function removeImage(BookImage $bookImage)
    {
        if ($bookImage->image_path) {
            $this->deleteImage($bookImage->image_path, APP_PATH . '/public/uploads/books/images');
        }
        $bookImage->delete();
        return true;
    }

    public function imageStore()
    {
        $data = request()->all();
        $this->upload_images($data['images'], $data['book_id']);

        return model('BookImage')->where(['book_id' => $data['book_id']])->get();
    }

    public function discount(Book $book)
    {

        $data = request()->all();
        $validator = Validator::make($data, BookDiscountRules::rules());

        if (!$validator->validate()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }

        if ($book->discount) {
            $book->discount->update(request()->all());
        } else {
            $book->discount()->create(request()->all());
        }
        return [
            'success' => true,
            'discount' => $book->discount()->get()
        ];
    }

    public function deleteBook(Book $book)
    {
        $this->deleteDir(APP_PATH . '/public/uploads/books/' . $book->id);
        $book->delete();
        return true;
    }

    private function upload_images(array $images, $book_id)
    {
        foreach ($images as $image) {
            $imageName = $this->handleImageUpload($image, APP_PATH . '/public/uploads/books/' . $book_id . '/images');
            DB::table('book_images')->create([
                'book_id' => $book_id,
                'image_path' => $imageName
            ]);
        }
    }
    private function saveRelatedTable($book, $authors, $categories, $tags): void
    {
        foreach ($authors as $author) {
            DB::table('book_author')->create([
                'book_id' => $book->id,
                'author_id' => $author
            ]);
        }
        foreach ($categories as $category) {
            DB::table('book_category')->create([
                'book_id' => $book->id,
                'category_id' => $category
            ]);
        }

        foreach ($tags as $tag) {
            DB::table('book_tag')->create([
                'book_id' => $book->id,
                'tag_id' => $tag
            ]);
        }
    }

    private function getTableData($books)
    {
        $table = new Table($books->data, [
            "#" => ['field' => 'id'],
            "Title" => ['field' => 'title'],
            "Slug" => ['field' => 'slug'],
            "Description" => ['field' => 'description'],
            "Isbn" => ['field' => 'isbn'],
            "Language" => ['field' => 'language.name'],
            "Pages" => ['field' => 'pages'],
            "Price" => ['field' => 'price'],
            'Currency' => ['field' => 'currency.code'],
            "Publisher" => ['field' => 'publisher.name'],
            "Authors" => ['field' => 'authors.*.name'],
            "Categories" => ['field' => 'categories.*.name'],
            "Status" => ['field' => 'status'],
            "Actions" => [
                'callback' => function ($row) {
                    $id = $row->id;
                    return '
                        <div class="d-flex gap-1">
                            <a href="/admin/books/' . $id . '" class="btn btn-sm btn-primary text-white">Edit</a>
                            <form action="/admin/books/delete/' . $id . '" method="POST"> 
                            <button type="submit"  class="btn btn-sm btn-danger">Delete</button>
                            </form> 
                            <a href="/admin/books/show/' . $id . '" class="btn btn-sm btn-primary text-white">Show</a>
                        </div>    
                    ';
                },
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}
