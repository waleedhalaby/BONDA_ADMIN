<?php
require ('../DBCONNECT.php');

session_start();

$PERSON_ID = $_SESSION['PERSON_ID'];
$json = Array();
$json['DETAILS'] = Array();

$sql = "SELECT ID, TOTAL FROM carts WHERE PERSON_ID = '".$PERSON_ID."' AND CART_STATUS_ID <> 2";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
if($rows > 0){
    $CART_ID = 0;
    $TOTAL = 0;
    while($row = mysqli_fetch_array($result)){
        $CART_ID = $row['ID'];
        $TOTAL = $row['TOTAL'];
    }
    $json['ID'] = $CART_ID;
    $json['TOTAL'] = $TOTAL;
    $sql = "SELECT P.ID, P.SKU_ID, P.NAME, CD.QUANTITY, CD.PRICE, C.CURRENCY FROM cart_details CD
        INNER JOIN products P ON CD.PRODUCT_ID = P.ID 
        INNER JOIN currencies C ON P.CURRENCY_ID = C.ID WHERE CART_ID='".$CART_ID."'";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);
    if($rows > 0){
        $j = 0;
        while($row = mysqli_fetch_array($result)){
            $sql = "SELECT IMAGE_PATH FROM products_images WHERE PRODUCT_ID = '".$row['ID']."'";
            $result2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($result2);
            $IMAGE = '';
            if($rows2 > 0){
                while($row2 = mysqli_fetch_array($result2)){
                    $IMAGE = $row2['IMAGE_PATH'];
                    break;
                }
            }
            $json['DETAILS'][$j]['IMAGE'] = $IMAGE;
            $json['DETAILS'][$j]['SKU_ID'] = $row['SKU_ID'];
            $json['DETAILS'][$j]['NAME'] = $row['NAME'];
            $json['DETAILS'][$j]['QUANTITY'] = $row['QUANTITY'];
            $json['DETAILS'][$j]['PRICE'] = $row['PRICE'];
            $json['DETAILS'][$j]['CURRENCY'] = $row['CURRENCY'];
            $j++;
        }
    }
}
echo json_encode($json);
?>