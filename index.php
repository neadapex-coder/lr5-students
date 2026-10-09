<?php
require_once __DIR__ . '/db.php';

$result = $conn->query('SELECT id, name, email FROM users ORDER BY id');

function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список студентов</title>
</head>
<body>
    <h1>Список студентов</h1>

    <p><a href="add.php">Добавить студента</a></p>

    <ul>
        <?php while ($student = $result->fetch_assoc()): ?>
            <li>
                <a href="user.php?id=<?= (int) $student['id'] ?>">
                    <?= escape($student['name']) ?>
                </a>
                — <?= escape($student['email']) ?>
            </li>
        <?php endwhile; ?>
    </ul>

    <?php if ($result->num_rows === 0): ?>
        <p>В таблице пока нет студентов.</p>
    <?php endif; ?>
</body>
</html>