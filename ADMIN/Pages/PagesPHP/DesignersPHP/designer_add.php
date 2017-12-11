<?php
session_start();
$PERSON_ID = $_SESSION['id'];
?>
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-star"></i>
        <em>Products Portal</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-magic"></i>
        <em>Designers</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-plus-sign"></i>
        <em>Add Designer</em>
    </li>
</ul>
<div class="modal-designer-add-content">
    <form id="addDesignerForm">
        <table class="table table-striped table-bordered designer-details-table">
            <tbody>
                    <tr>
                        <td style="background-color: #0c5460;color:#F4F4F4;">IMAGE</td>
                        <td>
                            <div class="row-fluid">
                                <div class="col-md-12">
                                    <a id="imageBtn1" onclick="HandleFileClick('fileupload1')">
                                        <div class="image-portrait">
                                            <input type="file" name="fileupload1" accept="image/*" id="fileupload1" style="display:none"
                                                   onchange="HandleFileChange('fileupload1','image1','text1','removeImage1')"/>
                                            <img id="image1" class="image-thumb" style="display:none"/>
                                            <p id="text1"><span class="icon-plus"></span><br/>Click here to upload</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div style="text-align: left" class="row-fluid">
                                <div class="col-md-12">
                                    <input type="button" id="removeImage1" style="visibility: hidden;" class="btn btn-small btn-danger"
                                           onclick="RemoveImageBtn('fileupload1','removeImage1','image1','text1')" value="Remove Image"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">DESIGNER*</td><td><input name="addDesigner" id="addDesigner" type="text" placeholder="Enter Designer"
                                                                                                     required/></td></tr>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td><textarea name="addDescription" id="addDescription"></textarea></td></tr>
            </tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="reset" style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Designers.php')" value="Back"/>
        <input type="submit" style="float: right" class="btn btn-warning" id="addDesignerBtn" value="Add"/>
    </form>
</div>

<script>
    function HandleFileClick(id) {
        var fileInput = document.getElementById(id);
        fileInput.click();
    }

    function HandleFileChange(id,image,text,remove) {

        var fileInput = document.getElementById(id);
        var imageInput = document.getElementById(image);
        var textInput = document.getElementById(text);
        var removeBtn = document.getElementById(remove);

        var reader = new FileReader();
        reader.onload = function(){
            imageInput.src = reader.result;
            imageInput.style.display = "block";
        };
        reader.readAsDataURL(fileInput.files[0]);
        imageName = fileInput.files[0]['name'];

        textInput.style.visibility = "hidden";
        removeBtn.style.visibility = "visible";
    }

    function RemoveImageBtn(file,removeButton,image,text){
        var fileInput = document.getElementById(file);
        var imageInput = document.getElementById(image);
        var textInput = document.getElementById(text);

        $('#'+removeButton).css('visibility','hidden');
        imageInput.style.display = "none";
        imageInput.src = '';
        fileInput.value = '';
        textInput.style.visibility = "visible";
    }

    $(document).ready(function(){
        $('#addDesignerForm').submit(function(e){
            e.preventDefault();

            $('#addDesignerBtn').attr('disabled','true');
            $('#addDesignerBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/DesignersPHP/AddDesigner.php?maker=<?php echo $PERSON_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addDesignerForm').serialize(),
                success: function (data) {
                    if(!(data.indexOf('Error')>= 0)) {
                        var url = "Pages/PagesPHP/DesignersPHP/UploadDesignersImages.php?id=" + data;
                        var form_data = new FormData();
                        var file_data1 = document.getElementById('fileupload1').files[0];
                        form_data.append("fileupload1", file_data1);
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (data) {
                                if(data.indexOf("successfully") >=0 || data === ''){
                                    $('#content').load('Pages/Designers.php');
                                    $('#message').html('');
                                    ShowMessageModal('Message','<div class="container-fluid text-center"><span class="label label-warning">Designer is added successfully</span></div>');
                                    $( "#MyModal").unbind( "hide" );
                                }
                                else{
                                    $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                                }
                            },
                            error: function(data){
                                $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                            }
                        });
                    }
                    else{
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                }
            });
        });
    });
</script>