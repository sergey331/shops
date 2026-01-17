<?php

namespace Shop\service;

use Kernel\Form\Form;
use Shop\model\Slider;
use Kernel\Table\Table;
use Shop\rules\SliderRules;
use Kernel\Validator\Validator;
use Kernel\Service\BaseService;

class SlidersService extends BaseService
{
    public function getSliders()
    {
        $sliders = model('slider')->paginate();
        return [
            'sliders' => $sliders,
            'tableData' => $this->getTableData($sliders)
        ];
    }

    public function getForms($url,?Slider $slider = null) 
    {
        $errors = session()->getCLean('errors') ?? [];
        $form  = new Form($url,'POST', ['enctype' => 'multipart/form-data'],$errors);
        $form->setInput('title','Title',[
            'class' => 'form-control',
            'value' => $slider->title ?? ''
        ]);
        $form->setTextarea('content','Content',[
            'class' => 'form-control',
            'value' => $slider->content ?? ''
        ]);
        $form->setFile('image_url','Image',[
            'class' => 'form-control'
        ]);
        $form->setCheckbox('is_show','Show',[
            'class' => 'form-check-input',
            'checked' => (bool) $slider->is_show,
            'value' => 1
        ]);
        return $form;
    }

    public function store()
    {
        $data = request()->all();

        $validator = Validator::make($data, SliderRules::rules(), SliderRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload('image_url',APP_PATH . '/public/uploads/sliders',$data);

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

        $data = $this->handleImageUpload('image_url',APP_PATH . '/public/uploads/sliders',$data);
        $data['is_show'] = isset($data['is_show']) ? 1 : 0;
        $slider->update($data);
        session()->set('success', 'updated');
        return true;
    }

    public function delete(Slider  $slider)
    {
        if ($slider->image_url) {
            $this->deleteImage($slider->image_url,APP_PATH . '/public/uploads/sliders');
        }
        $slider->delete();
        session()->set('success', 'deleted');
        return true;
    }

    private function getTableData($sliders): Table
    {
        $table = new Table($sliders->data,[
            "#" => ['field' => 'id'],
            "Title" => ['field' => 'title'],
            "Content" => ['field' => 'content'],
            "Image" => ['field' => 'image_url','data' => ['type' => 'image','path' => "/uploads/sliders"]],
            "Actions" => [
                'callback' => function($row) {
                    $id = $row->id;
                    return '
                        <a href="/admin/sliders/'.$id.'" class="btn btn-sm btn-primary">Edit</a>
                        <a href="/admin/sliders/delete/'.$id.'" class="btn btn-sm btn-danger">Delete</a>
                    ';
                }
            ]
        ]);

        $table
            ->setTableAttributes(['class' => 'table']);
        return $table;
    }
}