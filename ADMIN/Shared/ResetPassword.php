<?php
    require ('../Handlers/DBCONNECT.php');
    $PERSON_ID = $_GET['id'];

    $PASSWORD = $_POST['editPassword'];
    $CPASSWORD = $_POST['editCPassword'];

    if($PASSWORD != $CPASSWORD){
        echo 'Passwords are not identical.';
    }
    else{
        $sql = "UPDATE persons SET PASSWORD = '".md5($PASSWORD)."' WHERE ID = '".$PERSON_ID."'";
        $res = mysqli_query($con,$sql);
        echo 'Password has been reset successfully.';
    }
?>