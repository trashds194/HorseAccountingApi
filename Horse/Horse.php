<?php

require_once '../DbConnection.php';

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $database, 3306) or die('Ошибка ' . mysqli_error($conn));
$conn->set_charset('utf8');

if (isset($_GET['gethorse'])) {
    $gethorse = $_GET['gethorse'];
    switch ($_GET['gethorse']) {
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
        default:
            $query = 'SELECT * FROM `лошадь` Where `ID` =' . $gethorse;

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