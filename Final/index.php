<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yandex Путешествия</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Подключение jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Подключение jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>

<header>
    <div class="logo">
        <img src="images/3.svg" width="85" height="30" alt="Logo 1">
        <img src="images/2.svg" width="40" height="30" alt="Logo 2">
        <img src="images/1.svg" width="158" height="30" alt="Logo 3">
    </div>
    
    <nav>
        <ul>
            <li><a href="#">Акции и скидки</a></li>
            <li><a href="#">Поддержка</a></li>
            <li><a href="#">Избранное</a></li>
            <li><a href="my_trips.php">Мои поездки</a></li>
            <li><a href="#">Журнал</a></li>
            <li><a href="payment_plus.php">Плюс</a></li>
            <li><a href="login.php">Войти</a></li>
        </ul>
    </nav>
</header>

<section class="navigation">
    <nav>
        <ul>
            <li><a href="#">Отели</a></li>
            <li><a href="#">Авиа</a></li>
            <li><a href="#">Ж/Д</a></li>
            <li><a href="#">Автобусы</a></li>
            <li class="active"><a href="#">Туры</a></li>
        </ul>
    </nav>
</section>
    <section class="main-content">
        <p>Бронируйте любой тур, оплачивайте его и получайте кешбэк</p>
        <div class="search-form">
            <label for="from"></label>
            <input type="text" id="from" name="from" placeholder="Откуда" value="Алматы" >

            <label for="to"></label>
            <input type="text" id="to" name="to" placeholder="Куда" oninput="showOptions(this)>

            <label for='date">Когда:</label>
            <input type="date" id="date" name="date" min="2023-12-19">

            <label for="nights">Ночей:</label>
            <input type="number" id="nights" name="nights" min="1">

            <label for="adults">Взрослых:</label>
            <input type="number" id="adults" name="adults" min="1">

            <button type="button" onclick="findHotels()">Найти</button>
        </div>

        <p class="highlighted-text">
            <span class="bold-text">10 миллионов</span> путешественников ежегодно бронируют у нас туры, проживание и билеты
        </p>

    <div class="feature-block">
        <div class="feature">
            <img src="images/11.webp" alt="Image 1">
            <p>Войдите в аккаунт Яндекса с подключённым Плюсом и получите 5% за бронирование тура (максимум 5000)</p>
        </div>
        <div class="feature">
            <img src="images/22.webp" alt="Image 2">
            <p>Цены как у туроператоров, без наценок, комиссий и скрытых услуг</p>
        </div>
        <div class="feature">
            <img src="images/33.webp" alt="Image 3">
            <p>Россия, Турция, Египет и другие страны. Туры от надёжных операторов</p>
        </div>
        <div class="feature">
            <img src="images/44.webp" alt="Image 4">
            <p>Поддержка 24/7 по телефону и в чате. Даже в выходные. И в Новый год</p>
        </div>
    </div>
    </section>


    <footer>
    <div class="footer-column">
        <div class="footer-section">
            <h3>Сервисы</h3>
            <!-- Содержимое раздела Сервисы -->
        </div>
        <div class="footer-section">
            <h3>Расписание транспорта</h3>
        </div>
        <div class="footer-section">
            <h3>Журнал путешествий</h3>
        </div>
    </div>

    <div class="footer-column">
        <div class="footer-section">
            <h3>Пользователям</h3>
            <!-- Содержимое раздела Пользователям -->
        </div>
        <div class="footer-section">
            <h3>О Сервисе</h3>
        </div>
        <div class="footer-section">
            <h3>Темная тема</h3>
        </div>
        <div class="footer-section">
            <h3>Служба поддержки</h3>
        </div>
        <div class="footer-section">
            <h3>Пользовательское соглашение</h3>
        </div>
        <div class="footer-section">
            <h3>Правила рекомендаций</h3>
        </div>
        <div class="footer-section">
            <h3>Участие в исследованиях</h3>
        </div>
        <div class="footer-section">
            <h3>Правила программы лояльности Яндекс Плюс</h3>
        </div>
    </div>

    <div class="footer-column">
        <div class="footer-section">
            <h3>Партнёрам</h3>
            <!-- Содержимое раздела Партнёрам -->
        </div>
        <div class="footer-section">
            <h3>Яндекс Путешествия для партнеров</h3>
        </div>
        <div class="footer-section">
            <h3>Программа для веб-мастеров и блогеров</h3>
        </div>
        <div class="footer-section">
            <h3>Мы в социальных сетях</h3>
        </div>
    </div>

    <div class="footer-column">
        <div class="footer-section">
            <h3>Приложение Яндекс Путешествий</h3>
            <!-- Содержимое раздела Приложение Яндекс Путешествий -->
        </div>
    </div>

    <div class="footer-column">
        <div class="footer-section">
            <h3>© 2009–2023 OOO «Яндекс.Вертикали»</>
            <p>Наши проекты: Яндекс Аренда, Авто.ру, Яндекс Недвижимость, Яндекс Услуги</p>
        </div>
        <div class="footer-section">
            <h3>Команда:</h3>
            <p>Наши вакансии</p>
        </div>
        <div class="footer-section">
            <h3>Проект компании Яндекс</h3>
        </div>
    </div>
    </footer>

<script src="script.js"></script>
</body>
</html>
