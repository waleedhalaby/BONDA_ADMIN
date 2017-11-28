<?php
$con = mysqli_connect('localhost:3306','root','','jewelryDB');

if(mysqli_connect_errno()){
    echo 'Failed to connect to MYSQL: ' . mysqli_connect_error();
}
session_start();

$PERSON_ID = $_SESSION['PERSON_ID'];
$PRODUCT_ID = $_GET['id'];

$sql = "SELECT P.PRICE FROM PRODUCTS P
        INNER JOIN CURRENCIES C ON P.CURRENCY_ID = C.ID WHERE P.ID = '".$PRODUCT_ID."'";
$result = mysqli_query($con,$sql);
$PRICE = 0;
while ($row = mysqli_fetch_array($result)){
    $PRICE = $row['PRICE'];
}

$sql = "SELECT ID,TOTAL FROM CARTS WHERE PERSON_ID = '".$PERSON_ID."'";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
if($rows > 0){
    $TOTAL = 0;
    $CART_ID = 0;
    while($row = mysqli_fetch_array($result)){
        $TOTAL = $row['TOTAL'];
        $CART_ID = $row['ID'];
    }
    $TOTAL += $PRICE;
    $sql = "UPDATE CARTS SET TOTAL = '".$TOTAL."' WHERE ID = '".$CART_ID."'";
    $result = mysqli_query($con,$sql);

    $sql = "INSERT INTO CART_DETAILS (CART_ID,PRODUCT_ID,QUANTITY,PRICE) VALUES ('".$CART_ID."','".$PRODUCT_ID."','1','".$PRICE."')";
    $result = mysqli_query($con,$sql);
    $_SESSION['COUNT'] += 1;
    echo true;
}
else{
    $sql = "INSERT INTO CARTS (PERSON_ID,TOTAL) VALUES ('".$PERSON_ID."','".$PRICE."')";
    $result = mysqli_query($con,$sql);

    $sql = "SELECT ID FROM CARTS WHERE PERSON_ID = '".$PERSON_ID."'";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    if($rows > 0){
        $CART_ID = 0;
        while ($row = mysqli_fetch_array($result)){
            $CART_ID = $row['ID'];
        }

        $sql = "INSERT INTO CART_DETAILS (CART_ID,PRODUCT_ID,QUANTITY,PRICE) VALUES ('".$CART_ID."','".$PRODUCT_ID."','1','".$PRICE."')";
        $result = mysqli_query($con,$sql);
        $_SESSION['COUNT'] += 1;
        echo true;
    }
    else{
        echo false;
    }
}
?>