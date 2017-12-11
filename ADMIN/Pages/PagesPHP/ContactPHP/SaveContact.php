<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$LOCATION = $_POST['Location'];
$TEL1 = $_POST['Tel1'];
$TEL2 = $_POST['Tel2'];
$EMAIL = $_POST['Email'];

$BANNER_ID = 1;
$sql = "UPDATE contact_info SET LOCATION = '".$LOCATION."', TELEPHONE1 = '".$TEL1."', TELEPHONE2 = '".$TEL2."', EMAIL = '".$EMAIL."' WHERE ID = '".$BANNER_ID."'";
$result = mysqli_query($con,$sql);

if($result){
    echo $BANNER_ID;
}
else{
    echo 'Error occurred, please contact your administrator.';
}
?>