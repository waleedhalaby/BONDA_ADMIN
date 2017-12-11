<?php
    require('../../../Handlers/DBCONNECT.php');
    require ('../../../Handlers/Authenticate.php');

    $sql = "SELECT DISTINCT PR.ID, PR.EMAIL, PR.FIRST_NAME, PR.LAST_NAME, PT.TYPE, VL.VALUE AS STATUS FROM persons PR 
            INNER JOIN person_feature_values VL ON PR.ID = VL.PERSON_ID 
            INNER JOIN person_features VF ON VL.PERSON_FEATURE_ID = VF.ID
			INNER JOIN person_types PT ON PR.PERSON_TYPE_ID = PT.ID
            WHERE PR.PERSON_TYPE_ID <> 2 AND (VF.FEATURE LIKE '%STATUS%') AND
            PR.ID <> ".$_SESSION['id']." AND PR.ID <> 111111";
    $result = mysqli_query($con,$sql);
    $json = Array();
    if(mysqli_num_rows($result) > 0){
        $json = mysqli_fetch_all($result);

    }
    echo json_encode($json);
?>