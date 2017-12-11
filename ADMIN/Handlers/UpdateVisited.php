<?php
require ('DBCONNECT.php');
require ('Authenticate.php');

$PAGE_ID = $_POST['id'];

mysqli_query($con,"UPDATE pages set LAST_VISITED = '0'");
mysqli_query($con,"UPDATE pages set LAST_VISITED = '1' WHERE ID = '".$PAGE_ID."'");
?>