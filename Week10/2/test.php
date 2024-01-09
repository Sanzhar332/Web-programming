<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
</head>
<body>

<?php
session_start();

if (isset($_SESSION['country'])) {
    echo "<p>Your country is: {$_SESSION['country']}</p>";
} else {
    echo "<p>Please go to index.php to set your country.</p>";
}
?>

</body>
</html>
