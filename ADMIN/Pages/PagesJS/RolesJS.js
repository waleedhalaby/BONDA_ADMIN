$(document).ready(function () {
    if(!CheckPrivilege('UPDATE_ROLES')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to update roles.');
        $('#addRoleBtn').css('visibility','hidden');
    }
    else{
        if(!CheckPrivilege('ADD_ROLE')){
            $('#addRoleBtn').css('visibility','hidden');
        }

        $('#roleTable').html('');
        var roles = [];
        $('.ajax-loader').css('visibility','visible');
        $.get('Pages/PagesPHP/RolesPHP/GetRoles.php',function (data) {
            if(data !== ''){
                roles = $.parseJSON(data);
                $(roles).each(function (id,role) {
                    if(role['MEMBERS'] > 0){
                        var status,icon;
                        if(role['IS_ACTIVE'].indexOf('1') >= 0){
                            status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';
                            icon = '<a id="updateRoleBtn" class="btn btn-info" ' +
                                'onclick="ShowModal(\'Role '+role['ROLE']+' Deactivate\',\'Close\',\'Pages/PagesPHP/RolesPHP/role_update.php?id='+role['ID']+'&status=false\',true)">' +
                                '<i class="icon-eye-close"></i></a>';
                        }
                        else if(role['IS_ACTIVE'].indexOf('0') >= 0){
                            status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';
                            icon = '<a id="updateRoleBtn" class="btn btn-warning" ' +
                                'onclick="ShowModal(\'Role '+role['ROLE']+' Activate\',\'Close\',\'Pages/PagesPHP/RolesPHP/role_update.php?id='+role['ID']+'&status=true\',true)">' +
                                '<i class="icon-eye-open"></i></a>';
                        }
                        $('#roleTable').append('<tr>' +
                            '<td class="center">'+role['ROLE']+'</td>' +
                            '<td class="center">'+role['MEMBERS']+' Members</td>' +
                            status +
                            '<td class="center">' +
                            icon +
                            '</td>' +
                            '</tr>');
                    }
                    else{
                        if(role['IS_ACTIVE'].indexOf('1') >= 0){
                            status = '<td class="center"><span class="label label-warning">ACTIVATED</span></td>';
                            icon = '<a id="updateRoleBtn" class="btn btn-info" ' +
                                'onclick="ShowModal(\'Role '+role['ROLE']+' Deactivate\',\'Close\',\'Pages/PagesPHP/RolesPHP/role_update.php?id='+role['ID']+'&status=false\',true)">' +
                                '<i class="icon-eye-close"></i></a>';
                        }
                        else if(role['IS_ACTIVE'].indexOf('0') >= 0){
                            status = '<td class="center"><span class="label label-info">DEACTIVATED</span></td>';
                            icon = '<a id="updateRoleBtn" class="updateRole btn btn-warning" ' +
                                'onclick="ShowModal(\'Role '+role['ROLE']+' Activate\',\'Close\',\'Pages/PagesPHP/RolesPHP/role_update.php?id='+role['ID']+'&status=true\',true)">' +
                                '<i class="icon-eye-open"></i></a>';
                        }
                        $('#roleTable').append('<tr>' +
                            '<td class="center">'+role['ROLE']+'</td>' +
                            '<td class="center">No Members</td>' +
                            status +
                            '<td class="center">' +
                            icon +
                            '</td>' +
                            '</tr>');
                    }
                    if(!CheckPrivilege('UPDATE_ROLE')){
                        $('.updateRole').css('visibility','hidden');
                    }
                });

            }
            else{
                roles = [];
            }
            $('.datatable').DataTable();
        }).success(function () {
            $('.ajax-loader').css('visibility','hidden');
        });
    }

});