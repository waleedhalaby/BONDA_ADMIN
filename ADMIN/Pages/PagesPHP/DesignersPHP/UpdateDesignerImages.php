<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$ID = $_GET['id'];

if(isset($_FILES['fileupload1']) && $_FILES['fileupload1']['size'] != 0){
    echo UploadImage($ID,'fileupload1');
}

function UploadImage($product_id,$id){
    require ('../../../Handlers/DBCONNECT.php');

    if(isset($_FILES[$id]["type"]))
    {
        $validextensions = array("jpeg", "jpg", "png","JPEG", "JPG", "PNG");
        $temporary = explode(".", $_FILES[$id]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES[$id]["type"] == "image/png") || ($_FILES[$id]["type"] == "image/PNG") ||
                ($_FILES[$id]["type"] == "image/jpg") || ($_FILES[$id]["type"] == "image/JPG") ||
                ($_FILES[$id]["type"] == "image/jpeg") || ($_FILES[$id]["type"] == "image/JPEG")
            ) && ($_FILES[$id]["size"] < 1000000)//Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)) {
            if ($_FILES[$id]["error"] > 0)
            {
                return "Return Code: " . $_FILES[$id]["error"] . "<br/><br/>";
            }
            else
            {
                $IMAGE = null;
                if($_FILES[$id]["name"] != ''){
                    $IMAGE = $_FILES[$id]["name"];
                }

                $ID = null;
                if($product_id != ''){
                    $ID = $product_id;
                }

                if(($ID != null || $ID != '') && ($IMAGE != null || $IMAGE != '')){
                    $sql = "UPDATE designers SET IMAGE_PATH = 'Assets/Designers/".$_FILES[$id]["name"]."' WHERE ID = ".$ID;
                    $result2 = mysqli_query($con,$sql);
                    if (!file_exists("../../../Assets/Designers/" . $_FILES[$id]["name"])) {
                        $sourcePath = $_FILES[$id]['tmp_name']; // Storing source path of the file in a variable
                        $targetPath = "../../../Assets/Designers/".$_FILES[$id]['name']; // Target path where file is to be stored
                        move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
                    }
                    return "<div class='container-fluid text-center'><span class='label label-warning'>Image is uploaded successfully.<span></div>";
                }
                else{
                    return "<div class='container-fluid text-center'><span class='label label-danger'>Something wrong occurred, please contact your administrator.<span></div>";
                }
            }
        }
        else
        {
            return "<div class='container-fluid text-center'><span class='label label-danger'>***Invalid file Size or Type***<span></div>";
        }
    }
    else{
        return "<div class='container-fluid text-center'><span class='label label-danger'>No File Added</div>";
    }
}

?>