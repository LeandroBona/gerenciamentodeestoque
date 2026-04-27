<?php

function redirect_with_message(string $path, string $message, string $type = 'success'): void
{
    $query = http_build_query(['msg' => $message, 'type' => $type]);
    header("Location: {$path}?{$query}");
    exit;
}

function post_string(string $key): string
{
    return trim($_POST[$key] ?? '');
}

function post_float(string $key): float
{
    return (float) str_replace(',', '.', $_POST[$key] ?? 0);
}

function post_int(string $key): int
{
    return (int) ($_POST[$key] ?? 0);
}
