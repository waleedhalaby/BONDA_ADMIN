<?php
$PRODUCT_ID = $_GET['id'];
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
        <i class="icon-edit"></i>
        <em>Edit Product</em>
    </li>
</ul>
<div class="modal-product-edit-content">
    <form id="editProductForm">
        <label>Product Details (MANDATORY)</label>
        <table class="table table-striped table-bordered product-details-table">
            <tbody></tbody>
        </table>
        <label>Product Features Details (OPTIONAL)</label>
        <table class="table table-striped table-bordered product-features-details-table">
            <tbody>

            </tbody>
        </table>
        <label>Product Images (OPTIONAL)</label>
        <div class="modal-product-det-content">
            <div id="imagesDiv" style="padding-top:10px; padding-bottom:10px; background-color: #f9f9f9" class="container-fluid text-center">
                <div id="Images" class="row-fluid">
                    <div class="col-md-12">
                    </div>
                </div>
                <div id="RemoveButtons" style="text-align: left;" class="removeButtons row-fluid">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
        <div id="message" class="container-fluid text-center"></div>
        <input type="reset" style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Products.php')" value="Back"/>
        <input type="submit" style="float: right" class="btn btn-warning" id="editProductBtn" value="Save Changes"/>
    </form>
</div>


<script>
    var ProductID = <?php echo $PRODUCT_ID ?>;
    var imageName = '';
    var oldImage = '';
    var counter = 0;
    var isChanged = false;


    $(document).ready(function(){

        var changes;
        var length = 0;
        $.get('Pages/PagesPHP/ProductsPHP/GetDetails.php?id=<?php echo $PRODUCT_ID ?>',function(data) {
            var product = $.parseJSON(data);
            var counter2 = 0;
            $('.product-details-table tbody').html(
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">ID</td><td>['+product[0]['ID']+']</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">SKU ID</td><td><input id="editSKUID" style="text-align: center" name="editSKUID" type="text" readonly value="'+product[0]['SKU_ID']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">NAME*</td><td><input id="editName" name="editName" type="text" value="'+product[0]['NAME']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">PRICE*</td><td><input id="editPrice" name="editPrice" type="number" step="0.01" value="'+product[0]['PRICE']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td><textarea id="editDescription" name="editDescription" class="cleditor">'+product[0]['DESCRIPTION']+'</textarea></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4">DESIGNER*</td><td colspan="2"><select id="editDesigner" name="editDesigner" data-rel="chosen" required></select></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4">COLLECTION*</td><td colspan="2"><select id="editCategory" name="editCategory" data-rel="chosen" required></select></td></tr>'
            );

            $.get('Pages/PagesPHP/DesignersPHP/GetDesigners.php',function (data) {
                if(data !== ''){
                    var array = $.parseJSON(data);
                    var id = array[0]['ID'];
                    $(array).each(function (id,val) {
                        var ID = val['ID'];
                        var DESIGNER = val['DESIGNER'];

                        $('#editDesigner').append(
                            '<option id="'+ID+'" value="'+ID+'">'+DESIGNER+'</option>'
                        );
                    });

                    var optionVal = product[0]['DESIGNER_ID'];
                    $("#editDesigner option#"+optionVal).attr('selected', true);

                    $.get('Pages/PagesPHP/CategoriesPHP/GetDesignerCategories.php?id='+optionVal,function (data) {
                        if(data !== ''){
                            var array = $.parseJSON(data);
                            $('#editCategory').html('');
                            $(array).each(function (id,val) {
                                var ID = val['ID'];
                                var CATEGORY = val['CATEGORY'];

                                $('#editCategory').append(
                                    '<option id="'+ID+'" value="'+ID+'">'+CATEGORY+'</option>'
                                );
                            });

                            var optionVal = product[0]['CATEGORY_ID'];
                            $("#editCategory option#"+optionVal).attr('selected', true);
                        }
                    });
                }
            });


            $('#editDesigner').on('change',function(){
                var id = $(this).val();
                $('#editCategory').html('');
                $.get('Pages/PagesPHP/CategoriesPHP/GetDesignerCategories.php?id='+id,function (data) {
                    if(data !== ''){
                        var array = $.parseJSON(data);
                        $(array).each(function (id,val) {
                            var ID = val['ID'];
                            var CATEGORY = val['CATEGORY'];

                            $('#editCategory').append(
                                '<option value="'+ID+'">'+CATEGORY+'</option>'
                            );
                        });
                    }
                });
            });

            $(product[0]['FEATURES']).each(function(id,feature){
                $('.product-features-details-table tbody').append(
                    '<tr><td style="background-color: #0c5460;color:#F4F4F4;">'+feature['FEATURE'].toUpperCase()+'</td><td>'+InputEditDataType(feature['ID'],feature['DATA_TYPE'],feature['FEATURE'],feature['VALUE'])+'</td></tr>'
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
                $('#RemoveButtons .col-md-12').append(
                    '<input type="button" style="margin-right:2px;" id="removeImage'+counter2+'" class="btn btn-small btn-danger"value="Remove Image"/>'
                );
                counter2++;
            });

            if(product[0]['IMAGES'].length !== 4){
                var count = 5 - product[0]['IMAGES'].length;
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

                    $('#RemoveButtons .col-md-12').append(
                        '<input type="button" id="removeImage'+counter2+'" style="margin:2px 2px;visibility: hidden" class="btn btn-small btn-danger"value="Remove Image"/>'
                    );

                    $('#imageBtn'+counter2).on('click',function(){
                        $('#fileupload'+counter2).click();
                        $('#imageBtn'+counter2).unbind('click')
                    });
                    counter2++;
                }
            }
            length = counter2;
        }).success(function(){

            $('.removeButtons input[type=button]').on('click',function(){
                var id = $(this).attr('id');
                id = id.substr(id.length - 1);
                RemoveImageBtn('fileupload'+id,'removeImage'+id,'image'+id,'text'+id);
            });

            $('.image-portrait input').on('change',function(){
                var id = $(this).attr('id');
                id = id.substr(id.length - 1);
                HandleFileChange('fileupload'+id,'image'+id,'text'+id,'removeImage'+id);
            });

            $('.product-features-details-table tbody input[type="checkbox"]').on('change',function(){
                if($(this).prop('checked') === true)
                    $(this).val('true');
                else
                    $(this).val('false');
                console.log(' to '+$(this).val());
            });

            $('#editProductForm').submit(function(e){
                e.preventDefault();

                $('#editProductBtn').attr('disabled','true');
                $('#editProductBtn').attr('value','Sending, please wait...');



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
                        if(!(data.indexOf('Error')>= 0)){
                            var url = "Pages/PagesPHP/ProductsPHP/UpdateImages.php?id="+data;
                            var form_data = new FormData();
                            var file_data1 = document.getElementById('fileupload0').files[0];
                            form_data.append("fileupload0",file_data1);
                            var file_data2 = document.getElementById('fileupload1').files[0];
                            form_data.append("fileupload1",file_data2);
                            var file_data3 = document.getElementById('fileupload2').files[0];
                            form_data.append("fileupload2",file_data3);
                            var file_data4 = document.getElementById('fileupload3').files[0];
                            form_data.append("fileupload3",file_data4);
                            var file_data5 = document.getElementById('fileupload4').files[0];
                            form_data.append("fileupload4",file_data5);
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function (data) {
                                    if(data.indexOf("successfully") >=0 || data === '' || isChanged){
                                        $('#content').load('Pages/Products.php');
                                        $('#message').html('');
                                        ShowMessageModal('Message','<div class="container-fluid text-center"><span class="label label-warning">Product is updated successfully</span></div>');
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
    });

    function RemoveImageBtn(file,removeButton,image,text){
        var fileInput = document.getElementById(file);
        var imageInput = document.getElementById(image);
        var textInput = document.getElementById(text);
        var image_name = imageInput.src.substring(imageInput.src.indexOf('Assets'));

        $.ajax({
            url:'Pages/PagesPHP/ProductsPHP/RemoveImages.php?id=<?php echo $PRODUCT_ID ?>&imagepath='+image_name,
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
        var image_name = imageInput.src.substring(imageInput.src.indexOf('Assets'));

        $.ajax({
            url:'Pages/PagesPHP/ProductsPHP/RemoveImages.php?id=<?php echo $PRODUCT_ID ?>&imagepath='+image_name,
            type:"POST",
            success:function(){
                textInput.style.visibility = "hidden";
                removeBtn.style.visibility = "visible";
            },
            error:function(){
                $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
            }
        });
    }

</script>