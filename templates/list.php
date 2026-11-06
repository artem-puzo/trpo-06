<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Заметки</title>
</head>
<body>
  <header>
    Пользователь: <strong><?= e($name) ?></strong>
    <form method="post" action="index.php" style="display:inline">
      <input type="hidden" name="action" value="clear_name">
      <button type="submit">Очистить</button>
    </form>
  </header>

  <main>
    <h1>Мои заметки</h1>

    <?php if ($error): ?>
      <p style="color:red"><?= e($error) ?></p>
    <?php endif; ?>

    <form method="post" action="index.php">
      <input type="hidden" name="action" value="set_name">
      <input name="name" placeholder="Student A">
      <button type="submit">Сохранить имя</button>
    </form>

    <?php if (!$notes): ?>
      <p>Заметок пока нет.</p>
    <?php else: ?>
      <ul>
        <?php foreach ($notes as $n): ?>
          <li>#<?= (int)$n['id'] ?> — <?= e($n['title']) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <form method="post" action="index.php">
      <input type="hidden" name="action" value="add_note">
      <input name="title" placeholder="Название">
      <button type="submit">Добавить</button>
    </form>
  </main>
</body>
</html>