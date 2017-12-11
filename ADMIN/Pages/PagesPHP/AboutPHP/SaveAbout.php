<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$OWNER = ucfirst(strtolower($_POST['Owner']));
$PARAGRAPH = ucfirst($_POST['Paragraph']);

$BANNER_ID = 1;
$sql = "UPDATE about_us SET PARAGRAPH = '".$PARAGRAPH."', OWNER_NAME = '".$OWNER."' WHERE ID = '".$BANNER_ID."'";
$result = mysqli_query($con,$sql);

if($result){
    echo $BANNER_ID;
}
else{
    echo 'Error occurred, please contact your administrator.';
}
?>