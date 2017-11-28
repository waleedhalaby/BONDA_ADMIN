<?php
require ('../../../Handlers/DBCONNECT.php');

$privilege = $_POST['Privilege'];
$privilege = strtoupper(str_replace(' ','_',$privilege));

$sql = "INSERT INTO privileges (PRIVILEGE) VALUES
        ('".$privilege."')";
$result = mysqli_query($con,$sql);

if($result){
    $sql = "SELECT ID FROM privileges WHERE PRIVILEGE = '".$privilege."'";
    $res = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($res);
    if($rows > 0){
        while($PRIVILEGE_ID = mysqli_fetch_assoc($res)){
            $sql = "SELECT ID FROM persons WHERE PERSON_TYPE_ID <> 2";
            $res2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($res2);
            if($rows2 > 0) {
                while ($MEMBER_ID = mysqli_fetch_assoc($res2)) {
                    if($MEMBER_ID['ID'] == '111111'){
                        $sql = "INSERT INTO person_privileges (PRIVILEGE_ID,PERSON_ID,VALUE) VALUES 
                            ('" . $PRIVILEGE_ID['ID'] . "','" . $MEMBER_ID['ID'] . "',1)";
                    }
                    else{
                        $sql = "INSERT INTO person_privileges (PRIVILEGE_ID,PERSON_ID,VALUE) VALUES 
                            ('" . $PRIVILEGE_ID['ID'] . "','" . $MEMBER_ID['ID'] . "',0)";
                    }
                    $result = mysqli_query($con, $sql);
                }
            }
        }
    }
}
echo json_encode($result);
?>