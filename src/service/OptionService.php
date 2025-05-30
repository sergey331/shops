<?php

namespace Shop\service;

use Kernel\Validator\Validator;
use Shop\model\Option;
use Shop\rules\OptionRule;

class OptionService
{
    public function getNews()
    {
        return model('option')->get();
    }

    public function store()
    {
        $data = request()->all();
        $validator = Validator::make($data, OptionRule::rules(), OptionRule::messages());
        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }
        $data['price'] = $data['price'] !== '' ? $data['price'] : null;
        model('option')->create($data);

        session()->set('success', 'created');
        return true;
    }

    public function update(Option $option)
    {
        $data = request()->all();
        $validator = Validator::make($data, OptionRule::rules(), OptionRule::messages());
        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }
        $data['price'] = $data['price'] !== '' ? $data['price'] : null;
        $option->update($data);

        session()->set('success', 'updated');
        return true;
    }
}