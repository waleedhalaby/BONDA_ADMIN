<?php
session_start();
$PERSON_ID = $_SESSION['id'];

$CATEGORY_ID = $_GET['id'];
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
        <i class="icon-tasks"></i>
        <em>Categories</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-zoom-in"></i>
        <em>Collection Details</em>
    </li>
</ul>
<div class="ajax-loader2">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<table class="table table-striped table-bordered category-details-table">
    <tbody></tbody>
</table>
<table id="productsTable" class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
    <tr style="background-color: #0c5460;color:#F4F4F4;">
        <th>IMAGE</th>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<button style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Categories.php')">Back</button>

<script>
    $(document).ready(function(){
        $('.ajax-loader2').css('visibility','visible');
        $.get('Pages/PagesPHP/CategoriesPHP/GetDetails.php?id=<?php echo $CATEGORY_ID ?>',function(data) {
            var category = $.parseJSON(data);
            var image;
            if(category[0]['IMAGE'] !== null){
                image = '<tr><td colspan="2" style="text-align: left">' +
                    '<img id="imageThumb'+category[0]['ID']+'" style="width:150px;height:150px;" class="img-polaroid compress-image" ' +
                    'src="'+category[0]['IMAGE']+'"/></td></tr>';
            }
            else{
                image = '';
            }
            var status = '';
            if(category[0]['IS_ACTIVE'].indexOf('1') >= 0){
                status = '<span class="label label-warning">ACTIVATED</span>';
            }
            else if(category[0]['IS_ACTIVE'].indexOf('0') >= 0){
                status = '<span class="label label-info">DEACTIVATED</span>';
            }
            $('.category-details-table tbody').html(
                image+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">COLLECTION</td><td>'+category[0]['CATEGORY']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td>'+category[0]['DESCRIPTION']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESIGNER</td><td>'+category[0]['DESIGNER']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">NO. OF PRODUCTS</td><td>'+(category[0]['PRODUCTS'] === "0" ? "No Products" : category[0]['PRODUCTS'] +' Products')+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">IS ACTIVE</td><td>'+status+'</td></tr>'
            );

            if(category[0]['PRODUCTS'] !== "0"){
                $.get('Pages/PagesPHP/ProductsPHP/GetCategoryProducts.php?id='+category[0]['ID'],function (data) {
                    var products;
                    if(data !== '') {
                        products = $.parseJSON(data);
                        var image = '';
                        $(products).each(function (id, product) {
                            if(product['IMAGES'].length > 0){
                                image = '<img id="imageThumb'+product['ID']+'" class="img-polaroid compress-image" src="'+product['IMAGES'][0]['IMAGE']+'"/>';
                            }
                            else{
                                image = '<img class="img-polaroid compress-image-none" src="Images/default-image.png"/>';
                            }

                            $('#productsTable tbody').append('<tr>' +
                                '<td>' + image + '</td>' +
                                '<td>' + product['ID'] + '</td>' +
                                '<td>' + product['NAME'] + '</td>' +
                                '<td>' + product['PRICE'] + ' ' + product['CURRENCY'] +'</td>' +
                                '</td></tr>'
                            );
                        });

                    }
                    else{
                        products = [];
                    }
                });
            }
            else{
                $('#productsTable tbody').append(
                    '<tr><td colspan="4">No Records Found</td></tr>'
                );
            }

        }).success(function () {
            $('.ajax-loader2').css('visibility','hidden');
        });
    });
</script>