<?php
require ('../../../Handlers/DBCONNECT.php');
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$DESIGNER_ID = $_GET['id'];

$sql = "SELECT CD.ID FROM cart_details CD
        INNER JOIN products P ON CD.PRODUCT_ID = P.ID
        INNER JOIN designer_products DP ON P.ID = DP.PRODUCT_ID
        WHERE DP.DESIGNER_ID ='".$DESIGNER_ID."'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    echo 'You cannot update this designer as it has products contained in the order process.';
}
else{
    $sql = "SELECT PRODUCT_ID FROM designer_products WHERE DESIGNER_ID = '".$DESIGNER_ID."'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $sql = "DELETE FROM product_feature_values WHERE PRODUCT_ID ='".$row['PRODUCT_ID']."'";
            $res2 = mysqli_query($con,$sql);

            $sql = "DELETE FROM products_images WHERE PRODUCT_ID ='".$row['PRODUCT_ID']."'";
            $res2 = mysqli_query($con,$sql);

            if($res2){
                $sql = "DELETE FROM products WHERE ID = ".$row['PRODUCT_ID'];
                $result = mysqli_query($con,$sql);
            }
        }
    }


    $sql = "DELETE FROM designers WHERE ID = ".$DESIGNER_ID;
    $result = mysqli_query($con,$sql);
    if($result){
        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','20','Designer is deleted')";
        $result = mysqli_query($con,$sql);

        if($MAKER_ID != 111111){
            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','icon-magic','violet','Pages/Designers.php','Designer [".$DESIGNER_ID."] is deleted','0')";
            $result = mysqli_query($con,$sql);
        }
        echo "Designer is deleted successfully.";
    }
    else{
        echo 'Error occurred, please contact your administrator.';
    }

}
?>