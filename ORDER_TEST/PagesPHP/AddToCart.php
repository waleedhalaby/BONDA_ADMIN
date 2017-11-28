<?php
require ('../DBCONNECT.php');

session_start();

$PERSON_ID = $_SESSION['PERSON_ID'];
$PRODUCT_ID = $_GET['id'];

$sql = "SELECT P.PRICE FROM products P
        INNER JOIN currencies C ON P.CURRENCY_ID = C.ID WHERE P.ID = '".$PRODUCT_ID."'";
$result = mysqli_query($con,$sql);
$PRICE = 0;
while ($row = mysqli_fetch_array($result)){
    $PRICE = $row['PRICE'];
}

$sql = "SELECT ID,TOTAL FROM carts WHERE PERSON_ID = '".$PERSON_ID."' AND CART_STATUS_ID <> 2";
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
    $sql = "UPDATE carts SET TOTAL = '".$TOTAL."' WHERE ID = '".$CART_ID."'";
    $result = mysqli_query($con,$sql);

    $sql = "INSERT INTO cart_details (CART_ID,PRODUCT_ID,QUANTITY,PRICE) VALUES ('".$CART_ID."','".$PRODUCT_ID."','1','".$PRICE."')";
    $result = mysqli_query($con,$sql);
    echo true;
}
else{
    $sql = "INSERT INTO carts (PERSON_ID,TOTAL,CART_STATUS_ID) VALUES ('".$PERSON_ID."','".$PRICE."','1')";
    $result = mysqli_query($con,$sql);

    $sql = "SELECT ID FROM carts WHERE PERSON_ID = '".$PERSON_ID."'";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    if($rows > 0){
        $CART_ID = 0;
        while ($row = mysqli_fetch_array($result)){
            $CART_ID = $row['ID'];
        }

        $sql = "INSERT INTO cart_details (CART_ID,PRODUCT_ID,QUANTITY,PRICE) VALUES ('".$CART_ID."','".$PRODUCT_ID."','1','".$PRICE."')";
        $result = mysqli_query($con,$sql);
        echo true;
    }
    else{
        echo false;
    }
}
?>