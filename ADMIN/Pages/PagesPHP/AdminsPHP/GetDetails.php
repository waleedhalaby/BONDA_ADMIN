<?php
require ('../../../Handlers/DBCONNECT.php');

$MEMBER_ID = $_GET['id'];

$sql = "SELECT PR.ID, PR.FIRST_NAME, PR.LAST_NAME, PR.EMAIL, PT.TYPE FROM persons PR
            INNER JOIN person_types PT ON PR.PERSON_TYPE_ID = PT.ID
            WHERE PR.ID = ".$MEMBER_ID;
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);

if($rows > 0){
    $json = Array();
    $i = 0;
    if($rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $json[$i]['ID'] = $row['ID'];
            $json[$i]['FIRST_NAME'] = $row['FIRST_NAME'];
            $json[$i]['LAST_NAME'] = $row['LAST_NAME'];
            $json[$i]['EMAIL'] = $row['EMAIL'];
            $json[$i]['TYPE'] = $row['TYPE'];

            $sql = "SELECT V.ID, F.FEATURE, V.VALUE FROM person_feature_values V
                        INNER JOIN person_features F ON V.PERSON_FEATURE_ID = F.ID
                        INNER JOIN persons P ON V.PERSON_ID = P.ID
                        WHERE F.FEATURE NOT LIKE 'STATUS' AND P.ID = ".$row['ID'];
            $result2 = mysqli_query($con,$sql);
            $rows2 = mysqli_num_rows($result2);

            if($rows2 > 0) {
                $j = 0;
                while ($row2 = mysqli_fetch_array($result2)) {
                    $json[$i]['FEATURES'][$j]['ID']= $row2['FEATURE'];
                    $json[$i]['FEATURES'][$j]['FEATURE']= $row2['FEATURE'];
                    $json[$i]['FEATURES'][$j]['VALUE']= $row2['VALUE'];
                    $j++;
                }
            }
            else{
                $json[$i]['FEATURES'] = Array();
            }
            $i++;
        }
    }
    echo json_encode($json);
}
?>