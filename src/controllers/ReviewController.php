<?php

namespace Shop\controllers;

use Exception;
use Kernel\Controller\BaseController;
use Shop\service\ReviewService;

class ReviewController extends BaseController
{

    private ReviewService $reviewService;
    public function __construct()
    {
        $this->reviewService = new ReviewService();
    }

    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->response()->json($this->reviewService->save());
    }
}