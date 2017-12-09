$(document).ready(function () {
    if(!CheckPrivilege('SHOW_DESIGNERS')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to view designers.');
        $('#addDesignerBtn').css('visibility','hidden');
    }
    else{
        $('.ajax-loader').css('visibility','visible');
        if(!CheckPrivilege('ADD_DESIGNER')){
            $('#addDesignerBtn').css('visibility','hidden');
        }


        $('#designerTable').html('');
        var designers = [];

        $.get('Pages/PagesPHP/DesignersPHP/GetDesigners.php',function (data) {
            if(data !== ''){
                designers = $.parseJSON(data);
                $(designers).each(function (id,designer) {
                    if(designer['PRODUCTS'] > 0){
                        var status,icon;
                        if(designer['IS_ACTIVE'].indexOf('1') >= 0){
                            status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';
                            icon = '<a id="updateDesignerBtn" class="btn btn-success" ' +
                                'onclick="ShowModal(\'Designer '+designer['NAME']+' Deactivate\',\'Close\',\'Pages/PagesPHP/DesignersPHP/designer_update.php?id='+designer['ID']+'&status=false\',false)">' +
                                '<i class="halflings-icon white eye-close"></i></a>';
                        }
                        else if(designer['IS_ACTIVE'].indexOf('0') >= 0){
                            status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';
                            icon = '<a id="updateDesignerBtn" class="btn btn-warning" ' +
                                'onclick="ShowModal(\'Designer '+designer['NAME']+' Activate\',\'Close\',\'Pages/PagesPHP/DesignersPHP/designer_update.php?id='+designer['ID']+'&status=true\',false)">' +
                                '<i class="halflings-icon white eye-open"></i></a>';
                        }
                        var d = designer['DESCRIPTION'].replace(' ','_');
                        console.log("desc.:"+d);
                        $('#designerTable').append('<tr>' +
                            '<td class="center">'+designer['NAME']+'</td>' +
                            '<td class="center">'+designer['PRODUCTS']+' Products</td>' +
                            status +
                            '<td class="center">' +
                            icon +
                            '<a id="detDesignerBtn" class="detDesigner btn btn-primary" ' +
                            'onclick="$(\'#content\').load(\'Pages/PagesPHP/DesignersPHP/designer_details.php?value='+designer['NAME'].split(' ').join('+')+'$'+designer['DESCRIPTION'].split(' ').join('+')+'&id='+designer['ID']+'\')">' +
                            '<i class="halflings-icon white zoom-in"></i></a>'+
                            '<a id="editDesignerBtn" class="editDesigner btn btn-info" ' +
                            'onclick="$(\'#content\').load(\'Pages/PagesPHP/DesignersPHP/designer_edit.php?value='+designer['NAME'].split(' ').join('+')+'$'+designer['DESCRIPTION'].split(' ').join('+')+'&id='+designer['ID']+'\')">' +
                            '<i class="halflings-icon white edit"></i></a>'+
                            '<a id="deleteDesignerBtn" class="deleteDesigner btn btn-danger" ' +
                            'onclick="ShowModal(\'Designer ['+designer['NAME']+'] Delete\',\'Close\',\'Pages/PagesPHP/DesignersPHP/designer_delete.php?val='+designer['NAME'].split(' ').join('+')+'&id='+designer['ID']+'\',false)">' +
                            '<i class="halflings-icon white trash"></i></a>'+
                            '</td>' +
                            '</tr>');
                    }
                    else{
                        if(designer['IS_ACTIVE'].indexOf('1') >= 0){
                            status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';
                            icon = '<a id="updateDesignerBtn" class="btn btn-success" ' +
                                'onclick="ShowModal(\'Designer '+designer['NAME']+' Deactivate\',\'Close\',\'Pages/PagesPHP/DesignersPHP/designer_update.php?id='+designer['ID']+'&status=false\',false)">' +
                                '<i class="halflings-icon white eye-close"></i></a>';
                        }
                        else if(designer['IS_ACTIVE'].indexOf('0') >= 0){
                            status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';
                            icon = '<a id="updateDesignerBtn" class="updateDesigner btn btn-warning" ' +
                                'onclick="ShowModal(\'Designer '+designer['NAME']+' Activate\',\'Close\',\'Pages/PagesPHP/DesignersPHP/designer_update.php?id='+designer['ID']+'&status=true\',false)">' +
                                '<i class="halflings-icon white eye-open"></i></a>';
                        }
                        $('#designerTable').append('<tr>' +
                            '<td class="center">'+designer['NAME']+'</td>' +
                            '<td class="center">No Products</td>' +
                            status +
                            '<td class="center">' +
                            icon +
                            '<a id="detDesignerBtn" class="detDesigner btn btn-primary" ' +
                            'onclick="$(\'#content\').load(\'Pages/PagesPHP/DesignersPHP/designer_details.php?value='+designer['NAME'].split(' ').join('+')+'$'+designer['DESCRIPTION'].split(' ').join('+')+'&id='+designer['ID']+'\')">' +
                            '<i class="halflings-icon white zoom-in"></i></a>'+
                            '<a id="editDesignerBtn" class="editDesigner btn btn-info" ' +
                            'onclick="$(\'#content\').load(\'Pages/PagesPHP/DesignersPHP/designer_edit.php?value='+designer['NAME'].split(' ').join('+')+'$'+designer['DESCRIPTION'].split(' ').join('+')+'&id='+designer['ID']+'\')">' +
                            '<i class="halflings-icon white edit"></i></a>'+
                            '<a id="deleteDesignerBtn" class="deleteDesigner btn btn-danger" ' +
                            'onclick="ShowModal(\'Designer ['+designer['NAME']+'] Delete\',\'Close\',\'Pages/PagesPHP/DesignersPHP/designer_delete.php?val='+designer['NAME'].split(' ').join('+')+'&id='+designer['ID']+'\',false)">' +
                            '<i class="halflings-icon white trash"></i></a>'+
                            '</td>' +
                            '</tr>');
                    }
                    if(!CheckPrivilege('DELETE_DESIGNER')){
                        $('.deleteDesigner').css('visibility','hidden');
                    }
                    if(!CheckPrivilege('EDIT_DESIGNER')){
                        $('.editDesigner').css('visibility','hidden');
                    }
                    if(!CheckPrivilege('UPDATE_DESIGNER')){
                        $('.updateDesigner').css('visibility','hidden');
                    }
                });

            }
            else{
                designers = [];
            }
            $('.datatable').DataTable();
        }).success(function () {
            $('.ajax-loader').css('visibility','hidden');
        });
    }


});