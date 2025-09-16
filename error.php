<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <h1>Ошибка</h1>
    <p>
        <?php
            echo [$_GET["error"]];
        ?>
    </p>
    <a href="index.php">Вернуться</a>
</body>
</html>