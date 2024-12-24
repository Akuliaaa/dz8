<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (strlen($name) < 10 || strlen($message) < 10 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Заполните все поля правильно.";
    } else {
        $ip = get_ip();
        $agent = get_user_agent();

        $query = "INSERT INTO messages (name, email, message, ip_address, user_agent) 
                  VALUES ('$name', '$email', '$message', '$ip', '$agent')";
        if (mysqli_query($link, $query)) {
            header("Location: index.php");
        } else {
            echo "Ошибка при добавлении сообщения: " . mysqli_error($link);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление сообщения</title>
</head>
<body>
    <h1>Добавить сообщение</h1>
    <form method="post" action="add_message.php">
        Имя:<br>
        <input type="text" name="name" required><br><br>
        Email:<br>
        <input type="email" name="email" required><br><br>
        Сообщение:<br>
        <textarea name="message" rows="5" cols="40" required></textarea><br><br>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>