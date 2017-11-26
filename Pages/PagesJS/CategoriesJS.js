$(document).ready(function () {
    if(!CheckPrivilege('ADD_CATEGORY')){
        $('#addCategoryBtn').css('visibility','hidden');
    }

    if(!CheckPrivilege('UPDATE_CATEGORY')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to update categories.');
    }

   $.get('Pages/PagesPHP/CategoriesPHP/GetCategories.php',function (data) {
       if(data !== ''){
           var categories = $.parseJSON(data);
           $(categories).each(function (id,category) {
               if(category['PRODUCTS'] > 0){
                   var status,icon;
                   if(category['IS_ACTIVE'].indexOf('1') >= 0){
                       status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';
                       icon = '<a id="updateCategoryBtn" class="btn btn-info" ' +
                           'onclick="ShowModal(\'Category '+category['CATEGORY']+' Deactivate\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_update.php?id='+category['ID']+'&status=false\')">' +
                           '<i class="icon-eye-close"></i></a>';
                   }
                   else if(category['IS_ACTIVE'].indexOf('0') >= 0){
                       status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';
                       icon = '<a id="updateCategoryBtn" class="btn btn-warning" ' +
                           'onclick="ShowModal(\'Category '+category['CATEGORY']+' Activate\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_update.php?id='+category['ID']+'&status=true\')">' +
                           '<i class="icon-eye-open"></i></a>';
                   }
                   $('#categoryTable').append('<tr>' +
                       '<td class="center">'+category['CATEGORY']+'</td>' +
                       '<td class="center">'+category['PRODUCTS']+' Products</td>' +
                       status +
                       '<td class="center">' +
                       icon +
                       '</td>' +
                       '</tr>');
               }
               else{
                   if(category['IS_ACTIVE'].indexOf('1') >= 0){
                       status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';
                       icon = '<a id="updateCategoryBtn" class="btn btn-info" ' +
                           'onclick="ShowModal(\'Category '+category['CATEGORY']+' Deactivate\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_update.php?id='+category['ID']+'&status=false\')">' +
                           '<i class="icon-eye-close"></i></a>';
                   }
                   else if(val[2].indexOf('0') >= 0){
                       status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';
                       icon = '<a id="updateCategoryBtn" class="btn btn-warning" ' +
                           'onclick="ShowModal(\'Category '+category['CATEGORY']+' Activate\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_update.php?id='+category['ID']+'&status=true\')">' +
                           '<i class="icon-eye-open"></i></a>';
                   }
                   $('#categoryTable').append('<tr>' +
                       '<td class="center">'+category['CATEGORY']+'</td>' +
                       '<td class="center">No Products</td>' +
                       status +
                       '<td class="center">' +
                       icon +
                       '</td>' +
                       '</tr>');
               }
           });
           $('.datatable').DataTable();
       }
   });
});