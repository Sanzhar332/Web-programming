<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Refresh Counter</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>

<?php
session_start();

if (!isset($_SESSION['refresh_count'])) {
    $_SESSION['refresh_count'] = 0;
    echo "<p>This is the first time you're visiting this page.</p>";
} else {
    $_SESSION['refresh_count']++;
    echo "<p>Page has been refreshed <strong>{$_SESSION['refresh_count']}</strong> times.</p>";
}
?>

</body>
</html>
