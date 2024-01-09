<?php


include 'db.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};





$sql = "SELECT direction FROM tours WHERE direction LIKE ? LIMIT 5";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $term = "%" . $_GET['term'] . "%";
    $stmt->bind_param("s", $term);
    $stmt->execute();
    $stmt->bind_result($direction);
    $result = array();

    while ($stmt->fetch()) {
        $result[] = $direction;
    }

    $stmt->close();
}

// Отправка данных в формате JSON
echo json_encode($result);

// Закрытие соединения
$conn->close();
?>