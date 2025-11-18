<?php

namespace Shop\service;

use Kernel\File\File;
use Kernel\Table\Table;
use Kernel\Validator\Validator;
use Shop\model\Category;
use Shop\rules\CategoryRules;

class CategoryService
{
    public function getCategories()
    {
        $data = model('category')->paginate();
        return ['tableData' => $this->getTableData($data),'categories' => $data];
    }

    public function store()
    {
        $data = request()->all();

        $validator = Validator::make($data, CategoryRules::rules(), CategoryRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload($data);

        model('category')->create($data);

        session()->set('success', 'created');
        return true;
    }

    public function update(Category $category)
    {
        $data = request()->all();
        $validator = Validator::make($data, CategoryRules::rules(), CategoryRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload($data);
        $category->update($data);
        session()->set('success', 'updated');
        return true;
    }

    public function delete(Category $category)
    {
        if ($category->logo) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/images/categories/');
            $file->delete($category->logo);
        }
        $category->delete();
        session()->set('success', 'deleted');
        return true;
    }

    private function handleImageUpload(array $data): array
    {

        if (request()->hasFile('logo')) {
            $uploader = new File();
            $uploader->setFile(request()->file('logo'));
            $uploader->setPath(APP_PATH . '/public/images/categories/');

            if ($uploader->upload()) {
                $data['logo'] = $uploader->getName();
            }
        } else {
            if (isset($data['logo'])) {
                unset($data['logo']);
            }
        }
        return $data;
    }

    private function getTableData($categories)
    {
        $table = new Table($categories->data,[
            "#" => ['field' => 'id'],
            "Name" => ['field' => 'name'],
            "Description" => ['field' => 'description'],
            "Logo" => ['field' => 'logo','data' => ['type' => 'image','path' => "/images/categories"]],
            "Actions" => [
                'callback' => function($row) {
                    $id = $row->id;
                    return '
                        <a href="/admin/categories/'.$id.'" class="btn btn-sm btn-primary">Edit</a>
                        <a href="/admin/categories/delete/'.$id.'" class="btn btn-sm btn-danger">Delete</a>
                    ';
                }
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}