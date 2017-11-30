<?php
$PRODUCT_ID = $_GET['id'];
session_start();
$PERSON_ID = $_SESSION['id'];
?>

<div class="modal-product-edit-content">
    <label>Product Details</label>
    <form id="editProductForm">
        <table class="table table-striped table-bordered product-details-table">
            <tbody></tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="submit" style="float: right" class="btn btn-warning" id="editProductBtn" value="Save Changes"/>
    </form>
</div>
<div class="modal-product-det-content">
    <label>Product Images</label>
    <div id="imagesDiv" style="padding-top:10px; padding-bottom:10px; background-color: #f9f9f9" class="container-fluid text-center">
        <div id="Images" class="row-fluid">
            <div class="col-md-12">
            </div>
        </div>
        <div id="UploadButtons" class="uploadButtons row-fluid">
            <div class="col-md-12">
            </div>
        </div>
        <div id="RemoveButtons" class="removeButtons row-fluid">
            <div class="col-md-12">
            </div>
        </div>
    </div>
    <p id="imageMessage"></p>
</div>

<script>
    var ProductID = <?php echo $PRODUCT_ID ?>;
    var imageName = '';
    var oldImage = '';
    var counter = 0;


    $(document).ready(function(){
        var changes;
        var length = 0;
        $.get('Pages/PagesPHP/ProductsPHP/GetEditDetails.php?id=<?php echo $PRODUCT_ID ?>',function(data) {
            var product = $.parseJSON(data);
            var counter2 = 0;
            $('.product-details-table tbody').html(
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">ID</td><td>['+product[0]['ID']+']</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">SKU ID</td><td><input id="editSKUID" style="text-align: center" name="editSKUID" type="text" readonly value="'+product[0]['SKU_ID']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">NAME</td><td><input id="editName" name="editName" type="text" value="'+product[0]['NAME']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">PRICE</td><td><input id="editPrice" name="editPrice" type="number" step="0.01" value="'+product[0]['PRICE']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td><textarea id="editDescription" name="editDescription" class="cleditor">'+product[0]['DESCRIPTION']+'</textarea></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">CATEGORY</td><td><span class="label label-warning">'+product[0]['CATEGORY']+'</span></td></tr>'
            );
            $(product[0]['FEATURES']).each(function(id,feature){
                $('.product-details-table tbody').append(
                    '<tr><td style="background-color: #0c5460;color:#F4F4F4;">'+feature['FEATURE']+'</td><td>'+InputEditDataType(feature['ID'],feature['DATA_TYPE'],feature['FEATURE'],feature['VALUE'])+'</td></tr>'
                );
                counter++;
            });
            $(product[0]['IMAGES']).each(function(id,image){
                $('#Images .col-md-12').append(
                    '<a id="imageBtn'+counter2+'" onclick="document.getElementById(\'fileupload'+counter2+'\').click()">' +
                    '    <div class="image-portrait">' +
                    '        <input type="file" id="fileupload'+counter2+'" style="display:none"/>' +
                    '        <img id="image'+counter2+'" src="'+image['IMAGE_PATH']+'" class="image-thumb"/>' +
                    '        <input type="hidden" id="oldImage'+counter2+'" value="'+image['IMAGE_PATH']+'"/>'+
                    '        <p style="visibility: hidden" id="text'+counter2+'"><span class="icon-plus"></span><br/>Click here to upload</p>'+
                    '     </div>' +
                    '</a>');
                $('#UploadButtons .col-md-12').append(
                    '<button id="uploadImage'+counter2+'" class="btn btn-small btn-info" disabled>Change Image</button>'
                );
                $('#RemoveButtons .col-md-12').append(
                    '<button id="removeImage'+counter2+'" class="btn btn-small btn-danger">Remove Image</button>'
                );
                counter2++;
            });

            if(product[0]['IMAGES'].length !== 4){
                var count = 4 - product[0]['IMAGES'].length;
                for(var i = 0 ; i < count ; i++){
                    $('#Images .col-md-12').append(
                        '<a id="imageBtn'+counter2+'" onclick="document.getElementById(\'fileupload'+counter2+'\').click()">' +
                        '    <div class="image-portrait">'+
                        '        <input type="file" id="fileupload'+counter2+'" style="display:none"/>'+
                        '        <img id="image'+counter2+'" class="image-thumb" style="display:none"/>'+
                        '        <input type="hidden" id="oldImage'+counter2+'" value="0"/>'+
                        '        <p id="text'+counter2+'"><span class="icon-plus"></span><br/>Click here to upload</p>'+
                        '    </div>' +
                        '</a>');
                    $('#UploadButtons .col-md-12').append(
                        '<button id="uploadImage'+counter2+'" class="btn btn-small btn-info" disabled>Upload Image</button>'
                    );

                    $('#RemoveButtons .col-md-12').append(
                        '<button id="removeImage'+counter2+'" style="visibility: hidden" class="btn btn-small btn-danger">Remove Image</button>'
                    );

                    $('#imageBtn'+counter2).on('click',function(){
                        $('#fileupload'+counter2).click();
                    });
                    counter2++;
                }
            }
            length = counter2;
        }).success(function(){

            $('.uploadButtons button').on('click',function(){
                var id = $(this).attr('id');
                id = id.substr(id.length - 1);
                SaveImageBtn('fileupload'+id,'oldImage'+id,'uploadImage'+id,'removeImage'+id);
            });

            $('.removeButtons button').on('click',function(){
                var id = $(this).attr('id');
                id = id.substr(id.length - 1);
                RemoveImageBtn('fileupload'+id,'oldImage'+id,'uploadImage'+id,'removeImage'+id,'image'+id,'text'+id);
            });

            $('.image-portrait input').on('change',function(){
                var id = $(this).attr('id');
                id = id.substr(id.length - 1);
                HandleFileChange('fileupload'+id,'image'+id,'text'+id,'uploadImage'+id);
            });

            $('.product-details-table tbody input[type="checkbox"]').on('change',function(){
                console.log('changed from '+$(this).prop('checked'));
                if($(this).prop('checked') === true)
                    $(this).val('true');
                else
                    $(this).val('false');
                console.log(' to '+$(this).val());
            });

            $('#editProductForm').submit(function(e){
                e.preventDefault();



                var values = '';
                var featureIds = '';
                for(var i = 0 ; i < counter ; i++){
                    var id = $('.val').attr('id');
                    featureIds += id.replace('value','')+'$';
                    values += $('.val').val()+'$';
                }

                var url = "Pages/PagesPHP/ProductsPHP/UpdateProduct.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $PRODUCT_ID ?>&values="+values+"&featureids="+featureIds;


                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#editProductForm').serialize(),
                    success: function (data) {
                        if(data === '') {
                            $('#content').load('Pages/Products.php');
                            $('#message').html('');
                            $('#message').html('<div class="container-fluid text-center"><span class="label label-warning">Product is updated successfully.</span></div>');
                        }
                        else{
                            $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                        }
                    },
                    error: function(data){
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</div>');
                    }
                });
            });
        });
    });
    var url = '';

    function SaveImageBtn(file,image,uploadButton,removeButton){
        var fileInput = document.getElementById(file);
        oldImage = document.getElementById(image);
        var file_data = fileInput.files[0];
        var form_data = new FormData();
        form_data.append("file",file_data);

        var url = '';

        if(oldImage.value !== "0"){
            url = "Pages/PagesPHP/ProductsPHP/UploadImages.php?id="+ProductID+"&image="+imageName+"&oldimage="+oldImage.value;
        }
        else{
            url = "Pages/PagesPHP/ProductsPHP/UploadImages.php?id="+ProductID+"&image="+imageName+"&oldimage=";
        }

        $.ajax({
            type: "POST",
            url: url,
            contentType: false,
            cache: false,
            processData: false,
            data: form_data,
            success: function (data) {
                $('#content').load('Pages/Products.php');
                $('#imageMessage').html(data);
                $('#'+uploadButton).html('Change Image');
                $('#'+uploadButton).attr('disabled',true);
                $('#'+uploadButton).removeClass('btn-warning');
                $('#'+uploadButton).addClass('btn-info');
                $('#'+removeButton).css('visibility','visible');
                oldImage.value = 'Assets/'+imageName;
            },
            error: function (data) {
                $('#imageMessage').html(data);
            }
        });
    }

    function RemoveImageBtn(file,oldimage,uploadButton,removeButton,image,text){
        var fileInput = document.getElementById(file);
        oldImage = document.getElementById(oldimage);
        var imageInput = document.getElementById(image);
        var textInput = document.getElementById(text);
        var file_data = fileInput.files[0];
        var form_data = new FormData();
        form_data.append("file",file_data);

        var url = "Pages/PagesPHP/ProductsPHP/RemoveImages.php?id="+ProductID+"&image="+oldImage.value;

        $.ajax({
            type: "POST",
            url: url,
            success: function (data) {
                $('#content').load('Pages/Products.php');
                $('#imageMessage').html('<div class="container-fluid text-center"><span class="label label-warning">Image is removed successfully.</span></div>');
                $('#'+uploadButton).html('Upload Image');
                $('#'+uploadButton).attr('disabled',true);
                $('#'+uploadButton).removeClass('btn-warning');
                $('#'+uploadButton).addClass('btn-info');
                $('#'+removeButton).css('visibility','hidden');
                imageInput.style.display = "none";
                imageInput.src = '';
                textInput.style.visibility = "visible";
                oldImage.value = "0";
            },
            error: function (data) {
                $('#imageMessage').html(data);
            }
        });
    }

    function HandleFileChange(id,image,text,saveBtn) {

        var fileInput = document.getElementById(id);
        var imageInput = document.getElementById(image);
        var textInput = document.getElementById(text);
        var button = document.getElementById(saveBtn);

        $('#imageMessage').html('');
        var reader = new FileReader();
        reader.onload = function(){
            imageInput.src = reader.result;
            imageInput.style.display = "block";
            button.disabled = false;
            button.classList.remove('btn-info');
            button.classList.add('btn-warning');
        };
        reader.readAsDataURL(fileInput.files[0]);
        imageName = fileInput.files[0]['name'];
        textInput.style.visibility = "hidden";
    }

</script>