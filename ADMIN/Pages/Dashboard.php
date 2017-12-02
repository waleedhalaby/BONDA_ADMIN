<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-dashboard"></i>
        <em>Dashboard</em>
    </li>
</ul>

<?php
    require ('../Handlers/DBCONNECT.php');

    $USERS_COUNT = 0;
    $sql = "SELECT COUNT(ID) AS Count FROM persons WHERE PERSON_TYPE_ID = 2";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
        $USERS_COUNT = $row['Count'];
    }

    $CATEGORIES_COUNT = 0;
    $sql = "SELECT COUNT(ID) AS Count FROM product_categories WHERE IS_ACTIVE = 1";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
        $CATEGORIES_COUNT = $row['Count'];
    }

    $ALL_CATEGORIES_COUNT = 0;
    $sql = "SELECT COUNT(ID) AS Count FROM product_categories";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
        $ALL_CATEGORIES_COUNT = $row['Count'];
    }

    $PRODUCTS_COUNT = 0;
    $sql = "SELECT COUNT(ID) AS Count FROM products";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
        $PRODUCTS_COUNT = $row['Count'];
    }

    $PEND_ORDERS_COUNT = 0;
    $sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 1";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
        $PEND_ORDERS_COUNT = $row['Count'];
    }
    $QUEUE_ORDERS_COUNT = 0;
    $sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 2";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
        $QUEUE_ORDERS_COUNT = $row['Count'];
    }
    $SHIP_ORDERS_COUNT = 0;
    $sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 3";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
        $SHIP_ORDERS_COUNT = $row['Count'];
    }
    $DEL_ORDERS_COUNT = 0;
    $sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4";
    $result = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_array($result)){
        $DEL_ORDERS_COUNT = $row['Count'];
    }

    $TOTAL_INCOME = 0;
    $sql = "SELECT C.TOTAL FROM carts C
            INNER JOIN orders O ON C.ID = O.CART_ID
            WHERE O.ORDER_STATUS_ID = 4";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result)){
            $TOTAL_INCOME += $row['TOTAL'];
        }
    }
    else{
        $TOTAL_INCOME = "0.00";
    }

$DEL_ORDERS_W1_COUNT = 0;
$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
            ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 8 WEEK) and DATE_SUB(NOW(),INTERVAL 7 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $DEL_ORDERS_W1_COUNT = $row['Count'];
}
$DEL_ORDERS_W2_COUNT = 0;
$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
            ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 7 WEEK) and DATE_SUB(NOW(),INTERVAL 6 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $DEL_ORDERS_W2_COUNT = $row['Count'];
}
$DEL_ORDERS_W3_COUNT = 0;
$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
            ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 6 WEEK) and DATE_SUB(NOW(),INTERVAL 5 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $DEL_ORDERS_W3_COUNT = $row['Count'];
}
$DEL_ORDERS_W4_COUNT = 0;
$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
            ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 5 WEEK) and DATE_SUB(NOW(),INTERVAL 4 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $DEL_ORDERS_W4_COUNT = $row['Count'];
}
$DEL_ORDERS_W5_COUNT = 0;
$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
            ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 4 WEEK) and DATE_SUB(NOW(),INTERVAL 3 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $DEL_ORDERS_W5_COUNT = $row['Count'];
}
$DEL_ORDERS_W6_COUNT = 0;
$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
            ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 3 WEEK) and DATE_SUB(NOW(),INTERVAL 2 WEEK)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $DEL_ORDERS_W6_COUNT = $row['Count'];
}
$DEL_ORDERS_W7_COUNT = 0;
$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND 
            ORDER_DATE_TIME between DATE_SUB(NOW(),INTERVAL 2 WEEK) and DATE_SUB(NOW(),INTERVAL 7 DAY)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $DEL_ORDERS_W7_COUNT = $row['Count'];
}
$DEL_ORDERS_W8_COUNT = 0;
$sql = "SELECT COUNT(ID) AS Count FROM orders WHERE ORDER_STATUS_ID = 4 AND ORDER_DATE_TIME > DATE_SUB(NOW(), INTERVAL 7 DAY)";
$result = mysqli_query($con,$sql);
while ($row = mysqli_fetch_array($result)){
    $DEL_ORDERS_W8_COUNT = $row['Count'];
}
?>

<div class="row-fluid">

    <a class="quick-button metro yellow span4">
        <i class="icon-group"></i>
        <p>Users</p>
        <span class="badge"><?php echo $USERS_COUNT ?></span>
    </a>
    <a onclick="$('#content').load('Pages/Categories.php')" class="quick-button metro red span4">
        <i class="icon-tasks"></i>
        <p>Active Categories</p>
        <span class="badge"><?php echo $CATEGORIES_COUNT. ' / ' .$ALL_CATEGORIES_COUNT ?></span>
    </a>
    <a onclick="$('#content').load('Pages/Products.php')" class="quick-button metro green span4">
        <i class="icon-gift"></i>
        <p>Products</p>
        <span class="badge"><?php echo $PRODUCTS_COUNT ?></span>
    </a>
    <div class="clearfix"></div>
</div>
<br/>
<div class="row-fluid">
    <a onclick="$('#content').load('Pages/PendingOrders.php')" class="quick-button metro blue span3">
        <i class="icon-envelope"></i>
        <p>Pending Orders</p>
        <span class="badge"><?php echo $PEND_ORDERS_COUNT ?></span>
    </a>
    <a onclick="$('#content').load('Pages/QueuedOrders.php')" class="quick-button metro orange span3">
        <i class="icon-envelope-alt"></i>
        <p>Queued Orders</p>
        <span class="badge"><?php echo $QUEUE_ORDERS_COUNT ?></span>
    </a>
    <a onclick="$('#content').load('Pages/ShippedOrders.php')" class="quick-button metro black span3">
        <i class="icon-truck"></i>
        <p>Shipped Orders</p>
        <span class="badge"><?php echo $SHIP_ORDERS_COUNT ?></span>
    </a>
    <a onclick="$('#content').load('Pages/DeliveredOrders.php')" class="quick-button metro purple span3">
        <i class="icon-shopping-cart"></i>
        <p>Delivered Orders</p>
        <span class="badge"><?php echo $DEL_ORDERS_COUNT ?></span>
    </a>

    <div class="clearfix"></div>

</div>
<br/>
<div class="row-fluid">
    <div class="span3 statbox purple" ontablet="span6" ondesktop="span3">
        <div class="number"><?php if($TOTAL_INCOME == "0.00")
            {echo $TOTAL_INCOME." <i class='icon-minus'></i>";}else{echo $TOTAL_INCOME." <i class='icon-arrow-up'></i>";} ?></div>
        <div class="title">Total Income</div>
        <div style="cursor: pointer" class="footer" onclick="$('#content').load('Pages/DeliveredOrders.php')">
            <a style="color: #0c5460"> extract full report</a>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="widget blue span6" ontablet="span6" ondesktop="span6">
        <h2><span class="glyphicons charts"><i></i></span>2 Months Orders Stats</h2>
        <hr>
        <div class="content">
            <div class="verticalChart">
                <div class="singleBar">
                    <div class="bar">
                        <div class="value" style="height: <?php echo $DEL_ORDERS_W1_COUNT ?>%;">
                            <span style="color: rgb(87, 142, 190); display: inline;"><?php echo $DEL_ORDERS_W1_COUNT ?></span>
                        </div>
                    </div>
                    <div class="title">W1</div>
                </div>
                <div class="singleBar">
                    <div class="bar">
                        <div class="value" style="height: <?php echo $DEL_ORDERS_W2_COUNT ?>%;">
                            <span style="color: rgb(87, 142, 190); display: inline;"><?php echo $DEL_ORDERS_W2_COUNT ?></span>
                        </div>
                    </div>
                    <div class="title">W2</div>
                </div>
                <div class="singleBar">
                    <div class="bar">
                        <div class="value" style="height: <?php echo $DEL_ORDERS_W3_COUNT ?>%;">
                            <span style="color: rgb(87, 142, 190); display: inline;"><?php echo $DEL_ORDERS_W3_COUNT ?></span>
                        </div>
                    </div>
                    <div class="title">W3</div>
                </div>
                <div class="singleBar">
                    <div class="bar">
                        <div class="value" style="height: <?php echo $DEL_ORDERS_W4_COUNT ?>%;">
                            <span style="color: rgb(87, 142, 190); display: inline;"><?php echo $DEL_ORDERS_W4_COUNT ?></span>
                        </div>
                    </div>
                    <div class="title">W4</div>
                </div>
                <div class="singleBar">
                    <div class="bar">
                        <div class="value" style="height: <?php echo $DEL_ORDERS_W5_COUNT ?>%;">
                            <span style="color: rgb(87, 142, 190); display: inline;"><?php echo $DEL_ORDERS_W5_COUNT ?></span>
                        </div>
                    </div>
                    <div class="title">W5</div>
                </div>
                <div class="singleBar">
                    <div class="bar">
                        <div class="value" style="height: <?php echo $DEL_ORDERS_W6_COUNT ?>%;">
                            <span style="color: rgb(87, 142, 190); display: inline;"><?php echo $DEL_ORDERS_W6_COUNT ?></span>
                        </div>
                    </div>
                    <div class="title">W6</div>
                </div>
                <div class="singleBar">
                    <div class="bar">
                        <div class="value" style="height: <?php echo $DEL_ORDERS_W7_COUNT ?>%;">
                            <span style="color: rgb(87, 142, 190); display: inline;"><?php echo $DEL_ORDERS_W7_COUNT ?></span>
                        </div>
                    </div>
                    <div class="title">W7</div>
                </div>
                <div class="singleBar">
                    <div class="bar">
                        <div class="value" style="height: <?php echo $DEL_ORDERS_W8_COUNT ?>%;">
                            <span style="color: rgb(87, 142, 190); display: inline;"><?php echo $DEL_ORDERS_W8_COUNT ?></span>
                        </div>
                    </div>
                    <div class="title">W8</div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
