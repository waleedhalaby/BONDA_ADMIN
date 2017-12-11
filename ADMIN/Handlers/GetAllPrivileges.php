<?php
require ('DBCONNECT.php');
require ('Authenticate.php');
$ID = $_SESSION['id'];

$sql = "SELECT DISTINCT PP.ID, P.PRIVILEGE, PP.VALUE FROM person_privileges PP
            INNER JOIN privileges P ON PP.PRIVILEGE_ID = P.ID WHERE PP.PERSON_ID = ".$ID."";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result) > 0){
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $json[$i]['ID'] = $row['ID'];
        $json[$i]['PRIVILEGE'] = $row['PRIVILEGE'];
        $json[$i]['VALUE'] = $row['VALUE'];
        $i++;
    }

    echo json_encode($json);
}
?>