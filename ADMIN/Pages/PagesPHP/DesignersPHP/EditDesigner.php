<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$DESIGNER = ucfirst(strtolower($_POST['editDesigner']));
$DESCRIPTION = $_POST['editDescription'];
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];
$DESIGNER_ID = $_GET['id'];

if(!isset($DESIGNER) || empty($DESIGNER) || $DESIGNER == ' '){
    echo "Designer is required.";
}
else {
    $sql = "UPDATE designers SET DESIGNER = '".$DESIGNER."', DESCRIPTION = '".$DESCRIPTION."' WHERE ID = '".$DESIGNER_ID."'";
    $result = mysqli_query($con,$sql);
    if($result){
        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                            ('".$DATETIME."','".$MAKER_ID."','20','Designer [".$DESIGNER."] is updated')";
        $result = mysqli_query($con,$sql);
        if($MAKER_ID != 111111){
            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                            ('".$DATETIME."','icon-magic','violet','Pages/Designers.php','Designer [".$DESIGNER."] is updated','0')";
            $result = mysqli_query($con,$sql);
        }
        echo $DESIGNER_ID;
    }
    else{
        echo 'Error occurred, please contact your administrator.';
    }
}
?>