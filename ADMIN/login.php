<?php
    session_start();
    if(isset($_SESSION['id'])){
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BONDA | ADMIN</title>
    <meta name="description" content="Admin Control For BONDA Store">
    <meta name="author" content="Waleed Halaby">
    <meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script>
        function ShowModal(title,button,link) {
            $('#MyModal .modal-title').html(title);
            $('#MyModal .modal-body').empty();
            $('#MyModal .modal-footer').empty();
            $('#MyModal .modal-body').load(link);

            switch(button){
                case 'Close':
                    $('#MyModal .modal-footer').append('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                    break;
            }

            $('#MyModal').modal();
        }
    </script>

    <link rel="shortcut icon" href="Images/favicon.ico">

    <style type="text/css">
        body { background: url(img/bg-login.jpg) !important; }
    </style>
</head>
<body>
<div class="modal fade" id="MyModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="index.php"><span>BONDA</span></a>
            <div class="nav-no-collapse header-nav">
                <div class="nav pull-right">
                    <a style="background-color: #0e90d2" href="../index.html" id="backBtn" class="btn btn-primary"><span class="icon icon-backward"></span> BACK</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid-full">
    <div class="row-fluid">

        <div class="row-fluid">
            <div class="login-box">
                <h2><i class="halflings-icon home"></i> Login to your account</h2>
                <form class="form-horizontal" action="Handlers/Login.php" method="post">
                    <fieldset>

                        <div class="input-prepend" title="Email">
                            <span class="add-on"><i class="halflings-icon user"></i></span>
                            <input required class="input-large span10" name="email" id="email" type="email" placeholder="type e-mail"/>
                        </div>
                        <div class="clearfix"></div>

                        <div class="input-prepend" title="Password">
                            <span class="add-on"><i class="halflings-icon lock"></i></span>
                            <input required class="input-large span10" name="password" id="password" type="password" placeholder="type password"/>
                        </div>
                        <div class="clearfix"></div>

                        <label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
                        <div class="container-fluid">
                                <?php if(isset($_SESSION['ERROR']) || !empty($_SESSION['ERROR'])){echo $_SESSION['ERROR'];}; ?>
                            </div>
                        <div class="button-login">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="clearfix"></div>
                </form>
                <hr>
                <h3>Forgot Password?</h3>
                <p>
                    No problem, <a style="cursor: pointer;color: #8cafed" onclick="ShowModal('Reset Password','Close','reset_password.php')">reset your password here</a>.
                </p>
            </div><!--/span-->
        </div><!--/row-->


    </div><!--/.fluid-container-->

</div><!--/fluid-row-->
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>