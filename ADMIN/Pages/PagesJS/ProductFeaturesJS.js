$(document).ready(function () {
    if(!CheckPrivilege('ADD_PRODUCT_FEATURE')){
        $('#addProductFeatureBtn').css('visibility','hidden');
    }

   $.get('Pages/PagesPHP/ProductFeaturesPHP/GetFeatures.php',function (data) {
       if(data !== ''){
           var features = $.parseJSON(data);
           $(features).each(function (id,feature) {
               $('#features').append('<label style="float: left; padding: 5px 20px; border-radius: 5px; margin-right: 20px;" class="label label-success">'+feature['FEATURE']+' ('+feature['DATA_TYPE']+')</label>');
           });
       }
       else{
           $('#features').append('<p>No features are available</p>');
       }
   });
});