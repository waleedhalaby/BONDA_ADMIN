<?php
    require ('../../../Handlers/DBCONNECT.php');

    $PRODUCT_ID = $_GET['id'];

    $sql = "SELECT P.ID,P.SKU_ID,P.NAME,P.PRICE,C.ID AS CURRENCY_ID ,C.CURRENCY,P.DESCRIPTION, CT.ID AS CATEGORY_ID, CT.CATEGORY FROM PRODUCTS P 
                INNER JOIN CURRENCIES C ON P.CURRENCY_ID = C.ID
                INNER JOIN PRODUCT_CATEGORIES CT ON P.CATEGORY_ID = CT.ID
                WHERE P.ID = ".$PRODUCT_ID;
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
            $json[$i]['CURRENCY_ID']= $row['CURRENCY_ID'];
            $json[$i]['CURRENCY']= $row['CURRENCY'];
            $json[$i]['DESCRIPTION']= $row['DESCRIPTION'];
            $json[$i]['CATEGORY_ID']= $row['CATEGORY_ID'];
            $json[$i]['CATEGORY']= $row['CATEGORY'];

            $sql = "SELECT V.ID,F.FEATURE, F.DATA_TYPE_ID, DT.TYPE,V.VALUE FROM PRODUCT_FEATURE_VALUES V
                        INNER JOIN PRODUCT_FEATURES F ON V.FEATURE_ID = F.ID
                        INNER JOIN DATA_TYPES DT ON F.DATA_TYPE_ID = DT.ID
                        INNER JOIN PRODUCTS P ON V.PRODUCT_ID = P.ID
                        WHERE P.ID = ".$row['ID'];
            $result2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($result2);
            if($rows2 > 0) {
                $j = 0;
                while ($row2 = mysqli_fetch_array($result2)) {
                    $json[$i]['FEATURES'][$j]['ID'] = $row2['ID'];
                    $json[$i]['FEATURES'][$j]['FEATURE']= $row2['FEATURE'];
                    $json[$i]['FEATURES'][$j]['DATA_TYPE_ID']= $row2['DATA_TYPE_ID'];
                    $json[$i]['FEATURES'][$j]['DATA_TYPE']= $row2['TYPE'];
                    $json[$i]['FEATURES'][$j]['VALUE']= $row2['VALUE'];
                    $j++;
                }
            }
            else{
                $json[$i]['FEATURES'] = Array();
            }

            $sql = "SELECT ID, IMAGE_PATH FROM PRODUCTS_IMAGES
                    WHERE PRODUCT_ID = ".$row['ID'];
            $result2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($result2);
            if($rows2 > 0) {
                $j = 0;
                while ($row2 = mysqli_fetch_array($result2)) {
                    $json[$i]['IMAGES'][$j]['ID']= $row2['ID'];
                    $json[$i]['IMAGES'][$j]['IMAGE_PATH']= $row2['IMAGE_PATH'];
                    $j++;
                }
            }
            else{
                $json[$i]['IMAGES'] = Array();
            }
            $i++;
        }
        echo json_encode($json);
    }
?>