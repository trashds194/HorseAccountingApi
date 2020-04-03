<?php

require_once '../DbConnection.php';

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $database, 3306) or die("Ошибка " . mysqli_error($conn));
$conn->set_charset("utf8");

$result = mysqli_query($conn, "SELECT * FROM `лошадь`");

while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);