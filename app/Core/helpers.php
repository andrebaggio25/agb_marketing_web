<?php

declare(strict_types=1);

function config(string $file): array
{
    $path = CONFIG_PATH . '/' . $file . '.php';
    if (!is_file($path)) {
        return [];
    }
    return require $path;
}

function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $url, int $code = 302): never
{
    header('Location: ' . $url, true, $code);
    exit;
}

function asset(string $path): string
{
    return '/assets/' . ltrim($path, '/');
}

function url(string $path = ''): string
{
    $base = rtrim((string) (config('app')['url'] ?? ''), '/');
    return $base . '/' . ltrim($path, '/');
}

function slugify(string $text): string
{
    $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text) ?: $text;
    $text = strtolower((string) preg_replace('/[^a-z0-9]+/i', '-', $text));
    return trim((string) $text, '-') ?: 'pagina';
}

/**
 * @param array<string, array<string,mixed>> $sections
 */
function section_text(array $sections, string $key, string $field, string $default = ''): string
{
    if (!isset($sections[$key][$field]) || $sections[$key][$field] === null || $sections[$key][$field] === '') {
        return $default;
    }
    return (string) $sections[$key][$field];
}
