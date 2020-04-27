<?php

require_once 'DbConnection.php';

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $database, 3306) or die('Ошибка ' . mysqli_error($conn));
$conn->set_charset('utf8');

if (isset($_GET['scoring'])) {
    $scoring = $_GET['scoring'];
    switch ($_GET['scoring']) {
        case 'add':
            if (isset($_POST['Date'], $_POST['Age'], $_POST['Boniter'], $_POST['Origin'], $_POST['Typicality'], $_POST['Measurements'], $_POST['Exterior'], $_POST['WorkingCapacity'],
                $_POST['OffspringQuality'], $_POST['TheClass'], $_POST['Comment'], $_POST['HorseID'])) {

                $Date = $_POST['Date'];
                $Age = $_POST['Age'];
                $Boniter = $_POST['Boniter'];
                $Origin = $_POST['Origin'];
                $Typicality = $_POST['Typicality'];
                $Measurements = $_POST['Measurements'];
                $Exterior = $_POST['Exterior'];
                $WorkingCapacity = $_POST['WorkingCapacity'];
                $OffspringQuality = $_POST['OffspringQuality'];
                $TheClass = $_POST['TheClass'];
                $Comment = $_POST['Comment'];
                $HorseID = $_POST['HorseID'];

                $query = "INSERT INTO `scoring`(`Date`, `Age`, `Boniter`, `Origin`, `Typicality`, `Measurements`, `Exterior`, `WorkingCapacity`, `OffspringQuality`, `TheClass`, `Comment`, `HorseID`)
VALUES ('$Date', '$Age', '$Boniter', '$Origin', '$Typicality', '$Measurements', '$Exterior', '$WorkingCapacity', '$OffspringQuality', '$TheClass', '$Comment', '$HorseID')";
                $result = mysqli_query($conn, $query) or die('Ошибка ' . mysqli_error($conn));

                echo 'Успешно!';
            }

            break;
        default:
            $query = 'SELECT * FROM `scoring` Where `HorseID` = ' . $scoring;

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}