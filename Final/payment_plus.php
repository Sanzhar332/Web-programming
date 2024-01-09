<?php

include 'db.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

$user_id = $_SESSION['user_id'];

// Ваш запрос к базе данных для получения информации о пользователе (замените на ваш запрос)
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Обработка данных формы оплаты
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $card_number = $_POST['card_number'];
        $expiration_date = $_POST['expiration_date'];
        $cvv = $_POST['cvv'];
    
        // Простая валидация карты
        if (validateCardNumber($card_number)
            && strlen($cvv) == 3 && is_numeric($cvv)
            && validateExpirationDate($expiration_date)) {
    
            $payment_successful = true;
    
            if ($payment_successful) {
                // Проверка, что пользователь не подписан на Яндекс Плюс
                $updateQuery = "UPDATE users SET yandex_plus = 1 WHERE id = $user_id";
                if ($conn->query($updateQuery) === TRUE) {
                    echo '<p style="color: green;">Оплата прошла успешно. Спасибо за подписку на Яндекс Плюс!</p>';
                } else {
                    echo '<p style="color: red;">Ошибка при обновлении данных в базе данных: ' . $conn->error . '</p>';
                }
            }
        } else {
            $error_message = "Неверные данные карты. Пожалуйста, проверьте введенные данные.";
        }
    }
}
?>
<link rel="stylesheet" href="style-plus.css">


<!-- HTML-код для формы оплаты -->
<form id="paymentForm" method="post" action="">
    <label for="card_number">Номер карты:</label>
    <input type="text" id="card_number" name="card_number" placeholder="Введите номер карты" required>

    <label for="expiration_date">Срок действия (ММ/ГГ):</label>
    <input type="text" id="expiration_date" name="expiration_date" placeholder="01/23" required>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required>
    <div id="timer"></div>
    <button type="submit">Оплатить</button>

</form>



<script>
    // Установка начального времени и интервала обновления таймера
    let timeLeft = 180;
    const timerElement = document.getElementById('timer');

    // Обновление таймера каждую секунду
    const timerInterval = setInterval(function () {
        if (timeLeft > 0) {
            timerElement.innerHTML = 'Осталось времени: ' + timeLeft + ' сек.';
            timeLeft--;
        } else {
            timerElement.innerHTML = 'Время истекло';
            clearInterval(timerInterval);
            // Дополнительные действия, если нужно выполнить что-то по истечении времени
        }
    }, 1000);
    
    document.getElementById('paymentForm').addEventListener('submit', function (event) {
    clearInterval(timerInterval); // Остановка таймера при отправке формы

    // Если таймер не закончился, предотвращаем отправку формы
    if (timeLeft > 0) {
        event.preventDefault();

        // AJAX-запрос для обновления данных на сервере
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_yandex_plus.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Обработка ответа от сервера, если необходимо
                console.log(xhr.responseText);
            }
        };

        // Отправка данных формы на сервер
        xhr.send('user_id=' + <?php echo $user_id; ?>);
    }
    });

</script>

<?php
function validateCardNumber($card_number)
{
    // Простая проверка номера карты
    if (preg_match("/^[45]\d{3}-?\d{4}-?\d{4}-?\d{4}$/", $card_number)) {
        // Удаление разделителей для дальнейшей проверки
        $card_number = str_replace("-", "", $card_number);

        // Лунный алгоритм для валидации номера карты
        $sum = 0;
        $length = strlen($card_number);

        for ($i = 0; $i < $length; $i++) {
            $digit = (int)$card_number[$i];

            if ($i % 2 === $length % 2) {
                $digit *= 2;

                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        return $sum % 10 === 0;
    }

    return false;
}

function validateExpirationDate($expiration_date)
{
    // Простая проверка даты на формат ММ/ГГ
    if (preg_match("/^(0[1-9]|1[0-2])\/\d{2}$/", $expiration_date)) {
        $current_date = date("m/y");
        $entered_date = explode("/", $expiration_date);

        // Сравнение с текущей датой
        if ($entered_date[1] > substr($current_date, 3, 2)
            || ($entered_date[1] == substr($current_date, 3, 2) && $entered_date[0] >= substr($current_date, 0, 2))) {
            return true;
        }
    }

    return false;
}


?>
