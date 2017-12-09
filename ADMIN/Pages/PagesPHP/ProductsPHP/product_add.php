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
            <tr><td style="background-color: #0c5460;color:#F4F4F4">COLLECTION*</td><td colspan="2"><select id="addCategory" name="addCategory" data-rel="chosen" required></select></td></tr>
            </tbody>
        </table>
        <label>Product Features Details (OPTIONAL)</label>
        <table class="table table-striped table-bordered product-features-details-table">
            <tbody>
            <tr><td style="background-color: #0c5460;color:#F4F4F4">DESIGNER</td><td colspan="2"><select id="addDesigner" name="addDesigner" data-rel="chosen"><option selected disabled value="-1">Select Designer</option></select></td></tr>
            </tbody>
        </table>
        <label>Product Images (OPTIONAL)</label>
        <table class="table table-striped table-bordered product-images-details-table">
            <tbody>
                <tr><td style="background-color: #0c5460;color:#F4F4F4">IMAGES</td>
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
                                <a id="imageBtn2" onclick="HandleFileClick('fileupload2')">
                                    <div class="image-portrait">
                                        <input type="file" name="fileupload2" accept="image/*" id="fileupload2" style="display:none"
                                               onchange="HandleFileChange('fileupload2','image2','text2','removeImage2')"/>
                                        <img id="image2" class="image-thumb" style="display:none"/>
                                        <p id="text2"><span class="icon-plus"></span><br/>Click here to upload</p>
                                    </div>
                                </a>
                                <a id="imageBtn3" onclick="HandleFileClick('fileupload3')">
                                    <div class="image-portrait">
                                        <input type="file" name="fileupload3" accept="image/*" id="fileupload3" style="display:none"
                                               onchange="HandleFileChange('fileupload3','image3','text3','removeImage3')"/>
                                        <img id="image3" class="image-thumb" style="display:none"/>
                                        <p id="text3"><span class="icon-plus"></span><br/>Click here to upload</p>
                                    </div>
                                </a>
                                <a id="imageBtn4" onclick="HandleFileClick('fileupload4')">
                                    <div class="image-portrait">
                                        <input type="file" name="fileupload4" accept="image/*" id="fileupload4" style="display:none"
                                               onchange="HandleFileChange('fileupload4','image4','text4','removeImage4')"/>
                                        <img id="image4" class="image-thumb" style="display:none"/>
                                        <p id="text4"><span class="icon-plus"></span><br/>Click here to upload</p>
                                    </div>
                                </a>
                                <a id="imageBtn5" onclick="HandleFileClick('fileupload5')">
                                    <div class="image-portrait">
                                        <input type="file" name="fileupload5" accept="image/*" id="fileupload5" style="display:none"
                                               onchange="HandleFileChange('fileupload5','image5','text5','removeImage5')"/>
                                        <img id="image5" class="image-thumb" style="display:none"/>
                                        <p id="text5"><span class="icon-plus"></span><br/>Click here to upload</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div style="text-align: left" class="row-fluid">
                            <div class="col-md-12">
                                <input type="button" id="removeImage1" style="visibility: hidden;" class="btn btn-small btn-danger" onclick="RemoveImageBtn('fileupload1','removeImage1','image1','text1')" value="Remove Image"/>
                                <input type="button" id="removeImage2" style="visibility: hidden;" class="btn btn-small btn-danger" onclick="RemoveImageBtn('fileupload2','removeImage2','image2','text2')" value="Remove Image"/>
                                <input type="button" id="removeImage3" style="visibility: hidden;" class="btn btn-small btn-danger" onclick="RemoveImageBtn('fileupload3','removeImage3','image3','text3')" value="Remove Image"/>
                                <input type="button" id="removeImage4" style="visibility: hidden;" class="btn btn-small btn-danger" onclick="RemoveImageBtn('fileupload4','removeImage4','image4','text4')" value="Remove Image"/>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="reset" style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Products.php')" value="Back"/>
        <input type="submit" style="float: right" class="btn btn-warning" id="addProductBtn" value="Add Product"/>
    </form>
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

        $.get('Pages/PagesPHP/DesignersPHP/GetDesigners.php',function (data) {
            if(data !== ''){
                var array = $.parseJSON(data);
                $(array).each(function (id,val) {
                    var ID = val['ID'];
                    var DESIGNER = val['NAME'];

                    $('#addDesigner').append(
                        '<option value="'+ID+'">'+DESIGNER+'</option>'
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

            $('#addProductBtn').attr('disabled','true');
            $('#addProductBtn').attr('value','Sending, please wait...');

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
                    if(!(data.indexOf('Error')>= 0)){
                        var url = "Pages/PagesPHP/ProductsPHP/UploadImages.php?id="+data;
                        var form_data = new FormData();
                        var file_data1 = document.getElementById('fileupload1').files[0];
                        form_data.append("fileupload1",file_data1);
                        var file_data2 = document.getElementById('fileupload2').files[0];
                        form_data.append("fileupload2",file_data2);
                        var file_data3 = document.getElementById('fileupload3').files[0];
                        form_data.append("fileupload3",file_data3);
                        var file_data4 = document.getElementById('fileupload4').files[0];
                        form_data.append("fileupload4",file_data4);
                        var file_data5 = document.getElementById('fileupload5').files[0];
                        form_data.append("fileupload5",file_data5);
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (data) {
                                if(data.indexOf("successfully") >=0 || data === ''){
                                    $('#content').load('Pages/Products.php');
                                    $('#message').html('');
                                    ShowMessageModal('Message','<div class="container-fluid text-center"><span class="label label-warning">Product is added successfully</span></div>');
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