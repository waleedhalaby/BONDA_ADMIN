<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$DESIGNER_ID = $_GET['id'];

$sql = "SELECT CD.ID FROM cart_details CD
        INNER JOIN products P ON CD.PRODUCT_ID = P.ID
        WHERE P.DESIGNER_ID ='".$DESIGNER_ID."'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    echo 'You cannot update this designer as it has products contained in the order process.';
}
else {
    $sql = "DELETE PFV FROM product_feature_values PFV
            INNER JOIN products P ON PFV.PRODUCT_ID = P.ID 
            WHERE P.DESIGNER_ID ='" . $DESIGNER_ID . "'";
    $res2 = mysqli_query($con, $sql);

    $sql = "SELECT PI.IMAGE_PATH FROM products_images PI
            INNER JOIN products P ON PI.PRODUCT_ID = P.ID 
            WHERE P.DESIGNER_ID = ".$DESIGNER_ID;
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result)){
        $IMAGE_PATH = $row['IMAGE_PATH'];
        $filename = $_SERVER['SERVER_NAME'].':8080/BONDA_ADMIN/ADMIN/'.$IMAGE_PATH;
        if (file_exists($filename))
        {
            unlink($filename);
        }
    }

    $sql = "DELETE PI FROM products_images PI
            INNER JOIN products P ON PI.PRODUCT_ID = P.ID 
            WHERE DESIGNER_ID ='" . $DESIGNER_ID . "'";
    $res2 = mysqli_query($con, $sql);

    if ($res2) {
        $sql = "DELETE FROM products WHERE DESIGNER_ID = " . $DESIGNER_ID;
        $result = mysqli_query($con, $sql);


        $sql = "SELECT IMAGE_PATH FROM categories WHERE DESIGNER_ID = ".$DESIGNER_ID;
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)){
            $IMAGE_PATH = $row['IMAGE_PATH'];
            $filename = $_SERVER['SERVER_NAME'].':8080/BONDA_ADMIN/ADMIN/'.$IMAGE_PATH;
            if (file_exists($filename))
            {
                unlink($filename);
            }
        }

        $sql = "DELETE FROM categories WHERE DESIGNER_ID ='" . $DESIGNER_ID . "'";
        $res2 = mysqli_query($con, $sql);

        $sql = "DELETE DFV FROM designer_feature_values DFV
            WHERE DFV.DESIGNER_ID ='" . $DESIGNER_ID . "'";
        $res2 = mysqli_query($con, $sql);

        $sql = "SELECT IMAGE_PATH FROM designers WHERE ID = ".$DESIGNER_ID;
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)){
            $IMAGE_PATH = $row['IMAGE_PATH'];
            $filename = $_SERVER['SERVER_NAME'].':8080/BONDA_ADMIN/ADMIN/'.$IMAGE_PATH;
            if (file_exists($filename))
            {
                unlink($filename);
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
                                ('".$DATETIME."','icon-magic','violet','Pages/Designers.php','Designer is deleted','0')";
                $result = mysqli_query($con,$sql);
            }
            echo "Designer is deleted successfully.";
        }
        else{
            echo 'Error occurred, please contact your administrator.';
        }
    }
}
?>