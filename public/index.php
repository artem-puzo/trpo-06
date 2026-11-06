<?php
declare(strict_types=1);

require __DIR__ . '/../src/storage.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim((string)($_POST['title'] ?? ''));

    if ($title === '') {
        $error = 'Название заметки не может быть пустым.';
    } else {
        addNote($title);
        header('Location: index.php');
        exit;
    }
}

$notes = loadNotes();
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Заметки</title>
</head>
<body>
  <h1>Мои заметки</h1>

  <?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <ul>
    <?php foreach ($notes as $n): ?>
      <li>#<?= (int)$n['id'] ?> — <?= htmlspecialchars($n['title']) ?></li>
    <?php endforeach; ?>
  </ul>

  <form method="post" action="index.php">
    <input name="title" placeholder="Название">
    <button type="submit">Добавить</button>
  </form>
</body>
</html>