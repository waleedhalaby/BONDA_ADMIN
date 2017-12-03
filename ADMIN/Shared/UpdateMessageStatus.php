<?php
    require ('../Handlers/DBCONNECT.php');
    $MESSAGE_ID = $_GET['id'];

    $sql = "UPDATE person_messages SET IS_SEEN = '1' WHERE ID = '".$MESSAGE_ID."'";
    $result = mysqli_query($con,$sql);
?>