<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\Validator\Validator;

class CategoryController extends BaseController
{
    public function index()
    {
        $this->view()->load('Admin.Category.Index',[
            'categories' => $this->model('Category')->all(),
        ],'admin');
    }
    public function create()
    {
        $this->view()->load('Admin.Category.Create',[
            'categories' => $this->model('Category')->all(),
        ],'admin');
    }

    public function store()
    {
        $data = $this->request()->all();

        $rules = [
            'name' => 'required',
            'description' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        $messages = [
            'name.required' => 'Category name is required',
            'description.required' => 'Description is required',
            'avatar.image' => 'Avatar must be an image',
            'avatar.mimes' => 'Avatar must be a file of type: jpeg, png, jpg, gif',
            'avatar.max' => 'Avatar must not exceed 2MB',
        ];
        $validator = Validator::make(
            $data,
            $rules,
            $messages
        );

        dd($validator->validate(),$validator->errors());
    }
}