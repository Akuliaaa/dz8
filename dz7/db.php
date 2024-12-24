<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "guestbook";

$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    echo "Ошибка подключения: " . mysqli_connect_error();
    exit;
}
function get_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function get_user_agent() {
    return $_SERVER['HTTP_USER_AGENT'] ?? '';
}