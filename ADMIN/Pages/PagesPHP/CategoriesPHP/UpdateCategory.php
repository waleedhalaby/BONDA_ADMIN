<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$CATEGORY_ID = $_GET['id'];
$STATUS = ($_POST['editCategoryVal'] == "true" ? 1 : 0);
$sql = "SELECT CD.ID FROM cart_details CD
        INNER JOIN products P ON CD.PRODUCT_ID = P.ID
        WHERE P.CATEGORY_ID ='".$CATEGORY_ID."'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
    echo 'You cannot update this collection as it has products contained in the order process.';
}
else {
    $sql = "UPDATE categories SET IS_ACTIVE = " . $STATUS . " WHERE ID = " . $CATEGORY_ID;
    $result = mysqli_query($con, $sql);

    if($result){
        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                    ('" . $DATETIME . "','" . $MAKER_ID . "','10','Collection is updated')";
        $result = mysqli_query($con, $sql);

        if ($STATUS == 1) {
            echo "Collection is activated successfully.";
        } else {
            echo "Collection is deactivated successfully.";
        }
    }
    else{
        echo 'Error occurred, please contact your administrator.';
    }
}
?>