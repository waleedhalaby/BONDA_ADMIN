$(document).ready(function () {
    if(!CheckPrivilege('SHOW_PRODUCTS_FEATURES')){
        $('#content #features').html('Sorry, you don\'t have the privilege to view product features.');
        $('#addProductFeatureBtn').css('visibility','hidden');
    }
    else{
        if(!CheckPrivilege('ADD_PRODUCT_FEATURE')){
            $('#addProductFeatureBtn').css('visibility','hidden');
        }


        $.get('Pages/PagesPHP/ProductFeaturesPHP/GetFeatures.php',function (data) {
            if(data !== ''){
                var features = $.parseJSON(data);
                $(features).each(function (id,feature) {
                    if(feature['IS_ACTIVE'] === "1"){
                        $('#features').append('<label onclick="ToggleActive('+feature['ID']+','+feature['IS_ACTIVE']+')" style="float: left; padding: 5px 20px; border-radius: 5px; margin-right: 20px;" class="label label-success">'+feature['FEATURE']+' ('+feature['DATA_TYPE']+') <span class="icon-check"></span></label>');
                    }
                    else{
                        $('#features').append('<label onclick="ToggleActive('+feature['ID']+','+feature['IS_ACTIVE']+')" style="float: left; padding: 5px 20px; border-radius: 5px; margin-right: 20px;" class="label label-info">'+feature['FEATURE']+' ('+feature['DATA_TYPE']+') <span class="icon-check-empty"></span></label>');
                    }
                    if(!CheckPrivilege('UPDATE_PRODUCT_FEATURES')){
                        $('#features label').unbind('click');
                    }
                });

            }
            else{
                $('#features').append('<p>No features are available</p>');
            }
        });
    }
});

function ToggleActive(id,oldStatus){
    var url = "Pages/PagesPHP/ProductFeaturesPHP/UpdateActive.php?id="+id+"&os="+oldStatus;
    $.ajax({
        type: 'POST',
        url: url,
        success: function (data) {
            $('#content').load('Pages/ProductFeatures.php');
        }
    });
}