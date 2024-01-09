<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check for Negative Numbers</title>
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
    </style>
</head>
<body>

<form method="post">
    <label for="numberInput">Enter numbers (comma-separated): </label>
    <input type="text" name="numberInput" id="numberInput" required>
    <button type="submit">Check</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = isset($_POST['numberInput']) ? $_POST['numberInput'] : '';
    $numbers = explode(',', $input);
    $hasNegative = false;

    foreach ($numbers as $number) {
        if ((int)$number < 0) {
            $hasNegative = true;
            break;
        }
    }

    if ($hasNegative) {
        echo "YES";
    } else {
        echo "NO";
    }
}
?>

</body>
</html>
