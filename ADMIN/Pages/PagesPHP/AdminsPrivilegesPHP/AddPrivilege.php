<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$privilege = $_POST['Privilege'];
$privilege = strtoupper(str_replace(' ','_',$privilege));
$category_id = $_POST['ID'];
if(!isset($privilege) || empty($privilege) || $privilege == ' '){
    echo "Privilege name is required.";
}
else{
    $sql = "SELECT PRIVILEGE FROM privileges WHERE PRIVILEGE = '".$privilege."'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "Privilege is already exists.";
    }
    else {
        $sql = "INSERT INTO privileges (PRIVILEGE,CATEGORY_ID) VALUES
            ('" . $privilege . "','".$category_id."')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $sql = "SELECT ID FROM privileges WHERE PRIVILEGE = '" . $privilege . "'";
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) > 0) {
                while ($PRIVILEGE_ID = mysqli_fetch_assoc($res)) {
                    $sql = "SELECT ID FROM persons WHERE PERSON_TYPE_ID <> 2";
                    $res2 = mysqli_query($con, $sql);
                    if (mysqli_num_rows($res2) > 0) {
                        while ($MEMBER_ID = mysqli_fetch_assoc($res2)) {
                            if ($MEMBER_ID['ID'] == '111111') {
                                $sql = "INSERT INTO person_privileges (PRIVILEGE_ID,PERSON_ID,VALUE) VALUES 
                                ('" . $PRIVILEGE_ID['ID'] . "','" . $MEMBER_ID['ID'] . "',1)";
                            } else {
                                $sql = "INSERT INTO person_privileges (PRIVILEGE_ID,PERSON_ID,VALUE) VALUES 
                                ('" . $PRIVILEGE_ID['ID'] . "','" . $MEMBER_ID['ID'] . "',0)";
                            }
                            $result = mysqli_query($con,$sql);
                        }
                        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','7','Privilege is added')";
                        $result = mysqli_query($con,$sql);
                        if($MAKER_ID != 111111){
                            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','icon-eye-open','red','Pages/AdminsPrivileges.php','New Privilege is added','0')";
                            $result = mysqli_query($con,$sql);
                        }
                        echo "Privilege is added successfully.";
                    } else {
                        echo "'Error occurred1, please contact your administrator.";
                    }
                }
            } else {
                echo "'Error occurred2, please contact your administrator.";
            }
        } else {
            echo "'Error occurred3, please contact your administrator.";
        }
    }
}
?>