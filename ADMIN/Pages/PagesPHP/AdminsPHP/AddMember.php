<?php
require ('../../../Handlers/DBCONNECT.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$FIRST_NAME = $_POST['addfName'];
$FIRST_NAME = ucfirst(strtolower($FIRST_NAME));
$LAST_NAME = $_POST['addlName'];
$LAST_NAME = ucfirst(strtolower($LAST_NAME));
$EMAIL = $_POST['addEmail'];
$EMAIL = strtolower($EMAIL);
$PASSWORD = $_POST['addPassword'];
$PASSWORD2 = $_POST['addPassword2'];
$ROLE = $_POST['addRoleCB'];

if(!isset($FIRST_NAME) || empty($FIRST_NAME) || $FIRST_NAME == ' '){
    echo "First name is required.";
}
elseif(!isset($LAST_NAME) || empty($LAST_NAME) || $LAST_NAME == ' '){
    echo "Last name is required.";
}
elseif($PASSWORD != $PASSWORD2){
    echo "Passwords are not identical.";
}
else{
    $sql = "SELECT EMAIL FROM persons WHERE EMAIL = '".$EMAIL."'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){
        echo "E-mail is already exists.";
    }
    else{
        $sql = "INSERT INTO persons (FIRST_NAME,LAST_NAME,EMAIL,PASSWORD,PERSON_TYPE_ID) VALUES
        ('".$FIRST_NAME."','".$LAST_NAME."','".$EMAIL."','".md5($PASSWORD)."','".$ROLE."')";
        $result = mysqli_query($con,$sql);

        if($result){
            $sql = "SELECT ID FROM persons WHERE EMAIL = '".$EMAIL."'";
            $res = mysqli_query($con,$sql);
            if(mysqli_num_rows($res) > 0){
                while($MEMBER_ID = mysqli_fetch_assoc($res)){
                    $sql = "INSERT INTO person_feature_values (PERSON_FEATURE_ID,PERSON_ID,VALUE) VALUES ('2','".$MEMBER_ID['ID']."','INACTIVE')";
                    $result = mysqli_query($con, $sql);

                    $sql = "SELECT ID FROM PRIVILEGES";
                    $res2 = mysqli_query($con,$sql);
                    if(mysqli_num_rows($res2) > 0){
                        while($row = mysqli_fetch_assoc($res2)){
                            $sql = "INSERT INTO person_privileges (PERSON_ID,PRIVILEGE_ID,VALUE) VALUES ('".$MEMBER_ID['ID']."','".$row['ID']."','0')";
                            $result = mysqli_query($con, $sql);
                        }
                        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','6','Member is added')";
                        $result = mysqli_query($con,$sql);
                        echo "Member is added successfully.";
                    }
                    else{
                        echo 'Error occurred, please contact your administrator.';
                    }
                }
            }
        }
        else{
            echo 'Error occurred, please contact your administrator.';
        }
    }

}
?>