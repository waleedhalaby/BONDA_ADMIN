<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$CATEGORY = ucfirst(strtolower($_POST['addCategory']));
$DESCRIPTION = ucfirst($_POST['addDescription']);
$DESIGNER = $_POST['addDesigner'];
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

if(!isset($CATEGORY) || empty($CATEGORY) || $CATEGORY == ' '){
    echo "Collection is required.";
}
elseif(!isset($DESIGNER) || empty($DESIGNER) || $DESIGNER == '0'){
    echo "Designer is required";
}
else {
    $sql = "INSERT INTO categories (CATEGORY,DESCRIPTION,DESIGNER_ID,IS_ACTIVE) VALUES
    ('".$CATEGORY."','".$DESCRIPTION."','".$DESIGNER."','1')";
    $result = mysqli_query($con,$sql);
    if($result){

        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                            ('".$DATETIME."','".$MAKER_ID."','10','Collection is added')";
        $result = mysqli_query($con,$sql);
        if($MAKER_ID != 111111){
            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                            ('".$DATETIME."','icon-tasks','orange','Pages/Categories.php','New collection is added','0')";
            $result = mysqli_query($con,$sql);
        }

		$id = mysqli_insert_id($con);
		$sql = "INSERT INTO category_feature_values (CATEGORY_ID,FEATURE_ID,VALUE) VALUES
				('".$id."','1','0')";
		$result2 = mysqli_query($con,$sql);
		$sql = "INSERT INTO category_feature_values (CATEGORY_ID,FEATURE_ID,VALUE) VALUES
				('".$id."','2','".$DATETIME."')";
		$result2 = mysqli_query($con,$sql);

		echo $id;
    }
    else{
        echo 'Error occurred, please contact your administrator.';
    }
}
?>