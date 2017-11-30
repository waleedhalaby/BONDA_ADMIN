<?php
require ('../DBCONNECT.php');

$PRODUCT_ID = $_GET['id'];

$sql = "SELECT P.ID,P.SKU_ID,P.NAME,P.PRICE,C.ID AS CURRENCY_ID ,C.CURRENCY,P.DESCRIPTION, CT.ID AS CATEGORY_ID, CT.CATEGORY FROM products P 
                INNER JOIN currencies C ON P.CURRENCY_ID = C.ID
                INNER JOIN product_categories CT ON P.CATEGORY_ID = CT.ID
                WHERE P.ID = ".$PRODUCT_ID;
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
$json = Array();
if($rows > 0){
    while($row = mysqli_fetch_array($result)){
        $json['ID']= $row['ID'];
        $json['SKU_ID']= $row['SKU_ID'];
        $json['NAME']= $row['NAME'];
        $json['PRICE']= number_format($row['PRICE'], 2);
        $json['CURRENCY_ID']= $row['CURRENCY_ID'];
        $json['CURRENCY']= $row['CURRENCY'];
        $json['DESCRIPTION']= $row['DESCRIPTION'];
        $json['CATEGORY_ID']= $row['CATEGORY_ID'];
        $json['CATEGORY']= $row['CATEGORY'];

        $sql = "SELECT V.ID,F.FEATURE, F.DATA_TYPE_ID, DT.TYPE,V.VALUE FROM product_feature_values V
                        INNER JOIN product_features F ON V.FEATURE_ID = F.ID
                        INNER JOIN data_types DT ON F.DATA_TYPE_ID = DT.ID
                        INNER JOIN products P ON V.PRODUCT_ID = P.ID
                        WHERE F.IS_ACTIVE = '1' AND V.VALUE IS NOT NULL AND P.ID = ".$row['ID'];
        $result2 = mysqli_query($con,$sql);
        $rows2 = mysqli_num_rows($result2);
        if($rows2 > 0) {
            $j = 0;
            while ($row2 = mysqli_fetch_array($result2)) {
                $json['FEATURES'][$j]['ID'] = $row2['ID'];
                $json['FEATURES'][$j]['FEATURE']= $row2['FEATURE'];
                $json['FEATURES'][$j]['DATA_TYPE_ID']= $row2['DATA_TYPE_ID'];
                $json['FEATURES'][$j]['DATA_TYPE']= $row2['TYPE'];
                $json['FEATURES'][$j]['VALUE']= $row2['VALUE'];
                $j++;
            }
        }
        else{
            $json['FEATURES'] = Array();
        }

        $sql = "SELECT ID, IMAGE_PATH FROM products_images
                    WHERE PRODUCT_ID = ".$row['ID'];
        $result2 = mysqli_query($con,$sql);
        $rows2 = mysqli_num_rows($result2);
        if($rows2 > 0) {
            $j = 0;
            while ($row2 = mysqli_fetch_array($result2)) {
                $json['IMAGES'][$j]['ID']= $row2['ID'];
                $json['IMAGES'][$j]['IMAGE_PATH']= $row2['IMAGE_PATH'];
                $j++;
            }
        }
        else{
            $json['IMAGES'] = Array();
        }
    }
    echo json_encode($json);
}
?>