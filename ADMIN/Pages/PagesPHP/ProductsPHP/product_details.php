<?php
    $PRODUCT_ID = $_GET['id'];
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
        <i class="icon-zoom-in"></i>
        <em>Product Details</em>
    </li>
</ul>
<div class="ajax-loader2">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
 <table class="table table-striped table-bordered product-details-table">
        <tbody></tbody>
 </table>
<button style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Products.php')">Back</button>
<script>
    $(document).ready(function(){
        $('.ajax-loader2').css('visibility','visible');
        $.get('Pages/PagesPHP/ProductsPHP/GetDetails.php?id=<?php echo $PRODUCT_ID ?>',function(data){
            var product = $.parseJSON(data);
            var image;

            if(product[0]['IMAGES'].length > 0){
                $('.product-details-table tbody').append('<tr><td colspan="2" style="text-align: left">');
                var counter = 1;
                $(product[0]['IMAGES']).each(function(id,image){
                    $('.product-details-table tbody tr td').append(
                    '<img id="imageThumb_'+counter+'_'+product[0]['ID']+'" style="width:150px;height:150px;" class="img-polaroid compress-image" src="'+image['IMAGE_PATH']+'"/>');
                    counter++;
                });
                $('.product-details-table tbody').append('</td></tr>');


            }
            $('.product-details-table tbody').append(
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">ID</td><td>['+product[0]['ID']+']</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">SKU_ID</td><td>'+product[0]['SKU_ID']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">NAME</td><td>'+product[0]['NAME']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">PRICE</td><td>'+product[0]['PRICE'].toLocaleString()+' '+product[0]['CURRENCY']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td>'+product[0]['DESCRIPTION'].substring(0,100)+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">CATEGORY</td><td><span class="label label-warning">'+product[0]['CATEGORY']+'</span></td></tr>'
             );

            if(product[0]['DESIGNER'] !== null){
                $('.product-details-table tbody').append(
                    '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESIGNER</td><td>'+product[0]['DESIGNER']+'</td></tr>'
                );
            }

            if(product[0]['FEATURES'].length > 0){
                $(product[0]['FEATURES']).each(function(id,feature){
                    $('.product-details-table tbody').append(
                        '<tr><td style="background-color: #0c5460;color:#F4F4F4;">'+feature['FEATURE'].toUpperCase()+'</td><td>'+feature['VALUE']+'</td></tr>'
                    );
                });
            }
        }).success(function () {
            $('.ajax-loader2').css('visibility','hidden');
        });
    });
</script>