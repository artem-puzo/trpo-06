<?php
declare(strict_types=1);

require __DIR__ . '/../src/storage.php';

$notes = loadNotes();

echo '<pre>';
print_r($notes);