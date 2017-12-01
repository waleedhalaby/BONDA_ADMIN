<?php
    require ('DBCONNECT.php');

    $EMAIL = $_POST['editEmail'];
    $PASSWORD = $_POST['editPassword'];
    $CPASSWORD = $_POST['editCPassword'];

    if($PASSWORD != $CPASSWORD){
        echo 'Passwords are not identical.';
    }
    else{
        $sql = "SELECT EMAIL FROM persons WHERE EMAIL = '".$EMAIL."' AND PERSON_TYPE_ID = 2";
        $res = mysqli_query($con,$sql);
        if(mysqli_num_rows($res) > 0){
            $sql = "UPDATE persons SET PASSWORD = '".md5($PASSWORD)."' WHERE EMAIL = '".$EMAIL."'";
            $res = mysqli_query($con,$sql);
            echo 'Password has been reset successfully.';
        }
        else{
            echo 'E-mail is invalid, please check the valid e-mail.';
        }
    }
?>