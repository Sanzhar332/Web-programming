<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Form</title>
</head>
<body>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['country'])) {
        $_SESSION['country'] = $_POST['country'];
    }
}
?>

<form method="post" action="">
    <label for="country">Enter your country:</label>
    <input type="text" id="country" name="country" required>
    <button type="submit">Submit</button>
</form>

</body>
</html>
