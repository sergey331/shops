<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;

class ContactController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->view()->load('Contact.Index', [
            'title' => 'Contact',
        ]);

    }
}