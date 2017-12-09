<?php
require ('../../../Handlers/DBCONNECT.php');

$DESIGNER = ucfirst(strtolower($_POST['addDesigner']));
$DESCRIPTION = $_POST['addDescription'];
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];


if(!isset($DESIGNER) || empty($DESIGNER) || $DESIGNER == ' '){
    echo "Designer is required.";
}
else {
    $sql = "SELECT NAME FROM designers WHERE NAME = '" . $DESIGNER . "'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "Designer is already exists.";
    }
    else{
        $sql = "INSERT INTO designers (NAME,IS_ACTIVE,DESCRIPTION) VALUES
        ('".$DESIGNER."','1','".$DESCRIPTION."')";
        $result2 = mysqli_query($con,$sql);
        if($result2){
            $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','20','Designer is added')";
            $result = mysqli_query($con,$sql);
            if($MAKER_ID != 111111){
                $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','icon-magic','violet','Pages/Designers.php','New designer is added','0')";
                $result = mysqli_query($con,$sql);
            }
            echo "Designer is added successfully.";
        }
        else{
            echo 'Error occurred, please contact your administrator.';
        }
    }
}
?>