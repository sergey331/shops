<?php

namespace Kernel\Order;

use Exception;

class OrderResponse
{
    /**
     * @throws Exception
     */
    public static function render($path, $data = [], $confirmed = false): array
    {
        return [
            'success' => true,
            'confirmed' => $confirmed,
            'content' => view()->getHtml($path, $data)
        ];
    }
}