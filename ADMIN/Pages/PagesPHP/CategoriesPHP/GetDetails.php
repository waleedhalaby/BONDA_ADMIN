<?php
require('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$CATEGORY_ID = $_GET['id'];
$sql = "SELECT C.ID, C.CATEGORY,C.IMAGE_PATH, D.ID AS DESIGNER_ID,D.DESIGNER, C.IS_ACTIVE, C.DESCRIPTION FROM categories  C
            INNER JOIN designers D ON C.DESIGNER_ID = D.ID WHERE C.ID = '".$CATEGORY_ID."'";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
$json = Array();
if($rows > 0){
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $json[$i]['ID'] = $row['ID'];
        $json[$i]['IMAGE'] = $row['IMAGE_PATH'];
        $json[$i]['CATEGORY'] = $row['CATEGORY'];
        $json[$i]['DESIGNER_ID'] = $row['DESIGNER_ID'];
        $json[$i]['DESIGNER'] = $row['DESIGNER'];
        $json[$i]['IS_ACTIVE'] = $row['IS_ACTIVE'];
        $json[$i]['DESCRIPTION'] = $row['DESCRIPTION'];
        $sql = "SELECT COUNT(ID) FROM products WHERE CATEGORY_ID = '".$row['ID']."'";
        $result2 = mysqli_query($con,$sql);
        $rows2 = mysqli_num_rows($result2);
        if($rows2 > 0){
            $json[$i]['PRODUCTS'] = mysqli_fetch_array($result2)[0];
        }
        else{
            $json[$i]['PRODUCTS'] = 0;
        }
        $sql = "SELECT V.ID,F.FEATURE, F.DATA_TYPE_ID, DT.TYPE,V.VALUE FROM category_feature_values V
                        INNER JOIN category_features F ON V.FEATURE_ID = F.ID
                        INNER JOIN data_types DT ON F.DATA_TYPE_ID = DT.ID
                        INNER JOIN categories P ON V.CATEGORY_ID = P.ID
                        WHERE F.IS_ACTIVE = '1' AND F.IS_VISIBLE = '1'  AND P.ID = ".$row['ID'];
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
        $i++;
    }

    echo json_encode($json);
}
?>