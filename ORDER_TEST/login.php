<?php
    require ('DBCONNECT.php');
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        if ($email == '' || $password == '') {
            $msg = "You must enter all fields";
        } else {
            $sql = "SELECT * FROM persons WHERE EMAIL = '$email' AND PASSWORD = '$password' AND PERSON_TYPE_ID = 2";
            $query = mysqli_query($con,$sql);

            if ($query === false) {
                echo "Could not successfully run query ($sql) from DB: " . mysqli_error($con);
                exit;
            }

            if (mysqli_num_rows($query) > 0) {
                $PERSON_ID = 0;
                $PERSON_NAME = '';
                while($row = mysqli_fetch_array($query)){
                    $PERSON_ID = $row['ID'];
                    $PERSON_NAME = $row['FIRST_NAME'].' '.$row['LAST_NAME'];
                }
                session_start();
                $_SESSION['PERSON_ID'] = $PERSON_ID;
                $_SESSION['PERSON_NAME'] = $PERSON_NAME;
                header('Location: index.php');
                exit;
            }

            $msg = "E-mail and password do not match";
        }
    }
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
    <link rel="shortcut icon" href="../img/favicon.ico" />

    <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
    <link id="bootstrap-style" href="css/font-awesome.min.css" rel="stylesheet">
    <link id="bootstrap-style" href="css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style type="text/css">
        body { background: url(/ADMIN/img/bg-login.jpg) !important; }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse bg-inverse">
        <a class="navbar-brand" href="index.php"><span class="fa fa-address-book"></span> ORDER</a>
        <a id="backBtn" href="../index.html" class="btn btn-success"><span class="fa fa-backward"></span> BACK</a>
    </nav>
    <div class="container-fluid">
        <form name="frmregister"action="<?= $_SERVER['PHP_SELF'] ?>" method="post" >
            <table class="form" border="0">
                <tr>
                    <th><label class="form-control-label" for="email"><strong>E-mail:</strong></label></th>
                    <td><input class="form-control" name="email" id="email" type="email" size="30" /></td>
                </tr>
                <tr>
                    <th><label for="password"><strong>Password:</strong></label></th>
                    <td><input class="form-control" name="password" id="password" type="password" size="30" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="color:red;">
                        <?php echo $msg; ?>
                    </td>
                </tr>
                <tr>
                    <td><hr></td>
                </tr>
                <tr>
                    <td><h3>Forgot Password?</h3></td>
                </tr>
                <tr>
                    <td><p>
                        No problem, <a style="cursor: pointer;color: #8cafed" href="reset_password.php">reset your password here</a>.
                    </p></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="submit-button-right">
                        <input class="btn btn-success" type="submit" value="Submit" alt="Submit" title="Submit" />

                        <input class="btn btn-primary" type="reset" value="Reset" alt="Reset" title="Reset" />
                        <a style="float: right;" class="btn btn-outline-warning" href="register.php">Register</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>