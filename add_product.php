<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить товар</title>
</head>
<body>
    <h1>Добавить товар</h1>

    <form action="catalog.php" method="post">
        <p>
            <label>
                Название:
                <input type="text" name="prod_title"
                       maxlength="100" required>
            </label>
        </p>

        <p>
            <label>
                Цена:
                <input type="number" name="prod_price"
                       min="0" max="99999999.99"
                       step="0.01" required>
            </label>
        </p>

        <button type="submit">Добавить товар</button>
    </form>

    <p><a href="catalog.php">Открыть каталог</a></p>
</body>
</html>