<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$MEMBER_ID = $_GET['id'];
$COUNTER = $_GET['features'];

$FIRST_NAME = $_POST['EditfName'];
$FIRST_NAME = ucfirst(strtolower($FIRST_NAME));
$LAST_NAME = $_POST['EditlName'];
$LAST_NAME = ucfirst(strtolower($LAST_NAME));
$EMAIL = $_POST['EditEmail'];
$EMAIL = strtolower($EMAIL);

$json = Array();
for($i = 0; $i < $COUNTER ; $i++){
    $json[$i]['FEATURE_ID'] = $_POST['FeatureID'];
    $json[$i]['VALUE'] = $_POST['FEATURE'.$i];
}
if(!isset($FIRST_NAME) || empty($FIRST_NAME) || $FIRST_NAME == ' '){
    echo "First name is required.";
}
elseif(!isset($LAST_NAME) || empty($LAST_NAME) || $LAST_NAME == ' '){
    echo "Last name is required.";
}
else{

        $sql = "UPDATE persons SET FIRST_NAME = '" . $FIRST_NAME . "',LAST_NAME = '" . $LAST_NAME . "',EMAIL = '" . $EMAIL . "' 
            WHERE ID = " . $MEMBER_ID;
        $result = mysqli_query($con, $sql);

        for ($i = 0; $i < $COUNTER; $i++) {
            $sql = "UPDATE person_feature_values SET VALUE = " . $json[$i]['VALUE'] . "WHERE ID = " . $json[$i]['FEATURE_ID'];
            $result = mysqli_query($con, $sql);
        }

        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                    ('" . $DATETIME . "','" . $MAKER_ID . "','6','Member [" . $MEMBER_ID . "] is updated')";
        $result = mysqli_query($con, $sql);
        if($MAKER_ID != 111111){
            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','icon-user','blue','Pages/Admins.php','Member [".$MEMBER_ID."] is updated','0')";
            $result = mysqli_query($con,$sql);
        }
        echo "Member is updated successfully.";
}
?>