<?php

require_once 'DbConnection.php';

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $database, 3306) or die('Ошибка ' . mysqli_error($conn));
$conn->set_charset('utf8');

if (isset($_GET['horse'])) {
    $horse = $_GET['horse'];
    switch ($_GET['horse']) {
        case 'all':
            $query = 'SELECT * FROM `лошадь`';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'acting':
            $query = 'SELECT * FROM `лошадь` where `State` = \'Действующая\' or `State` = \'Действующий\'';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'retired':
            $query = 'SELECT * FROM `лошадь` where `State` = \'Выбыла\' or `State` = \'Выбыл\'';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'mother':
            $query = 'SELECT * FROM `лошадь` where `Gender` = \'Кобыла\' Order by `NickName`';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
                for ($i = 0, $iMax = count($data); $i < $iMax; $i++) {
                    $data[$i]['FullName'] = $data[$i]['NickName'] . ' ' . $data[$i]['Brand'] . '-' . date_format(date_create($data[$i]['BirthDate']), 'y');
                }
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'father':
            $query = 'SELECT * FROM `лошадь` where `Gender` = \'Жеребец\' Order by `NickName`';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
                for ($i = 0, $iMax = count($data); $i < $iMax; $i++) {
                    $data[$i]['FullName'] = $data[$i]['NickName'] . ' ' . $data[$i]['Brand'] . '-' . date_format(date_create($data[$i]['BirthDate']), 'y');
                }
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'last-id':
            $query = 'SELECT * FROM `лошадь` ORDER BY `ID` DESC LIMIT 1';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data['ID'] = $row['ID'];
                $data['GpkNum'] = $row['GpkNum'];
                $data['NickName'] = $row['NickName'];
                $data['Brand'] = $row['Brand'];
                $data['Bloodiness'] = $row['Bloodiness'];
                $data['Color'] = $row['Color'];
                $data['Gender'] = $row['Gender'];
                $data['BirthDate'] = $row['BirthDate'];
                $birthDate = date_create($row['BirthDate']);
                $data['BirthPlace'] = $row['BirthPlace'];
                $data['Owner'] = $row['Owner'];
                $data['MotherID'] = $row['MotherID'];
                $data['FatherID'] = $row['FatherID'];
                $data['State'] = $row['State'];
                $data['FullName'] = $row['NickName'] . ' ' . $row['Brand'] . '-' . date_format($birthDate, 'y');
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'add':
            if (isset($_POST['GpkNum'], $_POST['NickName'], $_POST['Brand'], $_POST['Bloodiness'], $_POST['Color'], $_POST['Gender'], $_POST['BirthDate'],
                $_POST['BirthPlace'], $_POST['Owner'], $_POST['MotherID'], $_POST['FatherID'], $_POST['State'])) {

                $GpkNum = $_POST['GpkNum'];
                $NickName = $_POST['NickName'];
                $Brand = $_POST['Brand'];
                $Bloodiness = $_POST['Bloodiness'];
                $Color = $_POST['Color'];
                $Gender = $_POST['Gender'];
                $BirthDate = $_POST['BirthDate'];
                $BirthPlace = $_POST['BirthPlace'];
                $Owner = $_POST['Owner'];
                $MotherID = $_POST['MotherID'];
                $FatherID = $_POST['FatherID'];
                $State = $_POST['State'];

                $query = "INSERT INTO лошадь (`GpkNum`, `NickName`, `Brand`, `Bloodiness`, `Color`, `Gender`, `BirthDate`, `BirthPlace`,
                    `Owner`, `MotherID`, `FatherID`, `State`) VALUES ('$GpkNum', '$NickName', '$Brand', '$Bloodiness', '$Color', '$Gender',
                                                                      '$BirthDate', '$BirthPlace', '$Owner', '$MotherID', '$FatherID', '$State')";
                $result = mysqli_query($conn, $query) or die('Ошибка ' . mysqli_error($conn));

                echo 'Успешно!';
            }

            break;
        case 'change':
            if (isset($_POST['ID'], $_POST['GpkNum'], $_POST['NickName'], $_POST['Brand'], $_POST['Bloodiness'], $_POST['Color'], $_POST['Gender'], $_POST['BirthDate'],
                $_POST['BirthPlace'], $_POST['Owner'], $_POST['MotherID'], $_POST['FatherID'])) {

                $ID = $_POST['ID'];
                $GpkNum = $_POST['GpkNum'];
                $NickName = $_POST['NickName'];
                $Brand = $_POST['Brand'];
                $Bloodiness = $_POST['Bloodiness'];
                $Color = $_POST['Color'];
                $Gender = $_POST['Gender'];
                $BirthDate = $_POST['BirthDate'];
                $BirthPlace = $_POST['BirthPlace'];
                $Owner = $_POST['Owner'];
                $MotherID = $_POST['MotherID'];
                $FatherID = $_POST['FatherID'];
                $State = $_POST['State'];

                $query = ("Update `лошадь` set `GpkNum` = '$GpkNum', `NickName` = '$NickName', `Brand` = '$Brand', `Bloodiness` = '$Bloodiness', `Color` = '$Color', `Gender` = '$Gender', `BirthDate` = '$BirthDate', 
                    `BirthPlace` = '$BirthPlace', `Owner` = '$Owner', `MotherID` = '$MotherID', `FatherID` = '$FatherID' WHERE `ID` = '$ID'");
                $result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn));

                echo 'Успешно!';
            }

            break;
        case 'change-state':
            if (isset($_POST['ID']) && isset($_POST['State'])) {

                $ID = $_POST['ID'];
                $State = $_POST['State'];

                $query = ("Update `лошадь` set `State` = '$State' WHERE `ID` = '$ID'");
                $result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn));

                echo 'Успешно!';
            }

            break;
        default:
            $query = 'SELECT * FROM `лошадь` Where `ID` =' . $horse;

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data['ID'] = $row['ID'];
                $data['GpkNum'] = $row['GpkNum'];
                $data['NickName'] = $row['NickName'];
                $data['Brand'] = $row['Brand'];
                $data['Bloodiness'] = $row['Bloodiness'];
                $data['Color'] = $row['Color'];
                $data['Gender'] = $row['Gender'];
                $data['BirthDate'] = $row['BirthDate'];
                $birthDate = date_create($row['BirthDate']);
                $data['BirthPlace'] = $row['BirthPlace'];
                $data['Owner'] = $row['Owner'];
                $data['MotherID'] = $row['MotherID'];
                $data['FatherID'] = $row['FatherID'];
                $data['State'] = $row['State'];
                $data['FullName'] = $row['NickName'] . ' ' . $row['Brand'] . '-' . date_format($birthDate, 'y');
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}

if (isset($_GET['search'])) {

    $search = $_GET['search'];
    if (strlen($search) > 0) {
        $query = "SELECT * FROM `лошадь` where `NickName` Like '%" . $search . "%'";
    } else {
        $query = 'SELECT * FROM `лошадь`';
    }

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}