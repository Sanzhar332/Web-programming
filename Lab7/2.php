<!DOCTYPE html>
<html>
<head>
    <title>Day Checker</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            text-align: center;
        }

        label {
            font-size: 18px;
        }

        input {
            padding: 8px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<form method="post">
    <label for="day">Enter a day: </label>
    <input type="number" name="day" id="day" required>
    <button type="submit">Check</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $day = isset($_POST['day']) ? (int)$_POST['day'] : 0;

    switch ($day) {
        case 1:
        case 2:
        case 3:
        case 4:
        case 5:
            echo "It's a workday";
            break;
        case 6:
        case 7:
            echo "It's a weekend";
            break;
        default:
            echo "Unknown day";
            break;
    }
}
?>

</body>
</html>
