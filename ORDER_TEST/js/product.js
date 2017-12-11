$(document).ready(function(){
    var productID = $('#productID').val();
    $.get('PagesPHP/GetProduct.php?id='+productID,function(data){
        var product = $.parseJSON(data);
        var image = '';
        if(product['IMAGES'].length > 0){
            image = '<img id="mainImage" style="width: 300px;border: 5px solid #ccc;border-radius: 5px;" class="img img-responsive" src="/BONDA_ADMIN/ADMIN/'+product['IMAGES'][0]['IMAGE_PATH']+'"/>';
        }
        else{
            image = '<img style="width: 300px;border: 5px solid #ccc;border-radius: 5px;" class="img img-responsive" src="/BONDA_ADMIN/ADMIN/Images/default-image.png"/>'
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
                        '<img id="img'+product['IMAGES'][i]['ID']+'" onclick="ShowImage(\'img'+product['IMAGES'][i]['ID']+'\')" style="cursor: pointer;width: 50px;float: left;border: 2px solid #888;border-radius: 5px" class="img img-responsive" src="/BONDA_ADMIN/ADMIN/'+product['IMAGES'][i]['IMAGE_PATH']+'"/>'+
                    '</div>'+
                '</div>'
            );
        }
        $('#main_container .row#mainRow').append(
                '</div>' +
                '<div id="maindetails" class="col-md-5">'+
                    '<div id="details" style="border: 4px solid #CCC;border-radius: 5px;padding: 10px;">' +
                    '<label style="padding:2px 10px;border-radius: 5px;color:white;" class="bg-danger">'+product['CATEGORY']+'</label><br/>'+
                    '<em style="color:#0b2e13;">'+product['SKU_ID']+'</em>'+
                    '<h3>'+product['NAME']+'</h3>'+
                    '<p style="border-radius: 5px;color:#1C2B36;">'+product['DESCRIPTION']+'</p>'

                    );
        if(product['FEATURES'].length > 0){
            $('#main_container .row#mainRow .col-md-5 #details').append(
                    '<table class="table table-bordered table-striped">'
            );
            $(product['FEATURES']).each(function(id,feature){
                $('#main_container .row#mainRow .col-md-5 #details table').append(
                        '<tr><td>'+feature['FEATURE']+'</td><td>'+feature['VALUE']+'</td></tr>'
                );
            });
        }
        $('#main_container .row#mainRow .col-md-5 #details').append(
            '<p style="font-weight: 700;font-size: large;width: 100%;text-align: right;color:#2d6987;"><i>'+product['PRICE']+ ' ' +product['CURRENCY']+'</i></p>'+
            '</div>'
        );
        $('#main_container .row#mainRow .col-md-5#maindetails').append(
            '<br/><br/><a style="color:white;" class="btn btn-block btn-success" onclick="AddToCart('+product['ID']+')">Add To Cart</a>'
        );
        $('#main_container .row#mainRow').append(
                '</div>'+
                '<div style="border-left: 1px solid #222222" class="col-md-3">'+
                    ''+
                '</div>'+
            '</div>'
        );
    });
});

function ShowImage(id){
    var image = $('#'+id).attr('src');
    $('#'+id).attr('src',$('#mainImage').attr('src'));
    $('#mainImage').attr('src',image);
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