<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

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

$DESIGNER = $_POST['editDesigner'];
$CATEGORY = $_POST['editCategory'];

$sql = "UPDATE products SET NAME='".$NAME."', PRICE='".$PRICE."', DESCRIPTION='".$DESCRIPTION."', DESIGNER_ID = '".$DESIGNER."', CATEGORY_ID = '".$CATEGORY."'
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
if($MAKER_ID != 111111){
    $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','icon-gift','pink','Pages/Products.php','Product [".$PRODUCT_ID."] is updated','0')";
    $result = mysqli_query($con,$sql);
}

echo $PRODUCT_ID;

?>