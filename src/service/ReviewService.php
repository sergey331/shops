<?php

namespace Shop\service;

use Exception;
use Kernel\Service\BaseService;
use Kernel\Validator\Validator;
use Shop\rules\ReviewRule;

class ReviewService extends BaseService
{
    /**
     * Create or update review
     * @throws Exception
     */
    public function save(): array
    {
        $data = request()->only(['book_id', 'rating', 'comment']);
        $userId = auth()->id();

        $validator = Validator::make($data,ReviewRule::rules());

        if (!$validator->validate()) {
            return $this->fail($validator->errors());
        }

        if (!$userId) {
            return $this->fail('unauthorized');
        }

        $data['user_id'] = $userId;


        model('Review')->create($data);

        $rating = $this->recalculateRating($data['book_id']);

        $this->updateBook($data['book_id'], $rating);

        return $this->success('review saved', $data['book_id']);
    }


    /**
     * @throws Exception
     */
    private function recalculateRating(int $bookId): float
    {
        $ratings =  model('Book')
            ->with(['reviews'])
            ->find($bookId)
            ->pluck('reviews.rating');
        if (empty($ratings)) {
            return 0;
        }

        return round(array_sum($ratings) / count($ratings), 2);
    }

    /**
     * @throws Exception
     */
    private function updateBook(int $bookId, float $rating): void
    {
        model('Book')
            ->where(['id' => $bookId])
            ->update(['rating' => $rating]);
    }

    /**
     * Optional WebSocket integration
     * @throws Exception
     */
    private function success(string $msg, $bookId): array
    {
        $reviews = model('Review')->where(['book_id' => $bookId])->orderBy('id','DESC')->get();
        return ['success' => true, 'message' => $msg, 'reviews_content' => view()->getHtml('Component.Book.Reviews',['reviews' => $reviews]), 'reviews_count' => count($reviews)];
    }

    private function fail(string|array $msg): array
    {
        return ['success' => false, 'messages' => $msg];
    }
}