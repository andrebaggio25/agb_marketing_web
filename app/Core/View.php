<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data = []): string
    {
        extract($data, EXTR_SKIP);
        $file = VIEW_PATH . '/' . str_replace('.', '/', $view) . '.php';
        if (!is_file($file)) {
            throw new \RuntimeException('View não encontrada: ' . $view);
        }
        ob_start();
        require $file;
        return (string) ob_get_clean();
    }
}
