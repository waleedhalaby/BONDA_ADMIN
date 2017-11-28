$(document).ready(function () {


   $.get('Pages/PagesPHP/AdminsPHP/GetAdmins.php',function (data) {
       if(data !== ''){
           var array = $.parseJSON(data);
           $(array).each(function (id,val) {
               var ID = val[0];
               var FIRST_NAME = val[2];
               var LAST_NAME = val[3];

               $('#membersCB').append(
                   '<option value="'+ID+'">'+FIRST_NAME+' '+LAST_NAME+' ['+val[4]+']</option>'
               );
           });
       }
   });
    if(!CheckPrivilege('ADD_PRIVILEGES')){
        $('#addPrivilegeBtn').css('visibility','hidden');
    }

    if(!CheckPrivilege('UPDATE_PRIVILEGES')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to update privileges.');
    }


   $('#membersCB').on('change',function(){
        var ID = $(this).val();
       $('.privileges').empty();
        $.get('Pages/PagesPHP/AdminsPrivilegesPHP/GetPrivileges.php',{'id':ID},function(data){
            if(data !== ''){
                var array = $.parseJSON(data);
                var changes = [];
                var counter = 0;
                $(array).each(function(id,val){
                    var privilege = val[1].replace(/_/g,' ');
                    var checked = val[2] === "0" ? "" : "checked";
                    $('.privileges').append('<label class="checkbox">' +
                        '<input value="'+val[0]+'" type="checkbox" '+checked+'>' +
                        privilege +
                        '</label>');
                    counter++;
                });
                $('#saveBtn').on('click',function(){
                    var changes = '';
                    $('.privileges input[type=checkbox]').each(function(){
                        changes += $(this).val()+ '_' +($(this).attr("checked") ? 1:0)+' ';
                    });

                    $.post('Pages/PagesPHP/AdminsPrivilegesPHP/UpdatePrivileges.php',{id:ID,changes:changes},function(data){
                        if(data.indexOf('true') >= 0){
                            $('#content').load('Pages/AdminsPrivileges.php');
                            $('.box-content p#information').html('Privileges Are Updated Successfully.');
                        }
                        else{
                            $('.box-content p#information').html('Error occurred, please contact your administrator.');
                        }
                    });
                });
            }
        });
   });
});