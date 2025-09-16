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
                while ($idea = $data->fetch()) {
                    echo "<tr>
                    <td>{$idea['id']}</td>
                    <td>{$idea['title']}</td>
                    <td>{$idea['category']}</td>
                    <td>{$idea['description']}</td>
                    <td>{$idea['status']}</td>
                    <td>{$idea['created_at']}</td>
                    <td>{$idea['complexity']}</td>
                    <td data-label='Действия'>
                        <div class='action-buttons'>
                            <button class='btn btn-edit' onclick='editIdea({$idea['id']})'>
                                <img src='icons/pencil-fill.svg'  alt='edit'>
                            </button>
                            <button class='btn btn-delete' onclick='deleteIdea({$idea['id']})'>
                                <img src='icons/trash-fill.svg'  alt='delete'>
                            </button>
                    </td>
                </tr>";
                }
            }

            ?>
        </tbody>
    </table>

</body>

</html>