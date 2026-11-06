<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Сценарии сессии</title>
</head>
<body>
  <header>
    Пользователь: <strong><?= e($name) ?></strong>
    · <a href="index.php">Заметки</a>
  </header>

  <main>
    <h1>Сценарии сессии</h1>

    <?php if ($error): ?>
      <p style="color:red"><?= e($error) ?></p>
    <?php else: ?>
      <table border="1" cellpadding="6">
        <tr><th>Сценарий</th><th>Значение</th><th>Ожидается</th></tr>
        <?php foreach ($scenarios as $s): ?>
          <tr>
            <td><?= e($s['scenario']) ?></td>
            <td><?= e($s['value'] ?? '—') ?></td>
            <td><?= e($s['expected']) ?></td>
          </tr>
        <?php endforeach; ?>
      </table>

      <h2>Известные пользователи</h2>
      <ul>
        <?php foreach ($users as $u): ?>
          <li><?= e($u['name']) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </main>
</body>
</html>