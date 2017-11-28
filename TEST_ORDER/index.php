<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BONDA | TEST</title>
    <meta name="description" content="Test Order For BONDA Store">
    <meta name="author" content="Waleed Halaby">
    <meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
    <link id="bootstrap-style" href="css/font-awesome.min.css" rel="stylesheet">
    <link id="bootstrap-style" href="css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <?php session_start(); $_SESSION['PERSON_ID'] = '111127'; echo $_SESSION['PERSON_ID'] ; $COUNT = 0; if(isset($_SESSION['COUNT'])){$COUNT = $_SESSION['COUNT'];} ?>

    <nav class="navbar navbar-inverse bg-inverse">
        <a class="navbar-brand" href="index.php"><span class="fa fa-address-book"></span> ORDER</a>
        <a href="PagesPHP/Cart.php" class="btn btn-success"><span class="fa fa-shopping-cart"></span> CART(<?php echo $COUNT ?>)</a>
    </nav>

    <div id="main_container" class="container-fluid">
        <div id="1" class="row"></div>
    </div>

    <footer>
        <p>&copy; Copyrights reserved to <b>BONDA</b></p>
    </footer>

    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>