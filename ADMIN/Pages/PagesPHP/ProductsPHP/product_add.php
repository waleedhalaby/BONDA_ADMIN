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
        <i class="icon-gift"></i>
        <em>Products</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-plus-sign"></i>
        <em>Add Product</em>
    </li>
</ul>
<div class="modal-product-add-content">
    <form id="addProductForm">
        <label>Product Details (MANDATORY)</label>
        <table class="table table-striped table-bordered product-details-table">
            <tbody>
            <tr><td style="background-color: #0c5460;color:#F4F4F4">SKU ID</td><td colspan="2"><input name="addSKUID" id="addSKUID" type="text" readonly/></td></tr>
            <tr><td style="background-color: #0c5460;color:#F4F4F4">NAME*</td><td colspan="2"><input id="addName" name="addName" type="text" placeholder="Enter Name" required/></td></tr>
            <tr><td style="background-color: #0c5460;color:#F4F4F4">PRICE*</td><td colspan="2"><input id="addPrice" name="addPrice" type="number" placeholder="Enter Price" step="0.01" required/></td></tr>
            <tr><td style="background-color: #0c5460;color:#F4F4F4">CURRENCY*</td><td colspan="2"><select id="addCurrency" name="addCurrency" data-rel="chosen" required></select></td></tr>
            <tr><td style="background-color: #0c5460;color:#F4F4F4">DESCRIPTION</td><td colspan="2"><textarea id="addDescription" name="addDescription" class="cleditor" rows="3"></textarea></td></tr>
            <tr><td style="background-color: #0c5460;color:#F4F4F4">CATEGORY*</td><td colspan="2"><select id="addCategory" name="addCategory" data-rel="chosen" required></select></td></tr>
            </tbody>
        </table>
        <label>Product Features Details (OPTIONAL)</label>
        <table class="table table-striped table-bordered product-features-details-table">
            <tbody>
            </tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="submit" style="float: right" class="btn btn-warning" id="addProductBtn" value="Add Product"/>
    </form>
</div>
<div style="display: none" class="modal-product-det-content">
    <label>Product Images</label>
    <div id="imagesDiv" style="padding-top:10px; padding-bottom:10px; background-color: #f9f9f9" class="container-fluid text-center">
        <div class="row-fluid">
            <div class="col-md-12">
                <a id="imageBtn1" onclick="HandleFileClick('fileupload1')">
                    <div class="image-portrait">
                        <input type="file" id="fileupload1" style="display:none" onchange="HandleFileChange('fileupload1','image1','text1','uploadImage1')"/>
                        <img id="image1" class="image-thumb" style="display:none"/>
                        <input type="hidden" id="oldImage1" value="0"/>
                        <p id="text1"><span class="icon-plus"></span><br/>Click here to upload</p>
                    </div>
                </a>
                <a id="imageBtn2" onclick="HandleFileClick('fileupload2')">
                    <div class="image-portrait">
                        <input type="file" id="fileupload2" style="display:none" onchange="HandleFileChange('fileupload2','image2','text2','uploadImage2')"/>
                        <img id="image2" class="image-thumb" style="display:none"/>
                        <input type="hidden" id="oldImage2" value="0"/>
                        <p id="text2"><span class="icon-plus"></span><br/>Click here to upload</p>
                    </div>
                </a>
                <a id="imageBtn3" onclick="HandleFileClick('fileupload3')">
                    <div class="image-portrait">
                        <input type="file" id="fileupload3" style="display:none" onchange="HandleFileChange('fileupload3','image3','text3','uploadImage3')"/>
                        <img id="image3" class="image-thumb" style="display:none"/>
                        <input type="hidden" id="oldImage3" value="0"/>
                        <p id="text3"><span class="icon-plus"></span><br/>Click here to upload</p>
                    </div>
                </a>
                <a id="imageBtn4" onclick="HandleFileClick('fileupload4')">
                    <div class="image-portrait">
                        <input type="file" id="fileupload4" style="display:none" onchange="HandleFileChange('fileupload4','image4','text4','uploadImage4')"/>
                        <img id="image4" class="image-thumb" style="display:none"/>
                        <input type="hidden" id="oldImage4" value="0"/>
                        <p id="text4"><span class="icon-plus"></span><br/>Click here to upload</p>
                    </div>
                </a>
            </div>
        </div>
        <div style="text-align: left" class="row-fluid">
            <div class="col-md-12">
                <button id="uploadImage1" class="btn btn-small btn-info" disabled onclick="SaveImageBtn('fileupload1','oldImage1','uploadImage1','removeImage1')">Upload Image</button>
                <button id="uploadImage2" class="btn btn-small btn-info" disabled onclick="SaveImageBtn('fileupload2','oldImage2','uploadImage2','removeImage2')">Upload Image</button>
                <button id="uploadImage3" class="btn btn-small btn-info" disabled onclick="SaveImageBtn('fileupload3','oldImage3','uploadImage3','removeImage3')">Upload Image</button>
                <button id="uploadImage4" class="btn btn-small btn-info" disabled onclick="SaveImageBtn('fileupload4','oldImage4','uploadImage4','removeImage4')">Upload Image</button>
            </div>
        </div>
        <div style="text-align: left" class="row-fluid">
            <div class="col-md-12">
                <button id="removeImage1" style="visibility: hidden" class="btn btn-small btn-danger" onclick="RemoveImageBtn('fileupload1','oldImage1','uploadImage1','removeImage1','image1','text1')">Remove Image</button>
                <button id="removeImage2" style="visibility: hidden" class="btn btn-small btn-danger" onclick="RemoveImageBtn('fileupload2','oldImage2','uploadImage2','removeImage2','image2','text2')">Remove Image</button>
                <button id="removeImage3" style="visibility: hidden" class="btn btn-small btn-danger" onclick="RemoveImageBtn('fileupload3','oldImage3','uploadImage3','removeImage3','image3','text3')">Remove Image</button>
                <button id="removeImage4" style="visibility: hidden" class="btn btn-small btn-danger" onclick="RemoveImageBtn('fileupload4','oldImage4','uploadImage4','removeImage4','image4','text4')">Remove Image</button>
            </div>
        </div>
    </div>
    <p id="imageMessage"></p>
</div>


<script>
    var imageName = '';
    var ProductID = '';
    var counter = 0;
    var ids = '';

    function HandleFileClick(id) {
        var fileInput = document.getElementById(id);
        fileInput.click();
    }

    $.get('Pages/PagesPHP/ProductFeaturesPHP/GetProductFeatures.php',function(data){
        if(data !== ''){
            var features = $.parseJSON(data);
            $(features).each(function(id,feature){
                $('.product-features-details-table tbody').append(
                    '<tr>'+
                    '<td style="background-color: #0c5460;color:#F4F4F4">'+feature['FEATURE'].toUpperCase()+'</td>'+
                    '<td>'+InputDataType(counter,feature['DATA_TYPE'],feature['FEATURE'])+'</td></tr>');
                counter++;
                ids+= feature['ID'] + '$';
            });
        }
    });

    function HandleFileChange(id,image,text,saveBtn) {

        var fileInput = document.getElementById(id);
        var imageInput = document.getElementById(image);
        var textInput = document.getElementById(text);
        var button = document.getElementById(saveBtn);

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

    $(document).ready(function(){
        $('#addSKUID').val('#'+randomString(8, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'));

        $.get('Pages/PagesPHP/CategoriesPHP/GetProductCategories.php',function (data) {
            if(data !== ''){
                var array = $.parseJSON(data);
                $(array).each(function (id,val) {
                    var ID = val[0];
                    var CATEGORY = val[1];

                    $('#addCategory').append(
                        '<option value="'+ID+'">'+CATEGORY+'</option>'
                    );
                });
            }
        });

        $.get('Pages/PagesPHP/GetCurrencies.php',function (data) {
            if(data !== ''){
                var array = $.parseJSON(data);
                $(array).each(function (id,val) {
                    var ID = val[0];
                    var CURRENCY = val[1];

                    $('#addCurrency').append(
                        '<option value="'+ID+'">'+CURRENCY+'</option>'
                    );
                });
            }
        });

        $('#addProductForm').submit(function(e){
            e.preventDefault();

            $('.product-details-table tbody input[type=checkbox]').on('change',function(){
                if($(this).val() === 'on')
                    $(this).value = 'true';
                else
                    $(this).value = 'false';
            });

            var values = '';
            for(var i = 0 ; i < counter ; i++){
                values += $('#value'+i).val()+'$';
            }

            var url = "Pages/PagesPHP/ProductsPHP/AddProduct.php?maker=<?php echo $PERSON_ID ?>&ids="+ids+"&values="+values;


            $.ajax({
                type: "POST",
                url: url,
                data: $('#addProductForm').serialize(),
                success: function (data) {
                    if(data !== '') {
                        $('#content').load('Pages/Products.php');
                        $('#message').html('');
                        $('.modal-product-add-content').html('<div class="container-fluid text-center"><span class="label label-warning">Product is added successfully.</span></div>');
                        $('.modal-product-det-content').css('display','block');
                        $('#file').prop('disabled', false);
                        $('#uploadImageBtn').prop('disabled', false);
                        ProductID = data;
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-product-add-content').html('Error occurred, please contact your administrator.');
                }
            });
        });
    });
</script>