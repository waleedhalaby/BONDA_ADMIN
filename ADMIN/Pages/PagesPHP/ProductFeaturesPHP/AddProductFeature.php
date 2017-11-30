<?php
require ('../../../Handlers/DBCONNECT.php');

function getDatetimeNow() {
    $tz_object = new DateTimeZone('Egypt/Cairo');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    return $datetime->format('Y\-m\-d\ h:i:s');
}

$FEATURE = ucfirst(strtolower($_POST['addFeature']));
$DATA_TYPE = $_POST['addType'];

$sql = "INSERT INTO product_features (FEATURE,DATA_TYPE_ID,IS_ACTIVE) VALUES
        ('".$FEATURE."','".$DATA_TYPE."','1')";
$result = mysqli_query($con,$sql);

$sql = "SELECT PF.ID,DT.TYPE FROM product_features PF
        INNER JOIN data_types DT ON PF.DATA_TYPE_ID = DT.ID WHERE FEATURE = '".$FEATURE."'";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
if($rows > 0){
    $FEATURE_ID = 0;
    $TYPE = '';
    while($row = mysqli_fetch_array($result)) {
        $FEATURE_ID = $row['ID'];
        $TYPE = $row['TYPE'];
    }
    $sql = "SELECT ID FROM products";
    $res2 = mysqli_query($con,$sql);
    $rows2 = mysqli_num_rows($res2);
    if($rows2 > 0) {
        while ($PRODUCT_ID = mysqli_fetch_array($res2)) {
            $VAL = '';
            switch ($TYPE){
                case 'STRING':
                    $VAL = '';
                    break;
                case 'DATETIME':
                    $VAL = getDatetimeNow();
                    break;
                case 'INTEGER':
                    $VAL = 0;
                    break;
                case 'DECIMAL':
                case 'DOUBLE':
                    $VAL = 0.00;
                    break;
                case 'BOOLEAN':
                    $VAL = false;
                    break;
            }
            $sql = "INSERT INTO product_feature_values (PRODUCT_ID,FEATURE_ID,VALUE) VALUES 
                        ('" . $PRODUCT_ID['ID'] . "','" . $FEATURE_ID . "','" . $VAL . "')";
            $query = mysqli_query($con,$sql);
            echo true;
        }
    }
    echo true;
}
else{
    echo false;
}
?>