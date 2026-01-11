<?php

namespace Shop\service;

use Kernel\File\File;
use Kernel\Form\Form;
use Kernel\Service\BaseService;
use Kernel\Table\Table;
use Shop\model\Category;
use Shop\rules\CategoryRules;
use Kernel\Validator\Validator;

class CategoryService extends BaseService
{
    public function getCategories()
    {
        $data = model('category')->paginate();
        return ['tableData' => $this->getTableData($data),'categories' => $data];
    }

    public function getForms($url, ?Category $category = null) 
    {
        
        $errors = session()->getCLean('errors') ?? [];
        $form  = new Form($url,'POST', ['enctype' => 'multipart/form-data'],$errors);
        $form->setInput('name','Name', [
            'class' => 'form-control',
            'value' => $category->name ?? ''
        ]);
        $form->setInput('description','Description', [
            'class' => 'form-control',
            'value' => $category->description ?? ''
        ]);
        

        $form->setFile('logo','Logo', [
            'class' => 'form-control',
        ]);

        return $form;
    }

    public function store()
    {
        $data = request()->all();

        $validator = Validator::make($data, CategoryRules::rules(), CategoryRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload("logo",APP_PATH . '/public/images/categories/',$data);

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

        $data = $this->handleImageUpload("logo",APP_PATH . '/public/images/categories/',$data);
        $category->update($data);
        session()->set('success', 'updated');
        return true;
    }

    public function delete(Category $category)
    {
        if ($category->logo) {
            $this->deleteImage("logo",APP_PATH . '/public/images/categories/');
        }
        $category->delete();
        session()->set('success', 'deleted');
        return true;
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