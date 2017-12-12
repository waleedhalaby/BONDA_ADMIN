<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$PRODUCT_ID = $_GET['id'];

$sql = "SELECT ID FROM cart_details WHERE PRODUCT_ID='".$PRODUCT_ID."'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    echo 'You cannot update this product it is contained in the order process.';
}
else{
    $sql = "DELETE FROM product_feature_values WHERE PRODUCT_ID = ".$PRODUCT_ID;
    $result = mysqli_query($con,$sql);

    $sql = "SELECT PI.IMAGE_PATH FROM products_images PI
            INNER JOIN products P ON PI.PRODUCT_ID = P.ID 
            WHERE P.ID = ".$PRODUCT_ID;
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result)){
        $IMAGE_PATH = $row['IMAGE_PATH'];
        $filename = $_SERVER['SERVER_NAME'].':8080/BONDA_ADMIN/ADMIN/'.$IMAGE_PATH;
        if (file_exists($filename))
        {
            unlink($filename);
        }
    }

    $sql = "DELETE FROM products_images WHERE PRODUCT_ID = ".$PRODUCT_ID;
    $result = mysqli_query($con,$sql);

    if($result){
        $sql = "DELETE FROM products WHERE ID = ".$PRODUCT_ID;
        $result = mysqli_query($con,$sql);

        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','9','Product [".$PRODUCT_ID."] is deleted')";
        $result = mysqli_query($con,$sql);
        if($MAKER_ID != 111111){
            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,'COLOR',PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','icon-gift','pink','Pages/Products.php','Product [".$PRODUCT_ID."] is deleted','0')";
            $result = mysqli_query($con,$sql);
        }
        echo "Product [".$PRODUCT_ID."] is deleted successfully.";
    }
}
?>