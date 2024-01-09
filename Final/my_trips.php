<?php
include 'db.php';

// Ваш запрос к базе данных для получения списка купленных туров
$sql = "SELECT * FROM my_trips";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои поездки</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Мои поездки</h1>
</header>

<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f8f8;
    color: #333;
}

header {
    background-color: #007bff;
    color: #fff;
    text-align: center;
    padding: 10px;
}

.main-content {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#my-trips-container {
    margin-top: 20px;
}

.my-trip {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
}

.my-trip img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

h2 {
    color: #007bff;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
    color: black;
}

footer {
    margin-top: 20px;
    text-align: center;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
}

script {
    display: none;
}
img{
    width: 500px;
}

</style>

<section class="main-content">
    <div id="my-trips-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="my-trip">';
                echo '<img src="images/Paris(1).jpeg">';
                echo '<h2>' . $row['hotel_name'] . '</h2>';
                echo '<ul>';
                echo '<li><strong>Имя:</strong> ' . $row['first_name'] . '</li>';
                echo '<li><strong>Фамилия:</strong> ' . $row['last_name'] . '</li>';
                echo '<li><strong>Цена:</strong> $' . $row['price'] . '</li>';
                echo '<li><strong>Дата покупки:</strong> 20 декабря 2023 года</li>';
                // Добавьте другие необходимые детали о туре
                echo '</ul>';
                echo '</div>';
            }
        } else {
            echo '<p>У вас пока нет купленных туров.</p>';
        }
        ?>
    </div>
</section>

<footer>
    &copy; 2023 Все права защищены
</footer>

<script src="script.js"></script>
</body>
</html>
