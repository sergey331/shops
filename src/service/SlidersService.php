<?php

namespace Shop\service;

use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Slider;
use Shop\rules\SliderRules;

class SlidersService
{
    public function getSliders()
    {
        return model('slider')->with(['product'])->get();
    }

    public function getProducts()
    {
        return model('product')->get();
    }

    public function store()
    {
        $data = request()->all();

        $validator = Validator::make($data, SliderRules::rules(), SliderRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload($data);

        $data['is_show'] = isset($data['is_show']) ? 1 : 0;

        model('slider')->create($data);

        session()->set('success', 'created');
        return true;
    }

    public function update(Slider $slider)
    {
        $data = request()->all();
        $validator = Validator::make($data, SliderRules::rules(), SliderRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload($data);
        $data['is_show'] = isset($data['is_show']) ? 1 : 0;
        $slider->update($data);
        session()->set('success', 'updated');
        return true;
    }

    public function delete(Slider  $slider)
    {
        if ($slider->image_url) {
            $file = new File();
            $file->setPath(APP_PATH . '/public/uploads/sliders/');
            $file->delete($slider->image_url);
        }
        $slider->delete();
        session()->set('success', 'deleted');
        return true;
    }

    private function handleImageUpload(array $data): array
    {

        if (request()->hasFile('image_url')) {
            $uploader = new File();
            $uploader->setFile(request()->file('image_url'));
            $uploader->setPath(APP_PATH . '/public/uploads/sliders/');

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