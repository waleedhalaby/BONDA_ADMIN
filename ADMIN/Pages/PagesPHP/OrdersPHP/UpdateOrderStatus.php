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