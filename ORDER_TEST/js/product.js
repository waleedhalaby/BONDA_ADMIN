$(document).ready(function(){
    var productID = $('#productID').val();
    $.get('PagesPHP/GetProduct.php?id='+productID,function(data){
        var product = $.parseJSON(data);
        var image = '';
        if(product['IMAGES'].length > 0){
            image = '<img style="width: 300px" class="img img-responsive" src="/BONDA_ADMIN/ADMIN/'+product['IMAGES'][0]['IMAGE_PATH']+'"/>';
        }
        else{
            image = '<img style="width: 300px" class="img img-responsive" src="/BONDA_ADMIN/ADMIN/Images/default-image.png"/>'
        }
        $('#main_container').append(
            '<div id="mainRow" class="row">' +
                '<div class="col-md-4">'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            image+
                    '</div>'+
                '</div>'
        );
        for(var i = 1 ; i < product['IMAGES'].length; i++){
            $('#main_container .row#mainRow .col-md-4').append(
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<img style="width: 50px;float: left;" class="img img-responsive" src="/BONDA_ADMIN/ADMIN/'+product['IMAGES'][i]['IMAGE_PATH']+'"/>'+
                    '</div>'+
                '</div>'
            );
        }
        $('#main_container .row#mainRow').append(
                '</div>' +
                '<div id="details" class="col-md-4">'+
                    '<label class="label label-warning">'+product['CATEGORY']+'</label>'+
                    '<h3>'+product['NAME']+'</h3>'+
                    '<em>'+product['SKU_ID']+'</em>'+
                    '<p>'+product['DESCRIPTION']+'</p>'+
                    '<p style="float: right" class="label label-success"><i>'+product['PRICE']+ ' ' +product['CURRENCY']+'</i></p>');
        if(product['FEATURES'].length > 0){
            $('#main_container .row#mainRow .col-md-4#details').append(
                    '<table class="table table-bordered table-striped">'
            );
            $(product['FEATURES']).each(function(id,feature){
                $('#main_container .row#mainRow .col-md-4#details table').append(
                        '<tr><td>'+feature['FEATURE']+'</td><td>'+feature['VALUE']+'</td></tr>'
                );
            });
            $('#main_container .row#mainRow').append(
                    '</table>'
            );
        }
        $('#main_container .row#mainRow').append(
                '</div>'+
                '<div class="col-md-4">'+
                    '<a class="btn btn-block btn-success" onclick="AddToCart('+product['ID']+')">Add To Cart</a>'+
                '</div>'+
            '</div>'
        );
    });
});

function AddToCart(id){
    var url = 'PagesPHP/AddToCart.php?id='+id;
    $.ajax({
        type: "POST",
        url: url,
        data: null,
        success: function (data) {
            console.log(data);
            if(data === "1") {
                alert('Product ' + id + ' is added to cart.');
                location.reload(true);
            }
            else{
                alert('Error occurred, please contact your administrator.');
            }
        },
        error: function(data){
            $('.modal-product-add-content').html('Error occurred, please contact your administrator.');
        }
    });
}