<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$CATEGORY = ucfirst(strtolower($_POST['editCategory']));
$DESIGNER = $_POST['editDesigner'];
$DESCRIPTION = ucfirst($_POST['editDescription']);
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];
$CATEGORY_ID = $_GET['id'];

if(!isset($CATEGORY) || empty($CATEGORY) || $CATEGORY == ' '){
    echo "Collection is required.";
}
else {

    $sql = "UPDATE categories SET CATEGORY = '".$CATEGORY."', DESCRIPTION = '".$DESCRIPTION."', DESIGNER_ID = '".$DESIGNER."' WHERE ID = '".$CATEGORY_ID."'";
    $result = mysqli_query($con,$sql);

    if($result){
        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                            ('".$DATETIME."','".$MAKER_ID."','10','Collection [".$CATEGORY."] is updated')";
        $result = mysqli_query($con,$sql);
        if($MAKER_ID != 111111){
            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                            ('".$DATETIME."','icon-tasks','orange','Pages/Categories.php','Collection [".$CATEGORY."] is updated','0')";
            $result = mysqli_query($con,$sql);
        }

        echo $CATEGORY_ID;
    }
    else{
        echo 'Error occurred, please contact your administrator.';
    }
}
?>