<!DOCTYPE html>
<html>
<head>
    <title>Confirmation Page</title>
    <link rel="stylesheet" type="text/css" href="buyagrade.css" />
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['student_name'];
    $cardNumber = $_POST['card_number'];
    $cardType = $_POST['card_type'];
    $section = $_POST['section'];

    // Check if the user has left any fields blank
    if (empty($name) || empty($cardNumber) || empty($cardType) || empty($section)) {
        echo "<h2>Sorry</h2>";
        echo "<p>You didn't fill out the form completely. <a href=\"buyagrade.html\">Try again?</a></p>";
    } else {
        // Check for the correct number of digits (16 digits) and optional hyphens
        if (!preg_match('/^(\d{4}-?){3}\d{4}$/', $cardNumber)) {
            echo "<h2>Sorry</h2>";
            echo "<p>Please enter a valid 16-digit credit card number. <a href=\"buyagrade.html\">Try again?</a></p>";
        } else {
            // Remove hyphens from the card number
            $cardNumber = str_replace('-', '', $cardNumber);

            // Check if the card number starts with "4" for Visa or "5" for MasterCard
            if (!(substr($cardNumber, 0, 1) == '4' && $cardType == 'visa') &&
                !(substr($cardNumber, 0, 1) == '5' && $cardType == 'mastercard')) {
                echo "<h2>Sorry</h2>";
                echo "<p>Invalid credit card type or number. <a href=\"buyagrade.html\">Try again?</a></p>";
            } else {
                // Validate credit card number using the Luhn Algorithm
                if (!isLuhnValid($cardNumber)) {
                    echo "<h2>Sorry</h2>";
                    echo "<p>Invalid credit card number. <a href=\"buyagrade.html\">Try again?</a></p>";
                } else {
                    $data = "$name;$section;$cardNumber;$cardType\n";
                    file_put_contents('suckers.txt', $data, FILE_APPEND | LOCK_EX);

                    echo "<h2>Confirmation Page</h2>";
                    echo "<p>Thank you, $name, for your purchase.</p>";
                    echo "<p>Your section: $section</p>";
                    echo "<p>Your credit card number: $cardNumber</p>";
                    echo "<p>Your credit card type: $cardType</p>";
                    echo "<p>Your grade will be emailed to you shortly. Have a nice day!</p>";
                    echo "<h3>Contents of suckers.txt:</h3>";
                    echo "<pre>" . htmlspecialchars(file_get_contents('suckers.txt')) . "</pre>";
                }
            }
        }
    }
} else {
    echo "<h2>Error:</h2>";
    echo "<p>Invalid request. Please submit the form.</p>";
}

function isLuhnValid($number) {
    $sum = 0; 
    $length = strlen($number);
    $parity = $length % 2;

    for ($i = 0; $i < $length; $i++) {
        $digit = (int)$number[$i];
        if ($i % 2 == $parity) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
        $sum += $digit;
    }

    return ($sum % 10 == 0);
}
?>
</body>
</html>
