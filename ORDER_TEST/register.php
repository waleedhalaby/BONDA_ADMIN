<?php
    require ('DBCONNECT.php');
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        if ($fname == '' || $lname == '' || $email == '' || $password == '' || $cpassword == '') {
            $msg = "You must enter all fields";
        }
        elseif($password != $cpassword){
            $msg = "Passwords are not identical";
        }
        else {
            $sql = "SELECT * FROM persons WHERE EMAIL = '$email' AND PERSON_TYPE_ID = 2";
            $query = mysqli_query($con,$sql);
            if(mysqli_num_rows($query) > 0){
                $msg = "E-mail is already exists.";
            }
            else{
                $sql = "INSERT INTO persons (FIRST_NAME,LAST_NAME,EMAIL,PASSWORD,PERSON_TYPE_ID)
                    VALUES ('".ucfirst(strtolower($fname))."','".ucfirst(strtolower($lname))."',
                            '".strtolower($email)."','".md5($password)."','2')";
                $query = mysqli_query($con,$sql);

                if ($query === false) {
                    echo "Could not successfully run query ($sql) from DB: " . mysqli_error($con);
                    exit;
                }
                $sql = "SELECT * FROM persons WHERE EMAIL = '$email' AND PASSWORD = '".md5($password)."' AND PERSON_TYPE_ID = 2";
                $query = mysqli_query($con,$sql);

                if (mysqli_num_rows($query) > 0) {
                    $PERSON_ID = 0;
                    $PERSON_NAME = '';
                    while($row = mysqli_fetch_array($query)){
                        $PERSON_ID = $row['ID'];
                        $PERSON_NAME = $row['FIRST_NAME'].' '.$row['LAST_NAME'];
                    }

                    $sql = "INSERT INTO person_feature_values (PERSON_ID,PERSON_FEATURE_ID,VALUE)
                        VALUES ('".$PERSON_ID."','2','INACTIVE')";
                    $result = mysqli_query($con,$sql);

                    session_start();
                    $_SESSION['PERSON_ID'] = $PERSON_ID;
                    $_SESSION['PERSON_NAME'] = $PERSON_NAME;
                    header('Location: index.php');
                    exit;
                }
            }
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
    <link id="bootstrap-style" href="css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-inverse bg-inverse">
        <a class="navbar-brand" href="index.php"><span class="fa fa-address-book"></span> ORDER</a>
        <a id="backBtn" href="../index.html" class="btn btn-success"><span class="fa fa-backward"></span> BACK</a>
    </nav>
    <div class="container-fluid">
        <form class="form-group" name="frmregister"action="<?= $_SERVER['PHP_SELF'] ?>" method="post" >
            <table class="form" border="0">
                <tr>
                    <th><label class="form-control-label" for="fname"><strong>First Name:</strong></label></th>
                    <td><input class="form-control" name="fname" id="fname" type="text" size="50" /></td>
                </tr>
                <tr>
                    <th><label class="form-control-label" for="lname"><strong>Last Name:</strong></label></th>
                    <td><input class="form-control" name="lname" id="lname" type="text" size="50" /></td>
                </tr>
                <tr>
                    <th><label class="form-control-label" for="email"><strong>E-mail:</strong></label></th>
                    <td><input class="form-control" name="email" id="email" type="email" size="30" /></td>
                </tr>
                <tr>
                    <th><label class="form-control-label" for="password"><strong>Password:</strong></label></th>
                    <td><input class="form-control" name="password" id="password" type="password" size="30" /></td>
                </tr>
                <tr>
                    <th><label class="form-control-label" for="cpassword"><strong>Confirm Password:</strong></label></th>
                    <td><input class="form-control" name="cpassword" id="cpassword" type="password" size="30" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="color:red;">
                        <?php echo $msg; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="submit-button-right">
                        <input class="btn btn-success" type="submit" value="Register" alt="Register" title="Register" />

                        <input class="btn btn-primary" type="reset" value="Reset" alt="Reset" title="Reset" />
                        <a style="float: right;" class="btn btn-outline-primary" href="login.php">Login</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>