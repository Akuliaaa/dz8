<?php
require_once 'db.php';

$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = 7;
$start_from = ($current_page - 1) * $items_per_page;

$result = mysqli_query($link, "SELECT COUNT(id) FROM messages");
$total_messages = mysqli_fetch_row($result)[0];
$total_pages = ceil($total_messages / $items_per_page);

$sql = "SELECT * FROM messages ORDER BY created_at DESC LIMIT $start_from, $items_per_page";
$result = mysqli_query($link, $sql);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гостевая книга!</title>
</head>
<body>
    <h1>Гостевая книга</h1>

    <?php if ($messages): ?>
        <?php foreach ($messages as $message): ?>
            <div style="margin-bottom: 20px; border-bottom: 1px solid #ddd; padding: 10px;">
                <strong><?= htmlspecialchars($message['name'], ENT_QUOTES); ?></strong><br>
                <em><?= htmlspecialchars($message['email'], ENT_QUOTES); ?></em><br>
                <p><?= nl2br(htmlspecialchars($message['message'], ENT_QUOTES)); ?></p>
                <small>Дата: <?= date('Y-m-d H:i:s', strtotime($message['created_at'])); ?></small>
            </div>
        <?php endforeach; ?>

        <nav>
            <ul>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li><a href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php else: ?>
        <p>Сообщения отсутствуют.</p>
    <?php endif; ?>

    <p><a href="add_message.php">Добавить сообщение</a></p>
</body>
</html>