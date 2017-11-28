<?php
    function Update($status){
        require('DBCONNECT.php');
        $sql = "UPDATE person_feature_values SET VALUE = '".$status."' WHERE PERSON_ID = ".$_SESSION['id']." AND PERSON_FEATURE_ID = 2";
        $result = mysqli_query($con,$sql);
    }
?>