<?php
    session_start();
    require('DBCONNECT.php');

    if (isset($_POST['email'])){
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con,$email);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,$password);

        $query = "SELECT * FROM `persons` WHERE EMAIL='$email' and PASSWORD='".md5($password)."' AND PERSON_TYPE_ID <> 2";
        $result = mysqli_query($con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);

        if($rows==1) {
            while ($row = mysqli_fetch_assoc($result)){
                $_SESSION['id'] = $row['ID'];
                $_SESSION['first_name'] = $row['FIRST_NAME'];
                $_SESSION['last_name'] = $row['LAST_NAME'];
            }
            $_SESSION['ERROR'] = '';
            header("Location: ../index.php");
        }
        else{
            $_SESSION['ERROR'] = 'Invalid E-mail or Password.';
            header("Location: ../login.php");
        }
    }
    else{
        $_SESSION['ERROR'] = 'Please Enter the Required Fields.';
        header("Location: ../login.php");
    }
?>