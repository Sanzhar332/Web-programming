<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата тура</title>
    <link rel="stylesheet" href="style-payment.css">
</head>
<body>

<?php
include 'db.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

// Получаем данные из URL
$hotel_name = isset($_GET['hotel']) ? urldecode($_GET['hotel']) : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';

// Обработка данных формы оплаты
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $card_number = $_POST['card_number'];
    $expiration_date = $_POST['expiration_date'];
    $cvv = $_POST['cvv'];

    // Проверка данных карты (ваша функция validateCardNumber и validateExpirationDate)
    if (validateCardNumber($card_number) && strlen($cvv) == 3 && is_numeric($cvv) && validateExpirationDate($expiration_date)) {

        // Используем подготовленный запрос для безопасности
        $insertQuery = "INSERT INTO my_trips (user_id, first_name, last_name, hotel_name, price ) VALUES (?, ?, ?, ?, ? )";

        // Подготовка запроса
        $stmt = $conn->prepare($insertQuery);
        
        if ($stmt) {
            // Привязываем параметры
            $stmt->bind_param('isssd', $user_id, $first_name, $last_name, $hotel_name, $price);

            // Выполняем запрос
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Бронирование успешно завершено. Спасибо!']);
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Ошибка при бронировании: ' . $stmt->error]);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Ошибка при подготовке запроса: ' . $conn->error]);
            exit();
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Неверные данные карты. Пожалуйста, проверьте введенные данные.']);
        exit();
    }
}
?>

<form method="post" action="">
              <label for="first_name">Имя:</label>
              <input type="text" id="first_name" name="first_name" placeholder="Введите ваше имя" required>

              <label for="last_name">Фамилия:</label>
              <input type="text" id="last_name" name="last_name" placeholder="Введите вашу фамилию" required>
              
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
        event.preventDefault();

        // Собираем данные формы
        const formData = new FormData(this);

        // Отправляем AJAX-запрос
        fetch('payment.php?hotel=<?php echo urlencode($hotel_name); ?>&price=<?php echo $price; ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Если бронирование успешно, выводим сообщение и что-то еще, если необходимо
                alert(data.message);
                // Дополнительные действия
            } else {
                // Если бронирование не удалось, выводим сообщение об ошибке
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Ошибка при выполнении AJAX-запроса:', error);
        });
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


</body>
</html>
