<?php
    require('../../../Handlers/DBCONNECT.php');
    session_start();

    $sql = "SELECT DISTINCT PR.ID, PR.EMAIL, PR.FIRST_NAME, PR.LAST_NAME, PT.TYPE, VL.VALUE AS STATUS FROM PERSONS PR 
            INNER JOIN PERSON_FEATURE_VALUES VL ON PR.ID = VL.PERSON_ID 
            INNER JOIN PERSON_FEATURES VF ON VL.PERSON_FEATURE_ID = VF.ID
			INNER JOIN PERSON_TYPES PT ON PR.PERSON_TYPE_ID = PT.ID
            WHERE PR.PERSON_TYPE_ID <> 2 AND PR.ID <> ".$_SESSION['id']." AND PR.ID <> 111111 AND (VF.FEATURE LIKE '%STATUS%')";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_num_rows($result);

    if($rows > 0){
        $json = mysqli_fetch_all($result);

        echo json_encode($json);
    }
?>