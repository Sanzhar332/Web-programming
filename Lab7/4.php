<?php
session_start();

$attempts = 2;
$minNumber = 1; // Минимальное значение для числа
$maxNumber = 10; // Максимальное значение для числа
$message = "";

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = $attempts;
}

if ($_SESSION['attempts'] > 0) {
    if (isset($_POST['guess'])) {
        $guess = $_POST['guess'];
        if ($_SESSION['numberToGuess'] == $guess) {
            $message = "ПОЗДРАВЛЯЮ! ТЫ ПОБЕДИЛ. Число, которое нужно было отгадать, это " . $_SESSION['numberToGuess'];
            $_SESSION['numberToGuess'] = rand($minNumber, $maxNumber);
            $_SESSION['attempts'] = $attempts; // Сброс попыток
        } elseif ($guess < $_SESSION['numberToGuess']) {
            $message = "Больше";
            $_SESSION['attempts']--;
        } else {
            $message = "Меньше";
            $_SESSION['attempts']--;
        }
    }
} else {
    $message = "Кончились попытки! Число, которое нужно было отгадать, это " . $_SESSION['numberToGuess'];
    $_SESSION['numberToGuess'] = rand($minNumber, $maxNumber);
    $_SESSION['attempts'] = $attempts; // Сброс попыток
}

if (!isset($_SESSION['numberToGuess'])) {
    $_SESSION['numberToGuess'] = rand($minNumber, $maxNumber);
}

// Timer
if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = time() + 10; // Устанавливаем время на 10 секунд
} elseif ($_SESSION['time'] <= time()) {
    $message = "Игра закончена! Время истекло. Число, которое нужно было отгадать, это " . $_SESSION['numberToGuess'];
    $_SESSION['numberToGuess'] = rand($minNumber, $maxNumber);
    $_SESSION['attempts'] = $attempts; // Сброс попыток
    unset($_SESSION['time']); // Сброс таймера
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Игра "Угадай число"</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            justify-content: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"], input[type="submit"] {
            margin: 10px 0;
            padding: 10px;
            width: 200px;
        }

        #message {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form method="post">
        <label for="guess">Угадай число от <?php echo $minNumber; ?> до <?php echo $maxNumber; ?>:</label>
        <input type="text" name="guess">
        <input type="submit" value="Отправить">
    </form>
    <div id="message"><?php echo $message; ?></div>
</body>
</html>
