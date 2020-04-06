<?php

require_once 'DbConnection.php';

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $database, 3306) or die('Ошибка ' . mysqli_error($conn));
$conn->set_charset('utf8');

if(isset($_GET['progression'])){
    $progression = $_GET['progression'];
    switch ($_GET['progression']){
        case 'add':
            if (isset($_POST['Date'], $_POST['Destination'], $_POST['Comment'], $_POST['HorseID'])) {

                $Date = $_POST['Date'];
                $Destination = $_POST['Destination'];
                $Comment = $_POST['Comment'];
                $HorseID = $_POST['HorseID'];

                $query = "INSERT INTO `движение`(`Date`, `Destination`, `Comment`, `HorseID`) VALUES ('$Date', '$Destination', '$Comment', '$HorseID')";
                $result = mysqli_query($conn, $query) or die('Ошибка ' . mysqli_error($conn));

                echo 'Успешно!';
            }

            break;
        default:
            $query = 'SELECT * FROM `движение` Where `HorseID` =' . $progression;

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}