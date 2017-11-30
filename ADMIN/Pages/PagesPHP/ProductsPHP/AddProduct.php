<?php
require ('../../../Handlers/DBCONNECT.php');
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$SKU_ID = null;
if(isset($_POST['addSKUID'])|| !empty($_POST['addSKUID'])){
    $SKU_ID = strtoupper($_POST['addSKUID']);
}
$CHANGES = null;
if(isset($_GET['values']) || !empty($_GET['values'])){
    $CHANGES = explode('$',$_GET['values']);
}

$IDS = null;
if(isset($_GET['ids']) || !empty($_GET['ids'])){
    $IDS = explode('$',$_GET['ids']);
}

$NAME = ucfirst(strtolower($_POST['addName']));
$PRICE = floatval($_POST['addPrice']);
$CURRENCY = $_POST['addCurrency'];
$DESCRIPTION = null;
if(isset($_POST['addDescription'])|| !empty($_POST['addDescription'])){
    $DESCRIPTION = ucfirst(strtolower($_POST['addDescription']));
    $DESCRIPTION = addcslashes($DESCRIPTION,"';");
}

$CATEGORY = $_POST['addCategory'];

$sql = "INSERT INTO products (SKU_ID,NAME,PRICE,CURRENCY_ID,DESCRIPTION,CATEGORY_ID)
        VALUES ('" . $SKU_ID . "','" . $NAME . "','" . $PRICE . "','" . $CURRENCY . "','" . $DESCRIPTION . "','" . $CATEGORY . "')";
$result = mysqli_query($con, $sql);


$sql = "SELECT ID FROM products WHERE NAME = '" . $NAME . "'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $ID = $row['ID'];
         $i = 0;
         if($CHANGES[0] != ''){
             foreach ($CHANGES AS $CHANGE){
                 if($CHANGE != '' && $IDS[$i] != ''){
                     $sql = "INSERT INTO product_feature_values (PRODUCT_ID,FEATURE_ID,VALUE) VALUES
                    ('".$ID."','".$IDS[$i]."','".$CHANGE."')";
                     $result2 = mysqli_query($con,$sql);
                 }
                 $i++;
             }
         }
         else{
             foreach ($IDS as $ID1){
                 $sql = "INSERT INTO product_feature_values (PRODUCT_ID,FEATURE_ID,VALUE) VALUES
                    ('".$ID."','".$ID1."',NULL)";
                 $result2 = mysqli_query($con,$sql);
             }
         }
        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','9','Product [".$ID."] is added')";
        $result4 = mysqli_query($con,$sql);
        echo $ID;
    }
}
else{
    echo null;
}
?>