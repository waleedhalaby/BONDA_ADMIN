$(document).ready(function () {
    if(!CheckPrivilege('SHOW_MEMBERS')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to view members.');
        $('#addMemberBtn').css('visibility','hidden');
    }
    else{
        if(!CheckPrivilege('ADD_MEMBER')){
            $('#addMemberBtn').css('visibility','hidden');
        }

        $('.ajax-loader').css('visibility','visible');

        $.get('Pages/PagesPHP/AdminsPHP/GetAdmins.php',function (data) {
            if(data !== ''){
                var array = $.parseJSON(data);
                $(array).each(function (id,val) {
                    var status;
                    if(val[5].indexOf('INACTIVE') >= 0){
                        status = '<td class="center"><span class="label label-info">'+val[5]+'</span></td>';
                    }
                    else if(val[5].indexOf('ACTIVE') >= 0){
                        status = '<td class="center"><span class="label label-warning">'+val[5]+'</span></td>';
                    }
                    $('.datatable #adminTable').append('<tr>' +
                        '<td class="center">'+val[0]+'</td>' +
                        '<td class="center">'+val[1]+'</td>' +
                        '<td class="center">'+val[2]+' '+val[3]+'</td>' +
                        '<td class="center"><span class="label label-success">'+val[4]+'</span></td>' +
                        status +
                        '<td class="center">' +
                        '<a id="detailMemberBtn" class="btn btn-primary" ' +
                        'onclick="$(\'#content\').load(\'Pages/PagesPHP/AdminsPHP/member_details.php?id='+val[0]+'\')">' +
                        '<i class="halflings-icon white zoom-in"></i></a>'+
                        '<a id="editMemberBtn" class="editMember btn btn-info" ' +
                        'onclick="$(\'#content\').load(\'Pages/PagesPHP/AdminsPHP/member_edit.php?id='+val[0]+'\')">' +
                        '<i class="halflings-icon white edit"></i></a>'+
                        '<a id="deleteMemberBtn" class="deleteMember btn btn-danger" ' +
                        'onclick="ShowModal(\'Member [#'+val[0]+'] Delete\',\'Close\',\'Pages/PagesPHP/AdminsPHP/member_delete.php?id='+val[0]+'\',false)">' +
                        '<i class="halflings-icon white trash"></i></a>'+
                        '</td>' +
                        '</tr>');
                    if(!CheckPrivilege('EDIT_MEMBERS')){
                        $('.editMember').css('visibility','hidden');
                    }

                    if(!CheckPrivilege('DELETE_MEMBERS')){
                        $('.deleteMember').css('visibility','hidden');
                    }
                });


            }

            $('.datatable').DataTable();
        }).success(function () {
            $('.ajax-loader').css('visibility','hidden');
        });
    }


});