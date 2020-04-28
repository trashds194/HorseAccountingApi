<?php

require_once 'DbConnection.php';

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $database, 3306) or die('Ошибка ' . mysqli_error($conn));
$conn->set_charset('utf8');

if(isset($_GET['tribaluse'])) {
    $tribaluse = $_GET['tribaluse'];
    switch ($_GET['tribaluse']) {
        case 'add':
            if (isset($_POST['Year'], $_POST['LastDate'], $_POST['FatherFullName'], $_POST['FatherBreed'], $_POST['FatherClass'], $_POST['FoalDate'], $_POST['FoalGender'],
                $_POST['FoalColor'], $_POST['FoalNickName'], $_POST['FoalDestination'], $_POST['FatherID'], $_POST['FoalID'], $_POST['MotherID'])) {

                $Year = $_POST['Year'];
                $LastDate = $_POST['LastDate'];
                $FatherFullName = $_POST['FatherFullName'];
                $FatherBreed = $_POST['FatherBreed'];
                $FatherClass = $_POST['FatherClass'];
                $FoalDate = $_POST['FoalDate'];
                $FoalGender = $_POST['FoalGender'];
                $FoalColor = $_POST['FoalColor'];
                $FoalNickName = $_POST['FoalNickName'];
                $FoalDestination = $_POST['FoalDestination'];
                $FatherID = $_POST['FatherID'];
                $FoalID = $_POST['FoalID'];
                $MotherID = $_POST['MotherID'];

                $query = "INSERT INTO `tribaluse`(`Year`, `LastDate`, `FatherFullName`, `FatherBreed`, `FatherClass`, `FoalDate`, `FoalGender`, `FoalColor`, `FoalNickName`, `FoalDestination`,
                        `FatherID`, `FoalID`, `MotherID`) VALUES ('$Year', '$LastDate', '$FatherFullName', '$FatherBreed', '$FatherClass', '$FoalDate', '$FoalGender', '$FoalColor', '$FoalNickName',
                                                                  '$FoalDestination', '$FatherID', '$FoalID', '$MotherID')";
                $result = mysqli_query($conn, $query) or die('Ошибка ' . mysqli_error($conn));

                echo 'Успешно!';
            }

            break;
        default:
            $query = 'SELECT * FROM `tribaluse` Where `MotherID` =' . $tribaluse;

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $row['LastDate'] = (new DateTime($row['LastDate']))->format('d.m.Y');
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}