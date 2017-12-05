<?php
    require ('../Handlers/DBCONNECT.php');
    $PRIVILEGE = $_GET['p'];
    $VALUE = $_GET['v'];
    $ID = $_GET['i'];

    switch($PRIVILEGE){
        case 'product':
            $PRIVILEGE = '38';
            break;
        case 'order':
            $PRIVILEGE = '39';
            break;
        case 'administration':
            $PRIVILEGE = '45';
            break;
        case 'page':
            $PRIVILEGE = '65';
            break;
        case 'dashboard':
            $PRIVILEGE = '66';
            break;
        case 'notification':
            $PRIVILEGE = '32';
            break;
        case 'message':
            $PRIVILEGE = '33';
            break;
    }


    $res = mysqli_query($con,"
    SELECT pp.ID, p.PRIVILEGE, p.CATEGORY_ID FROM person_privileges pp
    INNER JOIN privileges p ON pp.PRIVILEGE_ID = p.ID
    WHERE pp.PERSON_ID = '".$ID."' AND pp.PRIVILEGE_ID = '".$PRIVILEGE."'");
    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_array($res)){
            echo 'PRIVILEGE: ['.$row['PRIVILEGE'].'/'.$row['CATEGORY_ID'].']';
            $res2 = mysqli_query($con,"UPDATE person_privileges SET VALUE = '".$VALUE."' WHERE ID = '".$row['ID']."'");
            if($res2){
                echo $VALUE == '0'? '  IS UPDATED TO [FALSE]' : '  IS UPDATED TO [TRUE]';
                if(($PRIVILEGE == '38' || $PRIVILEGE == '39' || $PRIVILEGE == '45' || $PRIVILEGE == '65' || $PRIVILEGE == '66')){
                    $sql = '';
                    if($row['CATEGORY_ID'] == '100')
                        $sql = "UPDATE pages SET IS_VISIBLE = '".$VALUE."' WHERE ID = '1'";
                    else if($row['CATEGORY_ID'] == '200')
                        $sql = "UPDATE pages SET IS_VISIBLE = '".$VALUE."' WHERE ID = '2'";
                    else if($row['CATEGORY_ID'] == '300')
                        $sql = "UPDATE pages SET IS_VISIBLE = '".$VALUE."' WHERE ID = '3'";
                    else if($row['CATEGORY_ID'] == '400')
                        $sql = "UPDATE pages SET IS_VISIBLE = '".$VALUE."' WHERE ID = '4'";
                    else if($row['CATEGORY_ID'] == '500')
                        $sql = "UPDATE pages SET IS_VISIBLE = '".$VALUE."' WHERE ID = '5'";
                    $result = mysqli_query($con,$sql);
                    if($result){
                        echo $VALUE == '0' ? ' AND PAGE IS SET TO [FALSE]':' AND PAGE IS SET TO [TRUE]';
                    }
                    else{
                        echo ' AND PAGE IS NOT UPDATED SUCCESSFULLY';
                    }
                }
            }
            else
                echo ' NOT UPDATED SUCCESSFULLY';

        }
    }
    else{
        echo 'NOT FOUND';
    }
?>