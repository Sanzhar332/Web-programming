<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Проверка, что пользователь не подписан на Яндекс Плюс
    $updateQuery = "UPDATE users SET yandex_plus = 1 WHERE id = $user_id";
    if ($conn->query($updateQuery) === TRUE) {
        echo 'success';
    } else {
        echo 'error: ' . $conn->error;
    }
} else {
    echo 'invalid request';
}
?>