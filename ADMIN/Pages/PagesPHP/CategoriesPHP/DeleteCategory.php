<?php
require ('../../../Handlers/DBCONNECT.php');
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$CATEGORY_ID = $_GET['id'];

$sql = "SELECT CD.ID FROM cart_details CD
        INNER JOIN products P ON CD.PRODUCT_ID = P.ID
        WHERE P.CATEGORY_ID ='".$CATEGORY_ID."'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    echo 'You cannot delete this product as it is contained in orders.';
}
else{
    $sql = "DELETE PFV FROM product_feature_values PFV INNER JOIN products P ON PFV.PRODUCT_ID = P.ID
        WHERE P.CATEGORY_ID ='".$CATEGORY_ID."'";
    $result = mysqli_query($con,$sql);

    $sql = "DELETE PI FROM products_images PI INNER JOIN products P ON PI.PRODUCT_ID = P.ID
        WHERE P.CATEGORY_ID ='".$CATEGORY_ID."'";
    $result = mysqli_query($con,$sql);

    if($result){
        $sql = "DELETE FROM products WHERE CATEGORY_ID = ".$CATEGORY_ID;
        $result = mysqli_query($con,$sql);

        $sql = "DELETE FROM product_categories WHERE ID = ".$CATEGORY_ID;
        $result = mysqli_query($con,$sql);

        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','10','Category is deleted')";
        $result = mysqli_query($con,$sql);

        if($MAKER_ID != 111111){
            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','icon-tasks','orange','Pages/Categories.php','Category [".$CATEGORY_ID."] is deleted','0')";
            $result = mysqli_query($con,$sql);
        }
        echo "Category is deleted successfully.";
    }
}
?>