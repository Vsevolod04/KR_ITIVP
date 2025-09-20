<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Редактирование идеи</title>
</head>

<body>

    <?php
    include "config.php";

    $conn = getConn();

    if (isset($_POST["id"])) {
        if ($conn != null) {
            $id = htmlspecialchars(trim($_POST["id"]));
            $title = htmlspecialchars(trim($_POST["title"]));
            $category = htmlspecialchars(trim($_POST["category"]));
            $description = htmlspecialchars(trim($_POST["description"]));
            $status = htmlspecialchars($_POST["status"]);
            $complexity = htmlspecialchars($_POST["complexity"]);

            try {
                $stmt =  $conn->prepare("UPDATE ideas SET
                 title = ?,
                 category = ?,
                 description = ?,
                 status = ?,
                 complexity = ?
                WHERE id = ?");

                $stmt->bindParam(1, $title);
                $stmt->bindParam(2, $category);
                $stmt->bindParam(3, $description);
                $stmt->bindParam(4, $status);
                $stmt->bindParam(5, $complexity);
                $stmt->bindParam(6, $id, PDO::PARAM_INT);
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

    if (isset($_GET["id"])) {
        if ($conn != null) {
            try {
                $stmt =  $conn->prepare("SELECT * FROM ideas WHERE id = ?");
                $stmt->bindParam(1, $_GET["id"], PDO::PARAM_INT);
                $stmt->execute();
                $idea = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$idea) {
                    $msg = 'Запись об идее не найдена';
                    header("Location: error.php?msg=" . urlencode($msg));
                    exit();
                }
            } catch (PDOException $e) {
                header("Location: error.php?msg=" . urlencode($e->getMessage()));
                exit();
            }
        } else {
            $msg = 'Нет доступа к БД';
            header("Location: error.php?msg=" . urlencode($msg));
            exit();
        }
    }
    ?>

    <h1>Редактирование идеи #<?php echo $idea["id"]  ?></h1>

    <div class="container">
        <form method="POST" action="edit.php">
            <div class="form-group">
                <label>Id: </label>
                <input name="id" type="text" style="background-color: #0067815e;" value="<?php echo $idea["id"]  ?>" readonly required>
            </div>
            <div class="form-group">
                <label>Название: <span style="color: red;">*</span></label>
                <input name="title" type="text" value="<?php echo $idea["title"]  ?>" maxlength="100" required>
            </div>
            <div class="form-group">
                <label>Категория:</label>
                <input name="category" type="text" value="<?php echo $idea["category"] ?>" maxlength="100">
            </div>
            <div class="form-group">
                <label>Описание:</label>
                <textarea name="description" maxlength="2000" rows="5"><?php echo $idea["description"] ?></textarea>
            </div>
            <div class="form-group">
                <label>Статус: <span style="color: red;">*</span></label>
                <select name="status" required>
                    <option value="готово"
                        <?php if ($idea["status"] == "готово") echo "selected" ?>>
                        готово
                    </option>
                    <option value="выполняется"
                        <?php if ($idea["status"] == "выполняется") echo "selected" ?>>
                        выполняется
                    </option>
                    <option value="отложено"
                        <?php if ($idea["status"] == "отложено") echo "selected" ?>>
                        отложено
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label>Дата создания: </label>
                <input name="created_at" style="background-color: #0067815e;" value="<?php echo $idea["created_at"]  ?>" readonly required>
            </div>
            <div class="form-group">
                <label>Сложность: <span style="color: red;">*</span></label>
                <select name="complexity" required>
                    <option value="легко"
                        <?php if ($idea["complexity"] == "легко") echo "selected" ?>>
                        легко
                    </option>
                    <option value="средне"
                        <?php if ($idea["complexity"] == "средне") echo "selected" ?>>
                        средне
                    </option>
                    <option value="сложно"
                        <?php if ($idea["complexity"] == "сложно") echo "selected" ?>>
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