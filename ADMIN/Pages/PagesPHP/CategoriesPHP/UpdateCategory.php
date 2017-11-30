<?php
require ('../../../Handlers/DBCONNECT.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$CATEGORY_ID = $_GET['id'];
$STATUS = ($_POST['editCategoryVal'] == "true" ? 1 : 0);
$sql = "UPDATE product_categories SET IS_ACTIVE = ".$STATUS." WHERE ID = ".$CATEGORY_ID;
$result = mysqli_query($con,$sql);

$sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','10','Category is updated')";
$result = mysqli_query($con,$sql);

if($STATUS == 1){
    echo "Category is activated successfully.";
}
else{
    echo "Category is deactivated successfully.";
}
?>