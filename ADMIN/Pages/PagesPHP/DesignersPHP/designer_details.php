<?php
session_start();
$PERSON_ID = $_SESSION['id'];

$DESIGNER_ID = $_GET['id'];
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
        <i class="icon-magic"></i>
        <em>Designers</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-zoom-in"></i>
        <em>Designer Details</em>
    </li>
</ul>
<div class="ajax-loader2">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<table class="table table-striped table-bordered designer-details-table">
    <tbody></tbody>
</table>
<table id="categoriesTable" class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
    <tr style="background-color: #0c5460;color:#F4F4F4;">
        <th>Image</th>
        <th>Collection</th>
        <th>Number of Products</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<button style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Designers.php')">Back</button>

<script>
    $(document).ready(function(){
        $('.ajax-loader2').css('visibility','visible');
        $.get('Pages/PagesPHP/DesignersPHP/GetDetails.php?id=<?php echo $DESIGNER_ID ?>',function(data) {
            var designer = $.parseJSON(data);
            var image;
            if(designer[0]['IMAGE'] !== null){
                image = '<tr><td colspan="2" style="text-align: left">' +
                    '<img id="imageThumb'+designer[0]['ID']+'" style="width:150px;height:150px;" class="img-polaroid compress-image" ' +
                    'src="'+designer[0]['IMAGE']+'"/></td></tr>';
            }
            else{
                image = '';
            }
            var status = '';
            if(designer[0]['IS_ACTIVE'].indexOf('1') >= 0){
                status = '<span class="label label-warning">ACTIVATED</span>';
            }
            else if(designer[0]['IS_ACTIVE'].indexOf('0') >= 0){
                status = '<span class="label label-info">DEACTIVATED</span>';
            }
            $('.designer-details-table tbody').html(
                image+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESIGNER</td><td>'+designer[0]['DESIGNER']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td>'+designer[0]['DESCRIPTION']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">NO. OF COLLECTIONS</td><td>'+(designer[0]['COLLECTIONS'] === "0" ? "No Collections" : designer[0]['COLLECTIONS'] +' Collections')+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">IS ACTIVE</td><td>'+status+'</td></tr>'
            );

            if(designer[0]['COLLECTIONS'] !== "0"){
                $.get('Pages/PagesPHP/CategoriesPHP/GetDesignerCategories.php?id='+designer[0]['ID'],function (data2) {
                    var categories;
                    if(data2 !== ''){
                        categories = $.parseJSON(data2);
                        $(categories).each(function (id,category) {
                            var image;
                            if(category['IMAGE'] !== null){
                                image = '<img id="imageThumb'+category['ID']+'" class="img-polaroid compress-image" src="'+category['IMAGE']+'"/>';
                            }
                            else{
                                image = '<img class="img-polaroid compress-image-none" src="Images/default-image.png"/>';
                            }
                            if(category['PRODUCTS'] > 0){
                                var status;
                                if(category['IS_ACTIVE'].indexOf('1') >= 0){
                                    status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';

                                }
                                else if(category['IS_ACTIVE'].indexOf('0') >= 0){
                                    status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';

                                }
                                $('#categoriesTable tbody').append('<tr>' +
                                    '<td class="center">'+image+'</td>' +
                                    '<td class="center">'+category['CATEGORY']+'</td>' +
                                    '<td class="center">'+category['PRODUCTS']+' Products</td>' +
                                    status +
                                    '</tr>');
                            }
                            else{
                                if(category['IS_ACTIVE'].indexOf('1') >= 0){
                                    status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';
                                }
                                else if(category['IS_ACTIVE'].indexOf('0') >= 0) {
                                    status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';
                                }
                                $('#categoriesTable tbody').append('<tr>' +
                                    '<td class="center">'+image+'</td>' +
                                    '<td class="center">'+category['CATEGORY']+'</td>' +
                                    '<td class="center">No Products</td>' +
                                    status +
                                    '</tr>');
                            }
                        });
                    }
                    else{
                        categories = [];
                    }
                });
            }
            else{
                $('#categoriesTable tbody').append(
                    '<tr><td colspan="4">No Records Found</td></tr>'
                );
            }
        }).success(function () {
            $('.ajax-loader2').css('visibility','hidden');
        });
    });
</script>