<?php
require ('../../../Handlers/DBCONNECT.php');

$CHANGES = null;
if(isset($_GET['values']) ||empty($_GET['values'])){
    $CHANGES = explode('$',$_GET['values']);
}

$IDS = null;
if(isset($_GET['featureids']) ||empty($_GET['featureids'])){
    $IDS = explode('$',$_GET['featureids']);
}

$ID = $_GET['id'];

$NAME = ucfirst(strtolower($_POST['editName']));
$PRICE = floatval($_POST['editPrice']);
$DESCRIPTION = null;
if(isset($_POST['editDescription'])||empty($_POST['editDescription'])){
    $DESCRIPTION = ucfirst(strtolower($_POST['editDescription']));
    $DESCRIPTION = addcslashes($DESCRIPTION,"';");
}

$sql = "UPDATE PRODUCTS SET NAME='".$NAME."', PRICE='".$PRICE."', DESCRIPTION='".$DESCRIPTION."'
        WHERE ID=".$ID;
$result = mysqli_query($con, $sql);

$i = 0;
foreach($IDS AS $ID){
    $sql = "UPDATE PRODUCT_FEATURE_VALUES SET VALUE = '".$CHANGES[$i]."' WHERE ID = '".$ID."'";
    $result = mysqli_query($con,$sql);
    $i++;
}
?>