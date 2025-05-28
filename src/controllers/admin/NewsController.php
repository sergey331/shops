<?php

namespace Shop\controllers\admin;

use Kernel\Controller\BaseController;
use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Category;
use Shop\model\News;
use Shop\rules\CategoryRules;
use Shop\rules\NewsRules;

class NewsController extends BaseController
{
    public function index(): void
    {
        $this->view()->load('Admin.News.Index', [
            'news' => $this->model('news')->get(),
        ], 'admin');
    }

    public function create(): void
    {

        $this->view()->load('Admin.News.Create', [], 'admin');
    }

    public function store(): void
    {
        $data = $this->request()->all();

        $validator = Validator::make($data, NewsRules::rules(), NewsRules::messages());

        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }

        $data = $this->handleImageUpload($data);

        $data['is_published'] = isset($data['is_published']) ? 1 : 0;

        $this->model('news')->create($data);

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/news');
    }

    public function edit(News $new)
    {
        $this->view()->load('Admin.News.Edit', [
            'new' => $new,
        ], 'admin');
    }

    public function update(News $new)
    {
        $data = $this->request()->all();
        $validator = Validator::make($data, NewsRules::rules(), NewsRules::messages());

        if (!$validator->validate()) {
            $this->session()->set('errors', $validator->errors());
            $this->redirect()->back();
            return;
        }

        $data = $this->handleImageUpload($data);
        $data['is_published'] = isset($data['is_published']) ? 1 : 0;
        $new->update($data);
        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/news');
    }

    public function delete(News $new)
    {
        if ($new->image_url) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/uploads/news/');
            $file->delete($new->image_url);
        }
        $new->delete();

        $this->session()->set('success', 'created');
        $this->redirect()->to('/admin/news');
    }

    private function handleImageUpload(array $data): array
    {

        if ($this->request()->hasFile('image_url')) {
            $uploader = new File();
            $uploader->setFile($this->request()->file('image_url'));
            $uploader->setPath(APP_PATH . '/public/uploads/news/');

            if ($uploader->upload()) {
                $data['image_url'] = $uploader->getName();
            }
        } else {
            if (isset($data['image_url'])) {
                unset($data['image_url']);
            }
        }
        return $data;
    }
}
