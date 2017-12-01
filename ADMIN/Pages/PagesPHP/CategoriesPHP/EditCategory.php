<?php
require ('../../../Handlers/DBCONNECT.php');

$CATEGORY = ucfirst(strtolower($_POST['editCategory']));
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];
$CATEGORY_ID = $_GET['id'];

if(!isset($CATEGORY) || empty($CATEGORY) || $CATEGORY == ' '){
    echo "Category is required.";
}
else {
    $sql = "SELECT CATEGORY FROM product_categories WHERE CATEGORY = '" . $CATEGORY . "'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "Category is already exists.";
    }
    else{
        $sql = "UPDATE product_categories SET CATEGORY = '".$CATEGORY."'";
        $result = mysqli_query($con,$sql);
        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','10','Category is added')";
        $result = mysqli_query($con,$sql);
        echo "Category is updated successfully.";
    }
}
?>