<?php
require ('../DBCONNECT.php');


$sql = "SELECT P.ID,P.SKU_ID,P.NAME,P.PRICE,C.CURRENCY, CT.CATEGORY,P.DESCRIPTION FROM products P 
            INNER JOIN currencies C ON P.CURRENCY_ID = C.ID
            INNER JOIN product_categories CT ON P.CATEGORY_ID = CT.ID";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
$json = Array();
$i = 0;
if($rows > 0){
    while($row = mysqli_fetch_array($result)){
        $json[$i]['ID']= $row['ID'];
        $json[$i]['SKU_ID']= $row['SKU_ID'];
        $json[$i]['NAME']= $row['NAME'];
        $json[$i]['PRICE']= number_format($row['PRICE'], 2);
        $json[$i]['CURRENCY']= $row['CURRENCY'];
        $json[$i]['CATEGORY']= $row['CATEGORY'];
        $json[$i]['DESCRIPTION']= $row['DESCRIPTION'];
        $json[$i]['IMAGES'] = Array();

        $sql = "SELECT IMAGE_PATH FROM products_images WHERE PRODUCT_ID = ".$row['ID'];
        $result2 = mysqli_query($con,$sql);
        if($result2 != null)
        {
            $rows = mysqli_num_rows($result2);
            if($rows > 0){
                $j = 0;
                while($row2 = mysqli_fetch_array($result2)){
                    $json[$i]['IMAGES'][$j]['IMAGE'] = $row2['IMAGE_PATH'];
                    $j++;
                }
            }
        }
        $i++;
    }
}
echo json_encode($json);
?>