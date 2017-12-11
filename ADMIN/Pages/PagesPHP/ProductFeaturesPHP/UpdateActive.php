    <?php
    require('../../../Handlers/DBCONNECT.php');
    require ('../../../Handlers/Authenticate.php');

    $FEATURE_ID = $_GET['id'];
    $IS_ACTIVE_OLD = $_GET['os'];

    if($IS_ACTIVE_OLD == '0'){
        $sql = "UPDATE product_features SET IS_ACTIVE = '1' WHERE ID='".$FEATURE_ID."'";
        $res = mysqli_query($con,$sql);
    }
    else{
        $sql = "UPDATE product_features SET IS_ACTIVE = '0' WHERE ID='".$FEATURE_ID."'";
        $res = mysqli_query($con,$sql);
    }
?>