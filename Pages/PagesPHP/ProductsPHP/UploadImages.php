<?php
require ('../../../Handlers/DBCONNECT.php');

if(isset($_FILES['file']["type"]))
{
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES['file']["name"]);
    $file_extension = end($temporary);
    if ((($_FILES['file']["type"] == "image/png") || ($_FILES['file']["type"] == "image/jpg") || ($_FILES['file']["type"] == "image/jpeg")
        ) && ($_FILES['file']["size"] < 100000)//Approx. 100kb files can be uploaded.
        && in_array($file_extension, $validextensions)) {
        if ($_FILES['file']["error"] > 0)
        {
            echo "Return Code: " . $_FILES['file']["error"] . "<br/><br/>";
        }
        else
        {
            $IMAGE = null;
            if($_GET['image'] != ''){
                $IMAGE = $_GET['image'];
            }

            $OLD_IMAGE = null;
            if($_GET['oldimage'] != ''){
                $OLD_IMAGE = $_GET['oldimage'];
            }

            $ID = null;
            if($_GET['id'] != ''){
                $ID = $_GET['id'];
            }

            if(($ID != null || $ID != '') && ($IMAGE != null || $IMAGE != '')){
                if($OLD_IMAGE != null || $OLD_IMAGE != '')
                {
                    $sql = "SELECT ID,IMAGE_PATH FROM PRODUCTS_IMAGES WHERE PRODUCT_ID = '".$ID."' AND IMAGE_PATH ='".$OLD_IMAGE."'";
                    $result3 = mysqli_query($con,$sql);
                    $rows = mysqli_num_rows($result3);
                    $IS_UPDATED = false;
                    if($rows > 0){
                        $ID = 0;
                        while($row = mysqli_fetch_array($result3)){
                            if($IMAGE == $OLD_IMAGE && $row['IMAGE_PATH'] == $OLD_IMAGE){
                                $IS_UPDATED = false;
                                echo $OLD_IMAGE." ".$row['IMAGE_PATH'];
                            }
                            else {
                                $IS_UPDATED = true;
                                $ID = $row['ID'];
                            }
                        }
                        if($IS_UPDATED){
                            $sql = "UPDATE PRODUCTS_IMAGES SET IMAGE_PATH = 'Assets/" . $IMAGE . "' WHERE ID = '" . $ID . "'";
                            $result4 = mysqli_query($con, $sql);
                            echo "<div class='container-fluid text-center'><span class='label label-warning'>Image is updated successfully.<span>";
                        }
                        else{
                            echo "<div class='container-fluid text-center'><span class='label label-danger'>Image already exists.<span></div>";
                        }
                    }
                }
                else{
                    $sql = "INSERT INTO PRODUCTS_IMAGES (PRODUCT_ID,IMAGE_PATH) VALUES ('".$ID."','Assets/".$IMAGE."')";
                    $result2 = mysqli_query($con,$sql);
                    if (!file_exists("../../../Assets/" . $_FILES['file']["name"])) {
                        $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                        $targetPath = "../../../Assets/".$_FILES['file']['name']; // Target path where file is to be stored
                        move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
                    }
                    echo "<div class='container-fluid text-center'><span class='label label-warning'>Image is uploaded successfully.<span></div>";
                }

            }
            else{
                echo "<div class='container-fluid text-center'><span class='label label-danger'>Something wrong occurred, please contact your administrator.<span></div>";
            }
        }
    }
    else
    {
        echo "<div class='container-fluid text-center'><span class='label label-danger'>***Invalid file Size or Type***<span></div>";
    }
}
else{
    echo "<div class='container-fluid text-center'><span class='label label-danger'>No File Added</div>";
}

?>