<?php
    session_start();
    if(isset($_SESSION['PERSON_ID']) || !empty($_SESSION['PERSON_ID'])){
        include ('Shared/header.php');
        echo '<div id="main_content" class="container-fluid">

          </div>';
        require ('UpdateStatus.php');
        Update('ACTIVE');
        include ('Shared/footer.php');
    }
    else{
        header('Location: login.php');
    }
?>