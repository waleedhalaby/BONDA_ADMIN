<?php
require ('../../../Handlers/DBCONNECT.php');

$FIRST_NAME = $_POST['addfName'];
$FIRST_NAME = ucfirst(strtolower($FIRST_NAME));
$LAST_NAME = $_POST['addlName'];
$LAST_NAME = ucfirst(strtolower($LAST_NAME));
$EMAIL = $_POST['addEmail'];
$EMAIL = strtolower($EMAIL);
$PASSWORD = $_POST['addPassword'];
$PASSWORD2 = $_POST['addPassword2'];
$ROLE = $_POST['addRoleCB'];

if($PASSWORD != $PASSWORD2){
    echo false;
}
else{
    $sql = "INSERT INTO persons (FIRST_NAME,LAST_NAME,EMAIL,PASSWORD,PERSON_TYPE_ID) VALUES
        ('".$FIRST_NAME."','".$LAST_NAME."','".$EMAIL."','".md5($PASSWORD)."','".$ROLE."')";
    $result = mysqli_query($con,$sql);

    if($result){
        $sql = "SELECT ID FROM persons WHERE EMAIL = '".$EMAIL."'";
        $res = mysqli_query($con,$sql);
        $rows = mysqli_num_rows($res);
        if($rows > 0){
            while($MEMBER_ID = mysqli_fetch_assoc($res)){
                $sql = "INSERT INTO person_feature_values (PERSON_FEATURE_ID,PERSON_ID,VALUE) VALUES ('2','".$MEMBER_ID['ID']."','INACTIVE')";
                $result = mysqli_query($con, $sql);

                $sql = "SELECT ID FROM PRIVILEGES";
                $res2 = mysqli_query($con, $sql);
                $rows = mysqli_num_rows($res2);
                if($rows > 0){
                    while($row = mysqli_fetch_assoc($res2)){
                        $sql = "INSERT INTO person_privileges (PERSON_ID,PRIVILEGE_ID,VALUE) VALUES ('".$MEMBER_ID['ID']."','".$row['ID']."','0')";
                        $result = mysqli_query($con, $sql);
                    }
                    echo true;
                }
            }
        }
    }
}
?>