<?php
require ('../../../Handlers/DBCONNECT.php');

$CATEGORY = ucfirst(strtolower($_POST['addCategory']));
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

if(!isset($CATEGORY) || empty($CATEGORY) || $CATEGORY == ' '){
    echo "Category is required.";
}
else {
    $sql = "SELECT CATEGORY FROM categories WHERE CATEGORY = '" . $CATEGORY . "'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) == 0){
        $sql = "INSERT INTO product_categories (CATEGORY,IS_ACTIVE) VALUES
        ('".$CATEGORY."','1')";
        $result = mysqli_query($con,$sql);
        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','10','Category is added')";
        $result = mysqli_query($con,$sql);
        echo "Category is added successfully.";
    }
    else{
        echo "Category is already exists.";
    }
}
?>