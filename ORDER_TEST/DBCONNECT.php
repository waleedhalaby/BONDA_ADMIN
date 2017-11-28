<?php
$con = mysqli_connect('localhost:3306','root','','jewelryDB');

if(mysqli_connect_errno()){
    echo 'Failed to connect to MYSQL: ' . mysqli_connect_error();
}
?>