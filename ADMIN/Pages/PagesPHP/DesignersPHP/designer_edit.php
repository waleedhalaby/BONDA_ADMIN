<?php

session_start();
$PERSON_ID = $_SESSION['id'];

$DESIGNER_ID = $_GET['id'];

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
        <i class="icon-edit"></i>
        <em>Edit Designer</em>
    </li>
</ul>
<div class="ajax-loader2">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<div class="modal-designer-edit-content">
    <form id="editDesignerForm">
        <table class="table table-striped table-bordered designer-details-table">
            <tbody></tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="reset" style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Designers.php')" value="Back"/>
        <input type="submit" style="float: right" class="btn btn-warning" id="editDesignerBtn" value="Save"/>
    </form>
</div>
<script>
    var isChanged = false;
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

        $.ajax({
            url:'Pages/PagesPHP/DesignersPHP/RemoveDesignerImages.php?id=<?php echo $DESIGNER_ID ?>',
            type:"POST",
            success:function(){
                $('#'+removeButton).css('visibility','hidden');
                imageInput.style.display = "none";
                imageInput.src = '';
                fileInput.value = '';
                textInput.style.visibility = "visible";
                isChanged = true;
            },
            error:function(){
                $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
            }
        });

    }
    $(document).ready(function(){
        $.get('Pages/PagesPHP/DesignersPHP/GetDetails.php?id=<?php echo $DESIGNER_ID ?>',function(data){
            var designer = $.parseJSON(data);
            var image;
            if(designer[0]['IMAGE'] !== null){
                image = '<tr><td colspan="2" class="text-left">' +
                    '<div class="row-fluid">'+
                    '<div class="col-md-12">'+
                    '<a id="imageBtn1" onclick="HandleFileClick(\'fileupload1\')">' +
                        '<div class="image-portrait">' +
                        '<input type="file" id="fileupload1" style="display:none" onchange="HandleFileChange(\'fileupload1\',\'image1\',\'text1\',\'removeImage1\')"/>'+
                        '<img id="image1" src="'+designer[0]['IMAGE']+'" class="image-thumb"/>'+
                        '<input type="hidden" id="oldImage1" value="'+designer[0]['IMAGE']+'"/>'+
                        '<p style="visibility: hidden" id="text1"><span class="icon-plus"></span><br/>Click here to upload</p>'+
                        '</div>'+
                    '</a>' +
                    '</div></div>'+
                    '<div style="text-align: left" class="row-fluid">'+
                    '<div class="col-md-12">'+
                    '<input type="button" id="removeImage1" class="btn btn-small btn-danger"'+
                        ' onclick="RemoveImageBtn(\'fileupload1\',\'removeImage1\',\'image1\',\'text1\')" value="Remove Image"/>'+
                    '</div>'+
                    '</div>'+
                    '</td></tr>';
            }
            else{
                image = '<tr><td colspan="2" class="text-left">' +
                    '<div class="row-fluid">'+
                    '<div class="col-md-12">'+
                        '<a id="imageBtn1" onclick="HandleFileClick(\'fileupload1\')">'+
                    '      <div class="image-portrait">'+
                    '            <input type="file" id="fileupload1" style="display:none" onchange="HandleFileChange(\'fileupload1\',\'image1\',\'text1\',\'removeImage1\')"/>' +
                    '            <img id="image1" class="image-thumb" style="display:none"/>' +
                    '            <input type="hidden" id="oldImage1" value="0"/>' +
                    '            <p id="text1"><span class="icon-plus"></span><br/>Click here to upload</p>' +
                    '      </div>'+
                    '    </a>'+
                    '</div></div>'+
                    '<div style="text-align: left" class="row-fluid">'+
                    '<div class="col-md-12">'+
                    '<input type="button" id="removeImage1" style="visibility: hidden;" class="btn btn-small btn-danger"'+
                    ' onclick="RemoveImageBtn(\'fileupload1\',\'removeImage1\',\'image1\',\'text1\')" value="Remove Image"/>'+
                    '</div>'+
                    '</div>'+
                    '</td></tr>';
            }
            $('.designer-details-table tbody').html(
                image+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESIGNER*</td><td><input id="editDesigner" name="editDesigner" type="text" value="'+designer[0]['DESIGNER']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td><textarea id="editDescription" name="editDescription">'+designer[0]['DESCRIPTION']+'</textarea></td></tr>'
            );
        });

        $('#editDesignerForm').submit(function(e){
            e.preventDefault();

            $('#editDesignerBtn').attr('disabled','true');
            $('#editDesignerBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/DesignersPHP/EditDesigner.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $DESIGNER_ID ?>";


            $.ajax({
                type: "POST",
                url: url,
                data: $('#editDesignerForm').serialize(),
                success: function (data) {
                    if(!(data.indexOf('Error')>= 0)){
                        var url = "Pages/PagesPHP/DesignersPHP/UpdateDesignerImages.php?id="+data;
                        var form_data = new FormData();
                        var file_data1 = document.getElementById('fileupload1').files[0];
                        form_data.append("fileupload1",file_data1);
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (data) {
                                if(data.indexOf("successfully") >=0 || data === '' || isChanged){
                                    $('#content').load('Pages/Designers.php');
                                    $('#message').html('');
                                    ShowMessageModal('Message','<div class="container-fluid text-center"><span class="label label-warning">Designer is updated successfully</span></div>');
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