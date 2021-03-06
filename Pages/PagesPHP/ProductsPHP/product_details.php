<?php
    $PRODUCT_ID = $_GET['id'];
?>
 <table class="table table-striped table-bordered product-details-table">
        <tbody></tbody>
 </table>

<script>
    $(document).ready(function(){

        $.get('Pages/PagesPHP/ProductsPHP/GetDetails.php?id=<?php echo $PRODUCT_ID ?>',function(data){
            var product = $.parseJSON(data);
            var image;

            if(product[0]['IMAGES'].length > 0){
                $('.product-details-table tbody').append('<tr><td colspan="2">');
                var counter = 1;
                $(product[0]['IMAGES']).each(function(id,image){
                    $('.product-details-table tbody tr td').append(
                    '<img id="imageThumb_'+counter+'_'+product[0]['ID']+'" class="img-polaroid compress-image" src="'+image['IMAGE_PATH']+'"/>' +
                    '<img id="imageBig_'+counter+'_'+product[0]['ID']+'" class="img-polaroid image-see" src="'+image['IMAGE_PATH']+'"/>'
                    );
                    $('product-details-table tbody #imageThumb_'+counter+'_'+product[0]['ID']).hover(function(){
                        $('product-details-table tbody #imageBig_'+counter+'_'+product[0]['ID']).fadeIn().show();
                    },function(){
                        $('product-details-table tbody #imageBig_'+counter+'_'+product[0]['ID']).hide();
                    });
                    counter++;
                });
                $('.product-details-table tbody').append('</td></tr>');


            }
            $('.product-details-table tbody').append(
                '<tr><td>ID</td><td>['+product[0]['ID']+']</td></tr>'+
                '<tr><td>SKU_ID</td><td>'+product[0]['SKU_ID']+'</td></tr>'+
                '<tr><td>NAME</td><td>'+product[0]['NAME']+'</td></tr>'+
                '<tr><td>PRICE</td><td>'+parseFloat(product[0]['PRICE']).toFixed(2)+' '+product[0]['CURRENCY']+'</td></tr>'+
                '<tr><td>DESCRIPTION</td><td>'+product[0]['DESCRIPTION'].substring(0,100)+'</td></tr>'+
                '<tr><td>CATEGORY</td><td><span class="label label-warning">'+product[0]['CATEGORY']+'</span></td></tr>'
             );
            if(product[0]['FEATURES'].length > 0){
                $(product[0]['FEATURES']).each(function(id,feature){
                    $('.product-details-table tbody').append(
                        '<tr><td>'+feature['FEATURE'].toUpperCase()+'</td><td>'+feature['VALUE']+'</td></tr>'
                    );
                });
            }
        });
    });
</script>