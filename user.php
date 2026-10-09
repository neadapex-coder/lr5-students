<?php
require_once __DIR__ . '/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$student = null;

if ($id && $id > 0) {
    $stmt = $conn->prepare('SELECT id, name, email FROM users WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $student = $stmt->get_result()->fetch_assoc();
}

function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Карточка студента</title>
</head>
<body>
    <h1>Карточка студента</h1>

    <?php if ($student): ?>
        <p>ID: <?= (int) $student['id'] ?></p>
        <p>Имя: <?= escape($student['name']) ?></p>
        <p>Email: <?= escape($student['email']) ?></p>
    <?php else: ?>
        <p>Студент не найден.</p>
    <?php endif; ?>

    <a href="index.php">Вернуться к списку</a>
</body>
</html>