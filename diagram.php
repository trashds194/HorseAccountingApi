<?php

require_once 'DbConnection.php';

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $database, 3306) or die('Ошибка ' . mysqli_error($conn));
$conn->set_charset('utf8');

if (isset($_GET['diagram'])) {
    $diagram = $_GET['diagram'];
    switch ($_GET['diagram']) {
        case 'gender':
            $query = 'SELECT Gender as Title, COUNT(ID) as Value from horse WHERE Gender = \'Кобыла\' 
UNION 
SELECT Gender as Title, COUNT(ID) as Value from horse WHERE Gender = \'Жеребец\'';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'birth-place':
            $query = 'SELECT `BirthPlace` as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` = \'К/З им 1КА\' 
UNION
SELECT \'Зимовниковский конзавод\' as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` = \'Зимовниковский конзавод\' or `BirthPlace` = \'Зимовниковский к/з\'
UNION
SELECT \'к/з им Буденного\' as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` = \'к/з им Буденного\' or `BirthPlace` = \'к/з им. Буденного\'
UNION
SELECT `BirthPlace` as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` = \'Филиал ПКЗ им Буденного\'
UNION
SELECT `BirthPlace` as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` = \'ООО Агрофирма Целина\'
UNION
SELECT `BirthPlace` as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` = \'Агросоюз Юг Руси\'
UNION
SELECT `BirthPlace` as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` = \'КСО "VOV"\'
UNION
SELECT `BirthPlace` as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` = \'Германия\'
UNION
SELECT `BirthPlace` as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` = \'Белоруссия\'
UNION
SELECT \'Другие коневодческие хозяйства\' as Title, COUNT(ID) as Value from horse WHERE `BirthPlace` != \'ООО Агрофирма Целина\' 
and `BirthPlace` != \'Зимовниковский конзавод\' and `BirthPlace` != \'Зимовниковский к/з\' and `BirthPlace` != \'К/З им 1КА\' 
and `BirthPlace` != \'Белоруссия\' and `BirthPlace` != \'Германия\' and `BirthPlace` != \'КСО "VOV"\' and `BirthPlace` != \'Агросоюз Юг Руси\' 
and `BirthPlace` != \'к/з им Буденного\' and `BirthPlace` != \'к/з им. Буденного\' and `BirthPlace` != \'Филиал ПКЗ им Буденного\'';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'stallion-year':
            $query = 'SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'1994\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 1994
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'1995\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 1995
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'1996\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 1996
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'1997\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 1997
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'1998\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 1998
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'1999\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 1999
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2000\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2000
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2001\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2001
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2002\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2002
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2003\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2003
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2004\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2004
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2005\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2005
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2006\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2006
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2007\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2007
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2008\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2008
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2009\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2009
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2010\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2010
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2011\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2011
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2012\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2012
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2013\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2013
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2014\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2014
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2015\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2015
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2016\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2016
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2017\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2017
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2018\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2018
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2019\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2019
UNION
SELECT \'Жеребцы\' as Title, COUNT(ID) as Value, \'2020\' as Year from horse WHERE Gender = \'Жеребец\' AND Year(BirthDate) = 2020';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
        case 'mare-year':
            $query = 'SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'1994\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 1994
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'1995\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 1995
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'1996\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 1996
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'1997\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 1997
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'1998\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 1998
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'1999\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 1999
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2000\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2000
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2001\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2001
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2002\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2002
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2003\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2003
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2004\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2004
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2005\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2005
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2006\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2006
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2007\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2007
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2008\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2008
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2009\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2009
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2010\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2010
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2011\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2011
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2012\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2012
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2013\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2013
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2014\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2014
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2015\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2015
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2016\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2016
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2017\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2017
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2018\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2018
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2019\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2019
union
SELECT \'Кобылы\' as Title, COUNT(ID) as Value, \'2020\' as Year from horse WHERE Gender = \'Кобыла\' AND Year(BirthDate) = 2020';

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}