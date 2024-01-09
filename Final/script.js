$(document).ready(function() {
    // Используйте jQuery UI Autocomplete для поля "Куда"
    $("#to").autocomplete({
        source: function(request, response) {
            // AJAX-запрос к серверу для получения вариантов направлений
            $.ajax({
                url: "get_directions.php",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 2 // Минимальное количество символов перед отправкой запроса
    });
});

function showOptions(input) {
    // Функция больше не нужна, так как Autocomplete будет обрабатывать ввод
}

// script.js
// script.js
function findHotels() {
    // Получаем значения из формы
    var to = document.getElementById('to').value;
    var date = document.getElementById('date').value;
    var nights = document.getElementById('nights').value;
    var adults = document.getElementById('adults').value;

    // Проверяем корректность введенных данных
    if (to && date && nights > 0 && adults > 0) {
        // Переходим на страницу hotels.php с параметрами
        window.location.href = 'hotels.php?to=' + encodeURIComponent(to) +
                               '&date=' + encodeURIComponent(date) +
                               '&nights=' + encodeURIComponent(nights) +
                               '&adults=' + encodeURIComponent(adults);
    } else {
        // Выводим сообщение об ошибке
        alert('Пожалуйста, заполните все поля корректно.');
    }
}


document.getElementById('paymentForm').addEventListener('submit', function (event) {
    clearInterval(timerInterval); // Остановка таймера при отправке формы

    // Если таймер не закончился, предотвращаем отправку формы
    if (timeLeft > 0) {
        event.preventDefault();
        
        // Отправка AJAX-запроса для обновления данных в базе данных
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_yandex_plus.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Обработка ответа от сервера
                if (xhr.responseText === 'success') {
                    // Оплата прошла успешно, выполните дополнительные действия, если необходимо
                } else {
                    // Обработка ошибки, если не удалось обновить данные в базе данных
                    console.error(xhr.responseText);
                }
            }
        };
        
        // Отправка запроса с идентификатором пользователя
        xhr.send('user_id=' + encodeURIComponent('<?php echo $user_id; ?>'));
    }
});