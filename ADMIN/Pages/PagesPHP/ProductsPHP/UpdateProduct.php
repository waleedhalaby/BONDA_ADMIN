<?php
require ('../../../Handlers/DBCONNECT.php');
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$CHANGES = null;
if(isset($_GET['values']) ||empty($_GET['values'])){
    $CHANGES = explode('$',$_GET['values']);
}

$IDS = null;
if(isset($_GET['featureids']) ||empty($_GET['featureids'])){
    $IDS = explode('$',$_GET['featureids']);
}

$PRODUCT_ID = $_GET['id'];

$NAME = ucfirst(strtolower($_POST['editName']));
$PRICE = floatval($_POST['editPrice']);
$DESCRIPTION = null;
if(isset($_POST['editDescription'])||empty($_POST['editDescription'])){
    $DESCRIPTION = ucfirst(strtolower($_POST['editDescription']));
    $DESCRIPTION = addcslashes($DESCRIPTION,"';");
}

$sql = "UPDATE products SET NAME='".$NAME."', PRICE='".$PRICE."', DESCRIPTION='".$DESCRIPTION."'
        WHERE ID=".$PRODUCT_ID;
$result = mysqli_query($con, $sql);

$i = 0;
foreach($IDS AS $ID){
    $sql = "UPDATE product_feature_values SET VALUE = '".$CHANGES[$i]."' WHERE ID = '".$ID."'";
    $result = mysqli_query($con,$sql);
    $i++;
}

$sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','9','Product [".$PRODUCT_ID."] is updated')";
$result = mysqli_query($con,$sql);

?>