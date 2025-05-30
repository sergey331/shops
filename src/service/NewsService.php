<?php

namespace Shop\service;

use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\News;
use Shop\rules\NewsRules;

class NewsService
{
    public function getNews()
    {
        return model('news')->get();
    }

    public function store()
    {
        $data = request()->all();

        $validator = Validator::make($data, NewsRules::rules(), NewsRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload($data);

        $data['is_published'] = isset($data['is_published']) ? 1 : 0;

        model('news')->create($data);

        session()->set('success', 'created');
        return true;
    }

    public function update(News $new)
    {
        $data = request()->all();
        $validator = Validator::make($data, NewsRules::rules(), NewsRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload($data);
        $data['is_published'] = isset($data['is_published']) ? 1 : 0;
        $new->update($data);
        session()->set('success', 'updated');
        return true;
    }

    public function delete(News $new)
    {
        if ($new->image_url) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/uploads/news/');
            $file->delete($new->image_url);
        }
        $new->delete();
        session()->set('success', 'deleted');
        return true;
    }

    private function handleImageUpload(array $data): array
    {

        if (request()->hasFile('image_url')) {
            $uploader = new File();
            $uploader->setFile(request()->file('image_url'));
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