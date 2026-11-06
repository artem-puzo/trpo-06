<?php
declare(strict_types=1);

function render(string $template, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require __DIR__ . '/../templates/' . $template . '.php';
}

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}