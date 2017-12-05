<?php
    require ('../DBCONNECT.php');

    session_start();
    $PERSON_ID = $_SESSION['PERSON_ID'];

    date_default_timezone_set('Africa/Cairo');
    $DATETIME = date_create()->format('Y-m-d H:i:s');

    if(isset($_POST['titleTxt']) && !empty($_POST['titleTxt']) && isset($_POST['descTxt']) && !empty($_POST['descTxt'])){
        mysqli_query($con,"INSERT INTO person_messages (FROM_PERSON_ID,TO_PERSON_ID,TITLE,DESCRIPTION,IS_SEEN,MESSAGE_DATE_TIME)
                                  VALUES ('".$PERSON_ID."','111111','".$_POST['titleTxt']."','".$_POST['descTxt']."','0','".$DATETIME."')");
        echo 'Message is sent successfully.';
    }
    else{
        echo 'Please fill the required fields.';
    }
?>