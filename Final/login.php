<?php
include 'db.php';

session_start();

// Проверка, авторизован ли пользователь
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute([$username, $password]);

    
    if (!$stmt->error) {
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Неправильное имя пользователя или пароль.";
    }

    $stmt->close();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<link rel="stylesheet" href="style-auth.css">

<section class="main-content">
    <?php
    // Если пользователь залогинен, отобразить его имя
    if (isset($_SESSION['username'])) {
        echo '<h2>Добро пожаловать, ' . $_SESSION['username'] . '!</h2>';
        echo '<div class="logout-button"><a href="login.php?logout=true">Выйти</a></div>';
    } else {
        // Вывести форму входа, если пользователь не залогинен
        echo '<h2>Login</h2>';
        echo '<form action="login.php" method="post">';
        echo '<label for="username">Username:</label>';
        echo '<input type="text" id="username" name="username" required>';

        echo '<label for="password">Password:</label>';
        echo '<input type="password" id="password" name="password" required>';

        echo '<button type="submit">Login</button>';
        echo '</form>';

        if (isset($error)) {
            echo "<p style='color: red;'>$error</p>";
        }

        echo '<div class="link-button">';
        echo '<a href="register.php">Нет аккаунта? Зарегистрируйтесь здесь</a>';
        echo '</div>';
    }
    ?>
</section>
