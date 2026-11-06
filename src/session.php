<?php
declare(strict_types=1);

const DEFAULT_NAME = 'Гость';

function startSession(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['display_name'] ??= DEFAULT_NAME;
}

function currentName(): string
{
    return $_SESSION['display_name'];
}

function setName(string $name): void
{
    $_SESSION['display_name'] = $name;
}

function clearName(): void
{
    $_SESSION['display_name'] = DEFAULT_NAME;
}