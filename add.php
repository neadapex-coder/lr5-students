<?php
require_once __DIR__ . '/db.php';

$error = '';
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['student_name'] ?? '');
    $email = trim($_POST['student_email'] ?? '');

    if ($name === '' || $email === '') {
        $error = 'Заполните имя и email.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Введите корректный email.';
    } elseif (mb_strlen($name) > 50 || mb_strlen($email) > 50) {
        $error = 'Имя и email должны быть не длиннее 50 символов.';
    } else {
        $stmt = $conn->prepare(
            'INSERT INTO users (name, email) VALUES (?, ?)'
        );
        $stmt->bind_param('ss', $name, $email);
        $stmt->execute();

        header('Location: index.php');
        exit;
    }
}

function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить студента</title>
</head>
<body>
    <h1>Добавить студента</h1>

    <?php if ($error !== ''): ?>
        <p><?= escape($error) ?></p>
    <?php endif; ?>

    <form action="add.php" method="post">
        <p>
            <label>
                Имя:
                <input type="text" name="student_name"
                       maxlength="50" required
                       value="<?= escape($name) ?>">
            </label>
        </p>

        <p>
            <label>
                Email:
                <input type="email" name="student_email"
                       maxlength="50" required
                       value="<?= escape($email) ?>">
            </label>
        </p>

        <button type="submit">Добавить</button>
    </form>

    <p><a href="index.php">Вернуться к списку</a></p>
</body>
</html>