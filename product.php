<?php
require_once __DIR__ . '/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$product = null;

if ($id && $id > 0) {
    $stmt = $conn->prepare(
        'SELECT id, title, price FROM products WHERE id = ?'
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
}

function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Карточка товара</title>
</head>
<body>
    <h1>Карточка товара</h1>

    <?php if ($product): ?>
        <p>ID: <?= (int) $product['id'] ?></p>
        <p>Название: <?= escape($product['title']) ?></p>
        <p>Цена: <?= escape($product['price']) ?> ₽</p>
    <?php else: ?>
        <p>Товар не найден.</p>
    <?php endif; ?>

    <p><a href="catalog.php">Вернуться в каталог</a></p>
</body>
</html>