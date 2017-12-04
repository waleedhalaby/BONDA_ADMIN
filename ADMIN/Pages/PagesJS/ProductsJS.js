$(document).ready(function () {
    $('#productTable').html('');

    var products = [];
    $('.ajax-loader').css('visibility','visible');
    $.get('Pages/PagesPHP/ProductsPHP/GetProducts.php',function (data) {
        if(data !== '') {
            products = $.parseJSON(data);
            var image = '';
            $(products).each(function (id, product) {
                if(product['IMAGES'].length > 0){
                    image = '<img id="imageThumb'+product['ID']+'" class="img-polaroid compress-image" src="'+product['IMAGES'][0]['IMAGE']+'"/>' +
                            '<img id="imageBig'+product['ID']+'" class="img-polaroid image-see" src="'+product['IMAGES'][0]['IMAGE']+'"/>';
                }
                else{
                    image = '<img class="img-polaroid compress-image-none" src="Images/default-image.png"/>';
                }

                $('#productTable').append('<tr>' +
                    '<td>' + image + '</td>' +
                    '<td>' + product['ID'] + '</td>' +
                    '<td>' + product['SKU_ID'] + '</td>' +
                    '<td>' + product['NAME'] + '</td>' +
                    '<td>' + product['PRICE'] + ' ' + product['CURRENCY'] +'</td>' +
                    '<td><label class="label label-warning">' + product['CATEGORY'] + '</label></td>'+
                    '<td class="center">' +
                    '<a id="detailProductBtn" class="btn btn-success" ' +
                    'onclick="ShowModal(\'Product [#'+product['ID']+'] Details\',\'Close\',\'Pages/PagesPHP/ProductsPHP/product_details.php?id='+product['ID']+'\',false)">' +
                    '<i class="halflings-icon white zoom-in"></i></a>'+
                    '<a id="editProductBtn" class="editProduct btn btn-info" ' +
                    'onclick="ShowModal(\'Product [#'+product['ID']+'] Edit\',\'Close\',\'Pages/PagesPHP/ProductsPHP/product_edit.php?id='+product['ID']+'\',true)">' +
                    '<i class="halflings-icon white edit"></i></a>'+
                    '<a id="deleteProductBtn" class="deleteProduct btn btn-danger" ' +
                    'onclick="ShowModal(\'Product [#'+product['ID']+'] Delete\',\'Close\',\'Pages/PagesPHP/ProductsPHP/product_delete.php?id='+product['ID']+'\',false)">' +
                    '<i class="halflings-icon white trash"></i></a>'+
                    '</td></tr>'
                );
                $("img#imageThumb"+product['ID']).hover(function(){
                    $('#imageBig'+product['ID']).fadeIn().show();
                },function(){
                    $('#imageBig'+product['ID']).hide();
                });
            });
            if(!CheckPrivilege('ADD_PRODUCT')){
                $('#addProductBtn').css('visibility','hidden');
            }

            if(!CheckPrivilege('EDIT_PRODUCT')){
                $('.editProduct').css('visibility','hidden');
            }

            if(!CheckPrivilege('DELETE_PRODUCT')){
                $('.deleteProduct').css('visibility','hidden');
            }
        }
        else{
            products = [];
        }
        $('.datatable').DataTable();
    }).success(function () {
        $('.ajax-loader').css('visibility','hidden');
    });
});