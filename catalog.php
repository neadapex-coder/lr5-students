<?php
require_once __DIR__ . '/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['prod_title'] ?? '');
    $price = trim($_POST['prod_price'] ?? '');

    if ($title === '' || mb_strlen($title) > 100) {
        $error = 'Название должно содержать от 1 до 100 символов.';
    } elseif (!preg_match('/^\d{1,8}(\.\d{1,2})?$/', $price)) {
        $error = 'Введите цену от 0 до 99999999.99, максимум два знака после точки.';
    } else {
        $stmt = $conn->prepare(
            'INSERT INTO products (title, price) VALUES (?, ?)'
        );
        $stmt->bind_param('ss', $title, $price);
        $stmt->execute();

        header('Location: catalog.php');
        exit;
    }
}

$result = $conn->query(
    'SELECT id, title, price FROM products ORDER BY id'
);

function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог товаров</title>
</head>
<body>
    <h1>Каталог товаров</h1>

    <?php if ($error !== ''): ?>
        <p><?= escape($error) ?></p>
    <?php endif; ?>

    <p><a href="add_product.php">Добавить товар</a></p>

    <ul>
        <?php while ($product = $result->fetch_assoc()): ?>
            <li>
                <a href="product.php?id=<?= (int) $product['id'] ?>">
                    <?= escape($product['title']) ?>
                </a>
                — <?= escape($product['price']) ?> ₽
            </li>
        <?php endwhile; ?>
    </ul>

    <?php if ($result->num_rows === 0): ?>
        <p>Товаров пока нет.</p>
    <?php endif; ?>

    <p><a href="index.php">К списку студентов</a></p>
</body>
</html>