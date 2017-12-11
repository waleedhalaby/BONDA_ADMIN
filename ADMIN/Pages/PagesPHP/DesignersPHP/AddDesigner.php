<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$DESIGNER = ucfirst(strtolower($_POST['addDesigner']));
$DESCRIPTION = $_POST['addDescription'];
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];


if(!isset($DESIGNER) || empty($DESIGNER) || $DESIGNER == ' '){
    echo "Designer is required.";
}
else {
    $sql = "INSERT INTO designers (DESIGNER,IS_ACTIVE,DESCRIPTION) VALUES
    ('".$DESIGNER."','1','".$DESCRIPTION."')";
    $result2 = mysqli_query($con,$sql);
    if($result2){
        $sql = "SELECT ID FROM designers WHERE DESIGNER = '" . $DESIGNER . "'";
        $res = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_array($res)) {
            $sql = "INSERT INTO designer_feature_values (DESIGNER_ID,FEATURE_ID,VALUE) VALUES
                ('".$row['ID']."','1','0')";
            $result2 = mysqli_query($con,$sql);
        }

        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                        ('".$DATETIME."','".$MAKER_ID."','20','Designer is added')";
        $result = mysqli_query($con,$sql);
        if($MAKER_ID != 111111){
            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                        ('".$DATETIME."','icon-magic','violet','Pages/Designers.php','New designer is added','0')";
            $result = mysqli_query($con,$sql);
        }

        if (mysqli_num_rows($res) > 0) {
            $ID = 0;
            while ($row = mysqli_fetch_array($res)) {
                $ID = $row['ID'];
            }
            echo $ID;
        }
    }
    else{
        echo 'Error occurred, please contact your administrator.';
    }
}
?>