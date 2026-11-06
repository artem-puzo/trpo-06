<?php
declare(strict_types=1);

const DATA_DIR = __DIR__ . '/../data/dataset';

function loadJson(string $name): array
{
    $path = DATA_DIR . '/' . $name;
    $raw = file_get_contents($path);
    return json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
}

function saveJson(string $name, array $data): void
{
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    file_put_contents(DATA_DIR . '/' . $name, $json . "\n", LOCK_EX);
}

function loadNotes(): array
{
    return loadJson('notes.json');
}

function addNote(string $title): void
{
    $notes = loadNotes();
    $nextId = $notes ? max(array_column($notes, 'id')) + 1 : 1;
    $notes[] = ['id' => $nextId, 'title' => $title, 'done' => false];
    saveJson('notes.json', $notes);
}