<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Добавление идеи</title>
</head>

<body>

    <?php
    include "config.php";

    $conn = getConn();

    if (isset($_POST["title"])) {
        if ($conn != null) {
            $title = htmlspecialchars(trim($_POST["title"]));
            $category = htmlspecialchars(trim($_POST["category"]));
            $description = htmlspecialchars(trim($_POST["description"]));
            $status = htmlspecialchars($_POST["status"]);
            $complexity = htmlspecialchars($_POST["complexity"]);

            try {
                $stmt =  $conn->prepare("INSERT ideas 
                (title, category, description, status, complexity) VALUES  
                (?, ?, ?, ?, ?)");

                $stmt->bindParam(1, $title);
                $stmt->bindParam(2, $category);
                $stmt->bindParam(3, $description);
                $stmt->bindParam(4, $status);
                $stmt->bindParam(5, $complexity);
                $stmt->execute();
            } catch (PDOException $e) {
                header("Location: error.php?msg=" . urlencode($e->getMessage()));
                exit();
            }
            header("Location: index.php");
            exit();
        } else {
            $msg = 'Нет доступа к БД';
            header("Location: error.php?msg=" . urlencode($msg));
            exit();
        }
    }
    ?>

    <h1>Добавление идеи</h1>

    <div class="container">
        <form method="POST" action="add.php">
            <div class=" form-group">
                <label>Название:</label>
                <input name="title" type="text" placeholder="Введите название идеи" maxlength="100" required>
            </div>
            <div class="form-group">
                <label>Категория:</label>
                <input name="category" type="text" placeholder="Укажите категорию" maxlength="100">
            </div>
            <div class="form-group">
                <label>Описание:</label>
                <textarea name="description" maxlength="2000" rows="5" placeholder="Введите описание идеи"></textarea>
            </div>
            <div class="form-group">
                <label>Статус:</label>
                <select name="status" required>
                    <option value="готово">
                        готово
                    </option>
                    <option value="выполняется">
                        выполняется
                    </option>
                    <option value="отложено" selected>
                        отложено
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label>Сложность:</label>
                <select name="complexity" required>
                    <option value="легко">
                        легко
                    </option>
                    <option value="средне" selected>
                        средне
                    </option>
                    <option value="сложно">
                        сложно
                    </option>
                </select>
            </div>
            <div class="action-buttons">
                <button type="reset" class="btn btn-reset">Сброс</button>
                <button type="submit" class="btn btn-submit">Подтвердить</button>
                <button type="button" class="btn btn-cancel" onclick="window.location = 'index.php'">Отмена</button>
            </div>
        </form>
    </div>
</body>

</html>