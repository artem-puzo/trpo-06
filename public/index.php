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
            try {
                addNote($title);
                header('Location: index.php');
                exit;
            } catch (RuntimeException $e) {
                $error = $e->getMessage();
            }
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

$page = $_GET['page'] ?? 'list';

switch ($page) {
    case 'list':
        try {
            $notes = loadNotes();
        } catch (RuntimeException $e) {
            $notes = [];
            $error = $error ?? $e->getMessage();
        }
        render('list', [
            'notes' => $notes,
            'name'  => currentName(),
            'error' => $error,
        ]);
        break;
        
    case 'scenarios':
        try {
            $scenarios = loadScenarios();
            $users = loadUsers();
        } catch (RuntimeException $e) {
            $scenarios = $users = [];
            $error = $e->getMessage();
        }
        render('scenarios', [
            'scenarios' => $scenarios,
            'users'     => $users,
            'name'      => currentName(),
            'error'     => $error,
        ]);
        break;

    default:
        http_response_code(404);
        render('404', ['page' => (string)$page]);
}