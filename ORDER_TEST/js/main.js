$(document).ready(function(){
    $('#main_content').load('PagesPHP/Shop.php');

    $('#cartBtn').on('click',function(){
        $('#main_content').load('PagesPHP/Cart.php');
    });

    $('#contactBtn').on('click',function(){
        $('#main_content').load('PagesPHP/Contact.php');
    });

    $.get('PagesPHP/GetProducts.php',function(data){
        var products = $.parseJSON(data);
        var counter = 1;
        var counter2 = 1;
        $(products).each(function(id,product){
            var image = '';
            if(product['IMAGES'].length > 0){
                image = '<img class="card-img-top" style="width:318px;height: 180px" src="/BONDA_ADMIN/ADMIN/'+product['IMAGES'][0]['IMAGE']+'" alt="'+product['NAME']+'"/>';
            }
            else{
                image = '<img class="card-img-top" style="width:318px;height: 180px" src="/BONDA_ADMIN/ADMIN/Images/default-image.png" alt="'+product['NAME']+'"/>'
            }
            $('#main_container .row#'+counter2).append(
                '<div class="col-md-3">' +
                '<a onclick="ShowProduct('+product['ID']+')">'+
                '<div class="card" style="width: 20rem;">'+
                image+
                '<div style="min-height: 200px;padding: 10px;" class="card-block">'+
                '<h4 class="card-title">'+product['NAME']+'</h4><label style="font-size: small;font-weight: 600;color: #f0f0f0;border-radius: 5px;padding: 3px 10px;" class="label bg-danger">'+product['CATEGORY']+'</label>'+
                '<p class="card-text">'+product['DESCRIPTION'].substring(0,50)+'...'+'</p>'+
                '<a onclick="AddToCart('+product['ID']+')" style="color:white;position: absolute;bottom: 0;left: 0;"  class="btn btn-success">Add to cart</a>'+
                '<label style="position: absolute;bottom: 0;right: 0;" class="label label-info">'+product['PRICE']+' '+product['CURRENCY']+'</label>'+
                '</div>'+
                '</div>'+
                '</a>'+
                '</div>'
            );

            if(counter % 4 === 0){
                counter2++;
                $('#main_container').append('</div><div id="'+counter2+'" class="row">');
            }
            counter++;
        });
    });
});
function ShowProduct(id){
    $('#main_container').load('PagesPHP/Product.php?id='+id);
}

function AddToCart(id){
    var url = 'PagesPHP/AddToCart.php?id='+id;
    $.ajax({
        type: "POST",
        url: url,
        data: null,
        success: function (data) {
            if(data === "1") {
                location.reload(true);
                $('#message').html(
                    '<div class="alert alert-success">' +
                    '  <strong>Success!</strong> Product ' + id + ' is added to cart successfully.' +
                    '</div>');
            }
            else{
                $('#message').html(
                    '<div class="alert alert-danger">' +
                    '  <strong>Error!</strong> Error occurred, please contact your administrator.'+
                    '</div>');
            }
        },
        error: function(data){
            $('#message').html(
                '<div class="alert alert-danger">' +
                '  <strong>Error!</strong> Error occurred, please contact your administrator.'+
                '</div>');
        }
    });
}