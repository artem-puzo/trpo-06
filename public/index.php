<?php
declare(strict_types=1);

require __DIR__ . '/../src/storage.php';
require __DIR__ . '/../src/session.php';
require __DIR__ . '/../src/view.php';

startSession();

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add_note') {
        $title = trim((string)($_POST['title'] ?? ''));
        if ($title === '') {
            $error = 'Название заметки не может быть пустым.';
        } else {
            addNote($title);
            header('Location: index.php');
            exit;
        }
    } elseif ($action === 'set_name') {
        $name = trim((string)($_POST['name'] ?? ''));
        if ($name === '') {
            $error = 'Имя не может быть пустым.';
        } else {
            setName($name);
            header('Location: index.php');
            exit;
        }
    } elseif ($action === 'clear_name') {
        clearName();
        header('Location: index.php');
        exit;
    }
}

$notes = loadNotes();

render('list', [
    'notes' => $notes,
    'name'  => currentName(),
    'error' => $error,
]);