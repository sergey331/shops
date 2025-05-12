<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\File\File;
use Kernel\Validator\Validator;

class CategoryController extends BaseController
{
    public function index(): void
    {
        $this->view()->load('Admin.Category.Index', [
            'categories' => $this->model('Category')->all(),
        ], 'admin');
    }

    public function create(): void
    {
        $this->view()->load('Admin.Category.Create', [
            'categories' => $this->model('Category')->all(),
        ], 'admin');
    }

    public function store(): void
    {
        $data = $this->request()->all();

        $validator = Validator::make($data, $this->rules(), $this->messages());

        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }

        $data = $this->handleAvatarUpload($data);
        $this->cleanCategoryId($data);

        $this->model('Category')->create($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/categories');
    }

    public function edit($id) 
    {
        $this->view()->load('Admin.Category.Edit', [
            'category' => $this->model('Category')->find($id), 
            'categories' => $this->model('Category')->all(),
        ], 'admin');
     }

     public function update($id)
     {
        $data = $this->request()->all();
        $validator = Validator::make($data, $this->rules(), $this->messages());

        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }

        $data = $this->handleAvatarUpload($data);
        $this->cleanCategoryId($data);

        $this->model('Category')->find($id)->update($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/categories');
     }

     public function delete($id)
     {
        $this->model('Category')->find($id)->delete();

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/categories');
     }

    private function rules(): array
    {
        return [
            'name'        => 'required',
            'description' => 'required|min:3',
            'avatar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    private function messages(): array
    {
        return [
            'name.required'        => 'Category name is required',
            'description.required' => 'Description is required',
            'avatar.image'         => 'Avatar must be an image',
            'avatar.mimes'         => 'Avatar must be a file of type: jpeg, png, jpg, gif',
            'avatar.max'           => 'Avatar must not exceed 2MB',
        ];
    }

    private function handleAvatarUpload(array $data): array
    {
        if ($this->request()->hasFile('avatar')) {
            $uploader = new File();
            $uploader->setFile($this->request()->file('avatar'));
            $uploader->setPath(APP_PATH . '/public/uploads/category/');

            if ($uploader->upload()) {
                $data['avatar'] = $uploader->getName();
            }
        }

        return $data;
    }

    private function cleanCategoryId(array &$data): void
    {
        if (empty($data['category_id'])) {
            unset($data['category_id']);
        }
    }
}
