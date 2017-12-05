<?php
    require ('DBCONNECT.php');
    $sql = "SELECT * FROM pages WHERE PARENT = '0'";
    $res = mysqli_query($con,$sql);
    $i = 0;
    while($row = mysqli_fetch_array($res)){
        if($row['IS_VISIBLE'] == '1'){
            $sql = "SELECT * FROM pages WHERE IS_VISIBLE = 1 AND PARENT = '".$row['ID']."'";
            $result = mysqli_query($con,$sql);

            $json[$i]['ID'] = $row['ID'];
            $json[$i]['TITLE'] = $row['TITLE'];
            $json[$i]['LINK'] = $row['LINK'];
            $json[$i]['ICON'] = $row['ICON'];
            $json[$i]['LAST_VISITED'] = $row['LAST_VISITED'];
            if(mysqli_num_rows($result) > 0){
                $j = 0;
                while($row2 = mysqli_fetch_array($result)){
                    $json[$i]['SUBITEMS'][$j]['ID'] = $row2['ID'];
                    $json[$i]['SUBITEMS'][$j]['TITLE'] = $row2['TITLE'];
                    $json[$i]['SUBITEMS'][$j]['LINK'] = $row2['LINK'];
                    $json[$i]['SUBITEMS'][$j]['ICON'] = $row2['ICON'];
                    $json[$i]['SUBITEMS'][$j]['IS_VISIBLE'] = $row2['IS_VISIBLE'];
                    $json[$i]['SUBITEMS'][$j]['LAST_VISITED'] = $row2['LAST_VISITED'];
                    $j++;
                }
            }
            else{

                $json[$i]['SUBITEMS'] = Array();
            }
            $i++;
        }

    }
    echo json_encode($json);
?>