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
    <form id="ResetForm">
        <table class="form" border="0">
            <tr>
                <th><label class="form-control-label" for="editEmail"><strong>E-mail:</strong></label></th>
                <td><input class="form-control" name="editEmail" id="editEmail" type="email" size="30" /></td>
            </tr>
            <tr>
                <th><label for="editPassword"><strong>Password:</strong></label></th>
                <td><input class="form-control" name="editPassword" id="editPassword" type="password" size="30" /></td>
            </tr>
            <tr>
                <th><label for="editCPassword"><strong>Confirm Password:</strong></label></th>
                <td><input class="form-control" name="editCPassword" id="editCPassword" type="password" size="30" /></td>
            </tr>
            <tr>
                <td colspan="2"><div id="message"></td>
            </tr>
            <tr>
                <td></td>
                <td class="submit-button-right">
                    <input class="btn btn-success" type="submit" value="Reset" alt="Reset" title="Reset" />
                </td>
            </tr>
        </table>
    </form>
</div>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#ResetForm').submit(function(e){
            e.preventDefault();
            var url = "ResetPassword.php";

            $.ajax({
                type: "POST",
                url: url,
                data: $('#ResetForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >= 0) {
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>' +
                            '<br/><a href="login.php">Return to login</a>');
                    }
                    else{
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.'+data+'</div>');
                }
            });
        });
    });
</script>
