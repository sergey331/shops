<?php

namespace Shop\service;

use Exception;
use Kernel\Service\BaseService;
use Kernel\Validator\Validator;
use Shop\rules\AboutRules;

class AboutService extends BaseService
{
    public function getAbout()
    {
        return model('about')->first();
    }

    /**
     * @throws Exception
     */
    public function modify()
    {
        $about = $this->getAbout();
        $data = request()->all();

        $validator = Validator::make($data, AboutRules::rules(), AboutRules::messages());

        if (!$validator->validate()) {
            session()->set('errors', $validator->errors());
            return false;
        }

        $data = $this->handleImageUpload("media_path",APP_PATH . '/public/uploads/about/',$data);

        if ($about) {
            $about->update($data);
        } else {
            model('about')->create($data);
        }

        session()->set('success', 'created');
        return true;
    }
}