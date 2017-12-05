<?php
require ('../../../Handlers/DBCONNECT.php');
session_start();
$ID = $_SESSION['id'];

if($_GET['id'] != 0){
    $ID = $_GET['id'];
}

$sql = "SELECT DISTINCT PP.ID, P.PRIVILEGE, P.CATEGORY_ID, PP.VALUE FROM person_privileges PP
            INNER JOIN privileges P ON PP.PRIVILEGE_ID = P.ID WHERE PP.PERSON_ID = ".$ID." AND P.CATEGORY_ID < 10";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result) > 0){
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $json[$i]['ID'] = $row['ID'];
        $json[$i]['PRIVILEGE'] = $row['PRIVILEGE'];
        $json[$i]['CATEGORY'] = GetCategory($row['CATEGORY_ID']);
        $json[$i]['VALUE'] = $row['VALUE'];
        $i++;
    }

    echo json_encode($json);
}

function GetCategory($id){
    $category = '';
    switch($id){
        case '3':
            $category = 'PRODUCTS_CATEGORIES';
            break;
        case '4':
            $category = 'ORDERS';
            break;
        case '5':
            $category = 'ADMINISTRATION';
            break;
        case '6':
            $category = 'PRODUCT_FEATURES';
            break;
        case '7':
            $category = 'LOG_ACTIVITIES';
            break;
    }
    return $category;
}
?>