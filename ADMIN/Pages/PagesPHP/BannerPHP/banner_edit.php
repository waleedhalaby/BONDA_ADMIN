<?php
$BANNER_ID = $_GET['id'];
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
        <i class="icon-file"></i>
        <em>Pages Portal</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-picture"></i>
        <em>Banners</em>
    </li>
    <li>
        <i class="icon-edit"></i>
        <em>Edit Banner</em>
    </li>
</ul>
<div class="modal-banner-edit-content">
    <form id="editBannerForm">
        <table class="table table-striped table-bordered banner-details-table">
            <tbody></tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="reset" style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Banner.php')" value="Back"/>
        <input type="submit" style="float: right" class="btn btn-warning" id="editBannerBtn" value="Save"/>
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
            url:'Pages/PagesPHP/BannerPHP/RemoveBannerImages.php?id=<?php echo $BANNER_ID ?>',
            type:"POST",
            success:function(data){
                $('#'+removeButton).css('visibility','hidden');
                imageInput.style.display = "none";
                imageInput.src = '';
                fileInput.value = '';
                textInput.style.visibility = "visible";
                isChanged = true;
            },
            error:function(data){
                $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
            }
        });

    }
    $(document).ready(function(){
        $.get('Pages/PagesPHP/BannerPHP/GetDetails.php?id=<?php echo $BANNER_ID ?>',function(data){
            var banner = $.parseJSON(data);
            var image;
            if(banner['IMAGE'] !== null){
                image = '<tr><td colspan="2" class="text-left">' +
                    '<div class="row-fluid">'+
                    '<div class="col-md-12">'+
                    '<a id="imageBtn1" onclick="HandleFileClick(\'fileupload1\')">' +
                    '<div class="image-portrait">' +
                    '<input type="file" id="fileupload1" style="display:none" onchange="HandleFileChange(\'fileupload1\',\'image1\',\'text1\',\'removeImage1\')"/>'+
                    '<img id="image1" src="'+banner['IMAGE']+'" class="image-thumb"/>'+
                    '<input type="hidden" id="oldImage1" value="'+banner['IMAGE']+'"/>'+
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



            $('.banner-details-table tbody').html(
                image+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">TITLE</td><td><input id="editTitle" name="editTitle" type="text" value="'+banner['TITLE']+'" required/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td><textarea id="editDescription" name="editDescription">'+banner['DESCRIPTION']+'</textarea></td></tr>'
            );
        });

        $('#editBannerForm').submit(function(e){
            e.preventDefault();

            $('#editBannerBtn').attr('disabled','true');
            $('#editBannerBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/BannerPHP/EditBanner.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $BANNER_ID ?>";


            $.ajax({
                type: "POST",
                url: url,
                data: $('#editBannerForm').serialize(),
                success: function (data) {
                    if(!(data.indexOf('Error')>= 0)){
                        var url = "Pages/PagesPHP/BannerPHP/UpdateBannerImages.php?id="+data;
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
                                    $('#content').load('Pages/Banner.php');
                                    $('#message').html('');
                                    ShowMessageModal('Message','<div class="container-fluid text-center"><span class="label label-warning">Banner image is updated successfully</span></div>');
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