$(document).ready(function(){
    var productID = $('#productID').val();
    $.get('PagesPHP/GetProduct.php?id='+productID,function(data){
        var product = $.parseJSON(data);
        $('#main_container').append(
            '<div id="mainRow" class="row">' +
                '<div class="col-md-4">'+
                    '<div class="row">'+
                        '<div class="col-md-12">'+
                            '<img style="width: 300px" class="img img-responsive" src="/BONDA_ADMIN/ADMIN/'+product['IMAGES'][0]['IMAGE_PATH']+'"/>'+
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
                    '<h3>'+product['NAME']+'</h3>'+
                    '<em>'+product['SKU_ID']+'</em><label class="label label-warning">'+product['CATEGORY']+'</label>'+
                    '<p class="label label-success">'+product['PRICE']+ ' ' +product['CURRENCY']+'</p>'+
                    '<p>'+product['DESCRIPTION']+'</p>');
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
                    '<a class="btn btn-block btn-success" href="AddToCart.php?id='+productID+'">Add To Cart</a>'+
                '</div>'+
            '</div>'
        );
    });
});