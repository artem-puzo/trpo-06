<?php
declare(strict_types=1);

require __DIR__ . '/../src/storage.php';
require __DIR__ . '/../src/session.php';

startSession();

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
$name = currentName();
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Заметки</title>
</head>
<body>
  <header>
    Пользователь: <strong><?= htmlspecialchars($name) ?></strong>
    <form method="post" action="index.php" style="display:inline">
      <input type="hidden" name="action" value="clear_name">
      <button type="submit">Очистить</button>
    </form>
  </header>

  <h1>Мои заметки</h1>

  <?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post" action="index.php">
    <input type="hidden" name="action" value="set_name">
    <input name="name" placeholder="Student A">
    <button type="submit">Сохранить имя</button>
  </form>

  <ul>
    <?php foreach ($notes as $n): ?>
      <li>#<?= (int)$n['id'] ?> — <?= htmlspecialchars($n['title']) ?></li>
    <?php endforeach; ?>
  </ul>

  <form method="post" action="index.php">
    <input type="hidden" name="action" value="add_note">
    <input name="title" placeholder="Название">
    <button type="submit">Добавить</button>
  </form>
</body>
</html>