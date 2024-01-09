<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: center;
}
</style>
</head>
<body>

<?php

$cols = 9;
$rows = 9;


echo "<table>";
for ($i = 1; $i <= $rows; $i++) {
  echo "<tr>";
  for ($j = 1; $j <= $cols; $j++) {
    if ($i === 1 || $j === 1) {
      echo "<td style='font-weight: bold; background-color: lightgrey;'>" . ($i * $j) . "</td>";
    } else {
      echo "<td>" . ($i * $j) . "</td>";
    }
  }
  echo "</tr>";
}
echo "</table>";
?>

</body>
</html>
