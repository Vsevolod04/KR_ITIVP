<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="styles.css">

    <title>База идей для проектов</title>
</head>

<body>
    <h1>База идей для проектов</h1>

    <table class="main-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Описание</th>
                <th>Статус</th>
                <th>Дата создания</th>
                <th>Сложность</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "config.php";
            $conn = getConn();
            if ($conn != null) {
                $data = $conn->query("SELECT * FROM ideas");
                while ($idea = $data->fetch()) :
            ?>
                    <tr>
                        <td><?php echo $idea['id'] ?></td>
                        <td><?php echo $idea['title'] ?></td>
                        <td><?php echo $idea['category'] ?></td>
                        <td><?php echo $idea['description'] ?></td>
                        <td>
                            <div class='dropdown'>
                                <button type='button' class='btn-status'><?php echo $idea['status'] ?></button>
                                <div class='status-list'>
                                    <a href="update_status.php?id=<?php echo $idea['id'] ?>&newStatus=выполняется">
                                        выполняется
                                    </a>
                                    <a href="update_status.php?id=<?php echo $idea['id'] ?>&newStatus=отложено">отложено</a>
                                    <a href="update_status.php?id=<?php echo $idea['id'] ?>&newStatus=готово">готово</a>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $idea['created_at'] ?></td>
                        <td><?php echo $idea['complexity'] ?></td>
                        <td data-label='Действия'>
                            <div class='action-buttons'>
                                <button type='button' class='btn btn-edit' onclick="editIdea(<?php echo $idea['id'] ?>)">
                                    <img src='icons/pencil-fill.svg' alt='edit'>
                                </button>
                                <button type='button' class='btn btn-delete' onclick="deleteIdea(<?php echo $idea['id'] ?>)">
                                    <img src='icons/trash-fill.svg' alt='delete'>
                                </button>
                            </div>
                        </td>
                    </tr>

            <?php
                endwhile;
            }
            ?>

        </tbody>
    </table>

</body>

</html>