<?php

namespace Kernel\Email;

use Exception;

class Template
{
    /**
     * @throws Exception
     */
    public static function render(string $view, array $data = []): string
    {
        extract($data);
        $path = __DIR__ . "/../../src/Views/Emails/{$view}.php";

        if (!file_exists($path)) {
            throw new Exception("View [$view] not found");
        }

        ob_start();
        include $path;
        return ob_get_clean();
    }
}