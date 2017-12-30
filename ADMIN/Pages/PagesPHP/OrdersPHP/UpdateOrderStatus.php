<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$STATUS = $_GET['s'];
$ORDER_ID = $_GET['id'];
$UNIQUE_ID = $_GET['u'];
$MAKER_ID = $_GET['m'];

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$sql = "UPDATE orders SET ORDER_STATUS_ID = ".$STATUS." WHERE ID = '".$ORDER_ID."'";
$result = mysqli_query($con,$sql);

$stat = '';
$url = '';
$url_id = '';
if($STATUS == "2"){
    $stat = 'Queued';
    $url = 'Pages/QueuedOrders.php';
    $url_id = '13';
    $icon = 'icon-envelope-alt';
}
elseif($STATUS == "3"){
    $SHIP_DATE = '';
    if(isset($_GET['sd']) || !empty($_GET['sd'])){
        $SHIP_DATE = str_replace('_','-',$_GET['sd']);
    }
    else{
        $SHIP_DATE = date('Y-m-d H:i:s', strtotime("+5 days"));
    }

    $stat = 'Shipped';
    $url = 'Pages/ShippedOrders.php';
    $url_id = '14';
    $icon = 'icon-truck';

    $sql = "UPDATE orders SET SHIP_DATE_TIME = '".$SHIP_DATE."' WHERE ID = ".$ORDER_ID;
    mysqli_query($con,$sql);
}
elseif($STATUS == "4"){
    $stat = 'Delivered';
    $url = 'Pages/DeliveredOrders.php';
    $url_id = '15';
    $icon = 'icon-shopping-cart';

    $sql = "SELECT C.TOTAL FROM carts C INNER JOIN orders O ON C.ID = O.CART_ID WHERE O.ID = ".$ORDER_ID;
    $res = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($res)){
        $sql = "UPDATE orders SET TOTAL = '".$row['TOTAL']."' WHERE ID = ".$ORDER_ID;
        mysqli_query($con,$sql);
    }

    $sql = "SELECT CD.PRODUCT_ID, CD.QUANTITY, CD.PRICE FROM cart_details CD
            INNER JOIN orders O ON CD.CART_ID = O.CART_ID WHERE O.ID = ".$ORDER_ID;
    $res = mysqli_query($con,$sql);
    $DATA = "";
    $json = Array();
    $i = 0;
    while ($row = mysqli_fetch_array($res)){
        $sql = "SELECT P.ID,P.SKU_ID,P.NAME,P.PRICE,C.ID AS CURRENCY_ID ,C.CURRENCY,P.DESCRIPTION, CT.ID AS CATEGORY_ID,D.ID AS DESIGNER_ID, D.DESIGNER, CT.CATEGORY FROM products P 
                INNER JOIN currencies C ON P.CURRENCY_ID = C.ID
                INNER JOIN categories CT ON P.CATEGORY_ID = CT.ID
                INNER JOIN designers D ON P.DESIGNER_ID = D.ID
                WHERE P.ID = ".$row['PRODUCT_ID'];
        $res2 = mysqli_query($con,$sql);
        while($row2 = mysqli_fetch_array($res2)){
            $DATA = "ID: ".$row2['ID']."<br/>";
            $DATA .= "SKU_ID: ".$row2['SKU_ID']."<br/>";
            $DATA .= "NAME: ".$row2['NAME']."<br/>";
            $DATA .= "PRICE: ".number_format($row2['PRICE'], 2)."<br/>";
            $DATA .= "CURRENCY: ".$row2['CURRENCY']."<br/>";
            $DATA .= "DESCRIPTION: ".$row2['DESCRIPTION']."<br/>";
            $DATA .= "COLLECTION: ".$row2['CATEGORY']."<br/>";
            $DATA .= "DESIGNER: ".$row2['DESIGNER']."<br/>";

            $sql = "SELECT V.ID,F.FEATURE, F.DATA_TYPE_ID, DT.TYPE,V.VALUE FROM product_feature_values V
                        INNER JOIN product_features F ON V.FEATURE_ID = F.ID
                        INNER JOIN data_types DT ON F.DATA_TYPE_ID = DT.ID
                        INNER JOIN products P ON V.PRODUCT_ID = P.ID
                        WHERE F.IS_ACTIVE = '1' AND V.VALUE IS NOT NULL AND F.IS_VISIBLE = '1'  AND P.ID = ".$row2['ID'];
            $res3 = mysqli_query($con,$sql);
            $rows3 = mysqli_num_rows($res3);
            if($rows3 > 0) {
                $j = 0;
                while ($row3 = mysqli_fetch_array($res3)) {
                    $DATA .= $row3['FEATURE'].": ".$row3['VALUE']."<br/>";
                }
            }
            $sql = "SELECT ID, IMAGE_PATH FROM products_images
                    WHERE PRODUCT_ID = ".$row2['ID'];
            $result4 = mysqli_query($con,$sql);
            $rows4 = mysqli_num_rows($result4);
            if($rows4 > 0) {
                $j = 0;
                while ($row4 = mysqli_fetch_array($result4)) {
                    $json[$i]['IMAGE_PATH'] = $row4['IMAGE_PATH'];
                }
            }
            else{
                $json[$i]['IMAGE_PATH'] = null;
            }
            $json[$i]['DATA'] = $DATA;
        }
        $i++;
    }
    foreach ($json as $item){
        $sql = "INSERT INTO order_products_history (IMAGE_PATH,DATA,ORDER_ID) VALUES ('".$item['IMAGE_PATH']."','".$item['DATA']."','".$ORDER_ID."')";
        mysqli_query($con,$sql);
    }


    $sql = "DELETE CD FROM cart_details CD
            INNER JOIN orders O ON CD.CART_ID = O.CART_ID WHERE O.ID = ".$ORDER_ID;
    mysqli_query($con,$sql);

    $sql = "DELETE C FROM carts C
            INNER JOIN orders O ON C.ID = O.CART_ID WHERE O.ID = ".$ORDER_ID;
    mysqli_query($con,$sql);

    $sql = "UPDATE orders SET CART_ID = NULL WHERE ID = ".$ORDER_ID;
    mysqli_query($con,$sql);
}
elseif ($STATUS == "5"){
    $stat = 'Cancelled';
    $url = 'Pages/CancelledOrders.php';
    $url_id = '17';
    $icon = 'icon-ban-circle';

    $sql = "SELECT C.TOTAL FROM carts C INNER JOIN orders O ON C.ID = O.CART_ID WHERE O.ID = ".$ORDER_ID;
    $res = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($res)){
        $sql = "UPDATE orders SET TOTAL = '".$row['TOTAL']."' WHERE ID = ".$ORDER_ID;
        mysqli_query($con,$sql);
    }

    $sql = "SELECT CD.PRODUCT_ID, CD.QUANTITY, CD.PRICE FROM cart_details CD
            INNER JOIN orders O ON CD.CART_ID = O.CART_ID WHERE O.ID = ".$ORDER_ID;
    $res = mysqli_query($con,$sql);
    $DATA = "";
    $json = Array();
    $i = 0;
    while ($row = mysqli_fetch_array($res)){
        $sql = "SELECT P.ID,P.SKU_ID,P.NAME,P.PRICE,C.ID AS CURRENCY_ID ,C.CURRENCY,P.DESCRIPTION, CT.ID AS CATEGORY_ID,D.ID AS DESIGNER_ID, D.DESIGNER, CT.CATEGORY FROM products P 
                INNER JOIN currencies C ON P.CURRENCY_ID = C.ID
                INNER JOIN categories CT ON P.CATEGORY_ID = CT.ID
                INNER JOIN designers D ON P.DESIGNER_ID = D.ID
                WHERE P.ID = ".$row['PRODUCT_ID'];
        $res2 = mysqli_query($con,$sql);
        while($row2 = mysqli_fetch_array($res2)){
            $DATA = "ID: ".$row2['ID']."<br/>";
            $DATA .= "SKU_ID: ".$row2['SKU_ID']."<br/>";
            $DATA .= "NAME: ".$row2['NAME']."<br/>";
            $DATA .= "PRICE: ".number_format($row2['PRICE'], 2)."<br/>";
            $DATA .= "CURRENCY: ".$row2['CURRENCY']."<br/>";
            $DATA .= "DESCRIPTION: ".$row2['DESCRIPTION']."<br/>";
            $DATA .= "COLLECTION: ".$row2['CATEGORY']."<br/>";
            $DATA .= "DESIGNER: ".$row2['DESIGNER']."<br/>";

            $sql = "SELECT V.ID,F.FEATURE, F.DATA_TYPE_ID, DT.TYPE,V.VALUE FROM product_feature_values V
                        INNER JOIN product_features F ON V.FEATURE_ID = F.ID
                        INNER JOIN data_types DT ON F.DATA_TYPE_ID = DT.ID
                        INNER JOIN products P ON V.PRODUCT_ID = P.ID
                        WHERE F.IS_ACTIVE = '1' AND V.VALUE IS NOT NULL AND F.IS_VISIBLE = '1'  AND P.ID = ".$row2['ID'];
            $res3 = mysqli_query($con,$sql);
            $rows3 = mysqli_num_rows($res3);
            if($rows3 > 0) {
                $j = 0;
                while ($row3 = mysqli_fetch_array($res3)) {
                    $DATA .= $row3['FEATURE'].": ".$row3['VALUE']."<br/>";
                }
            }
            $sql = "SELECT ID, IMAGE_PATH FROM products_images
                    WHERE PRODUCT_ID = ".$row2['ID'];
            $result4 = mysqli_query($con,$sql);
            $rows4 = mysqli_num_rows($result4);
            if($rows4 > 0) {
                $j = 0;
                while ($row4 = mysqli_fetch_array($result4)) {
                    $json[$i]['IMAGE_PATH'] = $row4['IMAGE_PATH'];
                }
            }
            else{
                $json[$i]['IMAGE_PATH'] = null;
            }
            $json[$i]['DATA'] = $DATA;
        }
        $i++;
    }
    foreach ($json as $item){
        $sql = "INSERT INTO order_products_history (IMAGE_PATH,DATA,ORDER_ID) VALUES ('".$item['IMAGE_PATH']."','".$item['DATA']."','".$ORDER_ID."')";
        mysqli_query($con,$sql);
    }

    $sql = "DELETE CD FROM cart_details CD 
            INNER JOIN orders O ON CD.CART_ID = O.CART_ID WHERE O.ID = ".$ORDER_ID;
    mysqli_query($con,$sql);

    $sql = "DELETE C FROM carts C
            INNER JOIN orders O ON C.ID = O.CART_ID WHERE O.ID = ".$ORDER_ID;
    mysqli_query($con,$sql);

    $sql = "UPDATE orders SET CART_ID = NULL WHERE ID = ".$ORDER_ID;
    mysqli_query($con,$sql);
}

$sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','".$url_id."','Order [".$UNIQUE_ID."] is ".$stat."')";
$result = mysqli_query($con,$sql);

if($MAKER_ID != 111111){
    $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','".$icon."','black','".$url."','Order [".$UNIQUE_ID."] is ".$stat."','0')";
    $result = mysqli_query($con,$sql);
}

echo true;

?>