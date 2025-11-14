<?php

namespace Shop\service;

use Exception;
use Kernel\File\File;
use Kernel\Validator\Validator;
use Shop\model\Slider;
use Shop\rules\AboutRules;
use Shop\rules\SliderRules;

class AboutService
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

        $data = $this->handleImageUpload($data);

        if ($about) {
            $about->update($data);
        } else {
            model('about')->create($data);
        }

        session()->set('success', 'created');
        return true;
    }


    /**
     * @throws Exception
     */
    private function handleImageUpload(array $data): array
    {

        if (request()->hasFile('media_path')) {
            $uploader = new File();
            $uploader->setFile(request()->file('media_path'));
            $uploader->setPath(APP_PATH . '/public/uploads/about/');

            if ($uploader->upload()) {
                $data['media_path'] = $uploader->getName();
                $data['media_type'] = $uploader->getFileCategory() ?? 'image';
            }
        } else {
            if (isset($data['media_path'])) {
                unset($data['media_path']);
            }
        }
        return $data;
    }
}