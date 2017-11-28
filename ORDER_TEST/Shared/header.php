<?php
require ('DBCONNECT.php');
$COUNT = 0;

$sql = "SELECT CTD.ID FROM cart_details CTD
        INNER JOIN carts CT ON CTD.CART_ID = CT.ID
        WHERE CT.PERSON_ID = '".$_SESSION['PERSON_ID']."' AND CT.CART_STATUS_ID <> 2";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
$COUNT  = $rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BONDA | TEST</title>
    <meta name="description" content="Test Order For BONDA Store">
    <meta name="author" content="Waleed Halaby">
    <meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../img/favicon.ico" />


    <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
    <link id="bootstrap-style" href="css/font-awesome.min.css" rel="stylesheet">
    <link id="bootstrap-style" href="css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-inverse bg-inverse">
    <a class="navbar-brand" href="index.php"><span class="fa fa-address-book"></span> ORDER</a>
    <h4>Hello, <?php echo $_SESSION['PERSON_NAME'] ?></h4>
    <div class="btn-group">
        <a id="cartBtn" class="btn btn-success"><span class="fa fa-shopping-cart"></span> CART(<?php echo $COUNT ?>)</a>
        <a href="logout.php" class="btn btn-danger"><span class="fa fa-sign-out"></span> Logout</a>
    </div>
</nav>