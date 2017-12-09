$(document).ready(function () {
    if(!CheckPrivilege('SHOW_CATEGORIES')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to view collections.');
        $('#addCategoryBtn').css('visibility','hidden');
    }
    else{
        $('.ajax-loader').css('visibility','visible');
        if(!CheckPrivilege('ADD_CATEGORY')){
            $('#addCategoryBtn').css('visibility','hidden');
        }


        $('#categoryTable').html('');
        var categories = [];

        $.get('Pages/PagesPHP/CategoriesPHP/GetCategories.php',function (data) {
            if(data !== ''){
                categories = $.parseJSON(data);
                $(categories).each(function (id,category) {
                    if(category['PRODUCTS'] > 0){
                        var status,icon;
                        if(category['IS_ACTIVE'].indexOf('1') >= 0){
                            status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';
                            icon = '<a id="updateCategoryBtn" class="btn btn-success" ' +
                                'onclick="ShowModal(\'Collection '+category['CATEGORY']+' Deactivate\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_update.php?id='+category['ID']+'&status=false\',false)">' +
                                '<i class="halflings-icon white eye-close"></i></a>';
                        }
                        else if(category['IS_ACTIVE'].indexOf('0') >= 0){
                            status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';
                            icon = '<a id="updateCategoryBtn" class="btn btn-warning" ' +
                                'onclick="ShowModal(\'Collection '+category['CATEGORY']+' Activate\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_update.php?id='+category['ID']+'&status=true\',false)">' +
                                '<i class="halflings-icon white eye-open"></i></a>';
                        }
                        $('#categoryTable').append('<tr>' +
                            '<td class="center">'+category['CATEGORY']+'</td>' +
                            '<td class="center">'+category['PRODUCTS']+' Products</td>' +
                            status +
                            '<td class="center">' +
                            icon +
                            '<a id="editCategoryBtn" class="editCategory btn btn-info" ' +
                            'onclick="$(\'#content\').load(\'Pages/PagesPHP/CategoriesPHP/category_edit.php?value='+category['CATEGORY'].replace(' ','_')+'&id='+category['ID']+'\')">' +
                            '<i class="halflings-icon white edit"></i></a>'+
                            '<a id="deleteCategoryBtn" class="deleteCategory btn btn-danger" ' +
                            'onclick="ShowModal(\'Collection ['+category['CATEGORY']+'] Delete\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_delete.php?val='+category['CATEGORY'].replace(' ','_')+'&id='+category['ID']+'\',false)">' +
                            '<i class="halflings-icon white trash"></i></a>'+
                            '</td>' +
                            '</tr>');
                    }
                    else{
                        if(category['IS_ACTIVE'].indexOf('1') >= 0){
                            status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';
                            icon = '<a id="updateCategoryBtn" class="btn btn-success" ' +
                                'onclick="ShowModal(\'Collection '+category['CATEGORY']+' Deactivate\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_update.php?id='+category['ID']+'&status=false\',false)">' +
                                '<i class="halflings-icon white eye-close"></i></a>';
                        }
                        else if(category['IS_ACTIVE'].indexOf('0') >= 0){
                            status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';
                            icon = '<a id="updateCategoryBtn" class="updateCategory btn btn-warning" ' +
                                'onclick="ShowModal(\'Collection '+category['CATEGORY']+' Activate\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_update.php?id='+category['ID']+'&status=true\',false)">' +
                                '<i class="halflings-icon white eye-open"></i></a>';
                        }
                        $('#categoryTable').append('<tr>' +
                            '<td class="center">'+category['CATEGORY']+'</td>' +
                            '<td class="center">No Products</td>' +
                            status +
                            '<td class="center">' +
                            icon +
                            '<a id="editCategoryBtn" class="editCategory btn btn-info" ' +
                            'onclick="$(\'#content\').load(\'Pages/PagesPHP/CategoriesPHP/category_edit.php?value='+category['CATEGORY'].replace(' ','_')+'&id='+category['ID']+'\')">' +
                            '<i class="halflings-icon white edit"></i></a>'+
                            '<a id="deleteCategoryBtn" class="deleteCategory btn btn-danger" ' +
                            'onclick="ShowModal(\'Collection ['+category['CATEGORY']+'] Delete\',\'Close\',\'Pages/PagesPHP/CategoriesPHP/category_delete.php?val='+category['CATEGORY'].replace(' ','_')+'&id='+category['ID']+'\',false)">' +
                            '<i class="halflings-icon white trash"></i></a>'+
                            '</td>' +
                            '</tr>');
                    }
                    if(!CheckPrivilege('DELETE_CATEGORY')){
                        $('.deleteCategory').css('visibility','hidden');
                    }
                    if(!CheckPrivilege('EDIT_CATEGORY')){
                        $('.editCategory').css('visibility','hidden');
                    }
                    if(!CheckPrivilege('UPDATE_CATEGORY')){
                        $('.updateCategory').css('visibility','hidden');
                    }
                });

            }
            else{
                categories = [];
            }
            $('.datatable').DataTable();
        }).success(function () {
            $('.ajax-loader').css('visibility','hidden');
        });
    }


});