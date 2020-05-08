<?php

require_once 'DbConnection.php';

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $database, 3306) or die('Ошибка ' . mysqli_error($conn));
$conn->set_charset('utf8');

if (isset($_GET['horse'])) {
    $horse = $_GET['horse'];
    switch ($_GET['horse']) {
        case 'all':
            $query = 'SELECT child.*, 
            (SELECT Concat(mother.NickName, \' \', mother.Brand, \'-\', DATE_FORMAT(mother.BirthDate, \'%y\')) from horse mother WHERE mother.ID = child.MotherID) as MotherFullName, 
            (SELECT Concat(father.NickName, \' \', father.Brand, \'-\', DATE_FORMAT(father.BirthDate, \'%y\')) from horse father WHERE father.ID = child.FatherID) as FatherFullName 
            FROM horse child order by if(child.NickName = \'\' or child.NickName is null,1,0), child.NickName';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $row['BirthDate'] = (new DateTime($row['BirthDate']))->format('d.m.Y');
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'acting':
            $query = 'SELECT child.*, 
            (SELECT Concat(mother.NickName, \' \', mother.Brand, \'-\', DATE_FORMAT(mother.BirthDate, \'%y\')) from horse mother WHERE mother.ID = child.MotherID) as MotherFullName, 
            (SELECT Concat(father.NickName, \' \', father.Brand, \'-\', DATE_FORMAT(father.BirthDate, \'%y\')) from horse father WHERE father.ID = child.FatherID) as FatherFullName 
            FROM horse child where child.State = \'Действующая\' or child.State = \'Действующий\' order by if(child.NickName = \'\' or child.NickName is null,1,0), child.NickName';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $row['BirthDate'] = (new DateTime($row['BirthDate']))->format('d.m.Y');
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'retired':
            $query = 'SELECT child.*, 
            (SELECT Concat(mother.NickName, \' \', mother.Brand, \'-\', DATE_FORMAT(mother.BirthDate, \'%y\')) from horse mother WHERE mother.ID = child.MotherID) as MotherFullName, 
            (SELECT Concat(father.NickName, \' \', father.Brand, \'-\', DATE_FORMAT(father.BirthDate, \'%y\')) from horse father WHERE father.ID = child.FatherID) as FatherFullName 
            FROM horse child where child.State = \'Выбыла\' or child.State = \'Выбыл\' order by if(child.NickName = \'\' or child.NickName is null,1,0), child.NickName';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $row['BirthDate'] = (new DateTime($row['BirthDate']))->format('d.m.Y');
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'mother':
            $query = 'SELECT child.*,
			Concat(child.NickName, \' \', child.Brand, \'-\', DATE_FORMAT(child.BirthDate, \'%y\')) as FullName,
            (SELECT Concat(mother.NickName, \' \', mother.Brand, \'-\', DATE_FORMAT(mother.BirthDate, \'%y\')) from horse mother WHERE mother.ID = child.MotherID) as MotherFullName, 
            (SELECT Concat(father.NickName, \' \', father.Brand, \'-\', DATE_FORMAT(father.BirthDate, \'%y\')) from horse father WHERE father.ID = child.FatherID) as FatherFullName 
            FROM horse child where child.Gender = \'Кобыла\' order by if(child.NickName = \'\' or child.NickName is null,1,0), child.NickName';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $row['BirthDate'] = (new DateTime($row['BirthDate']))->format('d.m.Y');
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'father':
            $query = 'SELECT child.*,
			Concat(child.NickName, \' \', child.Brand, \'-\', DATE_FORMAT(child.BirthDate, \'%y\')) as FullName,
            (SELECT Concat(mother.NickName, \' \', mother.Brand, \'-\', DATE_FORMAT(mother.BirthDate, \'%y\')) from horse mother WHERE mother.ID = child.MotherID) as MotherFullName, 
            (SELECT Concat(father.NickName, \' \', father.Brand, \'-\', DATE_FORMAT(father.BirthDate, \'%y\')) from horse father WHERE father.ID = child.FatherID) as FatherFullName 
            FROM horse child where child.Gender = \'Жеребец\' order by if(child.NickName = \'\' or child.NickName is null,1,0), child.NickName';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $row['BirthDate'] = (new DateTime($row['BirthDate']))->format('d.m.Y');
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'last-id':
            $query = 'SELECT * FROM `horse` ORDER BY `ID` DESC LIMIT 1';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data['ID'] = $row['ID'];
                $data['GpkNum'] = $row['GpkNum'];
                $data['NickName'] = $row['NickName'];
                $data['Brand'] = $row['Brand'];
                $data['Bloodiness'] = $row['Bloodiness'];
                $data['Color'] = $row['Color'];
                $data['Breed'] = $row['Breed'];
                $data['TheClass'] = $row['TheClass'];
                $data['ChipNumber'] = $row['ChipNumber'];
                $data['Gender'] = $row['Gender'];
                $row['BirthDate'] = (new DateTime($row['BirthDate']))->format('d.m.Y');
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
            if (isset($_POST['GpkNum'], $_POST['NickName'], $_POST['Brand'], $_POST['Bloodiness'], $_POST['Color'], $_POST['Breed'], $_POST['TheClass'],
                $_POST['ChipNumber'], $_POST['Gender'], $_POST['BirthDate'], $_POST['BirthPlace'], $_POST['Owner'], $_POST['MotherID'], $_POST['FatherID'], $_POST['State'])) {

                $GpkNum = $_POST['GpkNum'];
                $NickName = $_POST['NickName'];
                $Brand = $_POST['Brand'];
                $Bloodiness = $_POST['Bloodiness'];
                $Color = $_POST['Color'];
                $Breed = $_POST['Breed'];
                $TheClass = $_POST['TheClass'];
                $ChipNumber = $_POST['ChipNumber'];
                $Gender = $_POST['Gender'];
                $BirthDate = $_POST['BirthDate'];
                $BirthPlace = $_POST['BirthPlace'];
                $Owner = $_POST['Owner'];
                $MotherID = $_POST['MotherID'];
                $FatherID = $_POST['FatherID'];
                $State = $_POST['State'];

                $query = "INSERT INTO `horse` (`GpkNum`, `NickName`, `Brand`, `Bloodiness`, `Color`, `Breed`, `TheClass`, `ChipNumber`, `Gender`, `BirthDate`, `BirthPlace`,
                    `Owner`, `MotherID`, `FatherID`, `State`) VALUES ('$GpkNum', '$NickName', '$Brand', '$Bloodiness', '$Color', '$Breed', '$TheClass',
                                                                      '$ChipNumber', '$Gender', '$BirthDate', '$BirthPlace', '$Owner', '$MotherID', '$FatherID', '$State')";
                $result = mysqli_query($conn, $query) or die('Ошибка ' . mysqli_error($conn));

                echo 'Успешно!';
            }

            break;
        case 'change':
            if (isset($_POST['ID'], $_POST['GpkNum'], $_POST['NickName'], $_POST['Brand'], $_POST['Bloodiness'], $_POST['Color'], $_POST['Breed'], $_POST['TheClass'],
                $_POST['ChipNumber'], $_POST['Gender'], $_POST['BirthDate'], $_POST['BirthPlace'], $_POST['Owner'], $_POST['MotherID'], $_POST['FatherID'])) {

                $ID = $_POST['ID'];
                $GpkNum = $_POST['GpkNum'];
                $NickName = $_POST['NickName'];
                $Brand = $_POST['Brand'];
                $Bloodiness = $_POST['Bloodiness'];
                $Color = $_POST['Color'];
                $Breed = $_POST['Breed'];
                $TheClass = $_POST['TheClass'];
                $ChipNumber = $_POST['ChipNumber'];
                $Gender = $_POST['Gender'];
                $BirthDate = $_POST['BirthDate'];
                $BirthPlace = $_POST['BirthPlace'];
                $Owner = $_POST['Owner'];
                $MotherID = $_POST['MotherID'];
                $FatherID = $_POST['FatherID'];
                $State = $_POST['State'];

                $query = ("Update `horse` set `GpkNum` = '$GpkNum', `NickName` = '$NickName', `Brand` = '$Brand', `Bloodiness` = '$Bloodiness', `Color` = '$Color',
                   `Breed` = '$Breed', `TheClass` = '$TheClass', `ChipNumber` = '$ChipNumber', `Gender` = '$Gender', `BirthDate` = '$BirthDate', `BirthPlace` = '$BirthPlace', `Owner` = '$Owner',
                   `MotherID` = '$MotherID', `FatherID` = '$FatherID' WHERE `ID` = '$ID'");
                $result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn));

                echo 'Успешно!';
            }

            break;
        case 'change-class':
            if (isset($_POST['Breed'], $_POST['TheClass'], $_POST['ID'])) {

                $Breed = $_POST['Breed'];
                $TheClass = $_POST['TheClass'];
                $ID = $_POST['ID'];

                $query = ("Update `horse` set `Breed` = '$Breed', `TheClass` = '$TheClass' WHERE `ID` = '$ID'");
                $result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn));

                echo 'Успешно!';
            }
            break;
        case 'change-state':
            if (isset($_POST['ID']) && isset($_POST['State'])) {

                $ID = $_POST['ID'];
                $State = $_POST['State'];

                $query = ("Update `horse` set `State` = '$State' WHERE `ID` = '$ID'");
                $result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn));

                echo 'Успешно!';
            }

            break;
        default:
            $query = 'SELECT * FROM `horse` Where `ID` =' . $horse;

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data['ID'] = $row['ID'];
                $data['GpkNum'] = $row['GpkNum'];
                $data['NickName'] = $row['NickName'];
                $data['Brand'] = $row['Brand'];
                $data['Bloodiness'] = $row['Bloodiness'];
                $data['Color'] = $row['Color'];
                $data['Breed'] = $row['Breed'];
                $data['TheClass'] = $row['TheClass'];
                $data['ChipNumber'] = $row['ChipNumber'];
                $data['Gender'] = $row['Gender'];
                $row['BirthDate'] = (new DateTime($row['BirthDate']))->format('d.m.Y');
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
        $query = "SELECT child.*,
			Concat(child.NickName, ' ', child.Brand, '-', DATE_FORMAT(child.BirthDate, '%y')) as FullName,
            (SELECT Concat(mother.NickName, ' ', mother.Brand, '-', DATE_FORMAT(mother.BirthDate, '%y')) from horse mother WHERE mother.ID = child.MotherID) as MotherFullName, 
            (SELECT Concat(father.NickName, ' ', father.Brand, '-', DATE_FORMAT(father.BirthDate, '%y')) from horse father WHERE father.ID = child.FatherID) as FatherFullName 
            FROM horse child where child.NickName Like '%" . $search . "%' order by if(child.NickName = '' or child.NickName is null,1,0), child.NickName";
    } else {
        $query = 'SELECT * FROM `horse`';
    }

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $row['BirthDate'] = (new DateTime($row['BirthDate']))->format('d.m.Y');
        $data[] = $row;
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

if (isset($_GET['father'])) {

    $father = $_GET['father'];

    $query = "SELECT child.*,
			Concat(child.NickName, ' ', child.Brand, '-', DATE_FORMAT(child.BirthDate, '%y')) as FullName,
            (SELECT Concat(mother.NickName, ' ', mother.Brand, '-', DATE_FORMAT(mother.BirthDate, '%y')) from horse mother WHERE mother.ID = child.MotherID) as MotherFullName, 
            (SELECT Concat(father.NickName, ' ', father.Brand, '-', DATE_FORMAT(father.BirthDate, '%y')) from horse father WHERE father.ID = child.FatherID) as FatherFullName 
            FROM horse child where child.FatherID = '$father' order by if(child.NickName = '' or child.NickName is null,1,0), child.NickName";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $row['BirthDate'] = (new DateTime($row['BirthDate']))->format('d.m.Y');
        $data[] = $row;
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}