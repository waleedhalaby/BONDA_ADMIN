$(document).ready(function () {

    if(!CheckPrivilege('SHOW_MEMBERS_PRIVILEGES')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to update privileges.');
        $('#addPrivilegeBtn').css('visibility','hidden');
    }
    else{
        // if(!CheckPrivilege('ADD_MEMBER_PRIVILEGE')){
        //     $('#addPrivilegeBtn').css('visibility','hidden');
        // }

        var PERSON_ID = $('#hiddenMemberID').val();
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

        $('#membersCB').on('change',function(){
            var ID = $(this).val();
            $('.privileges').html(
                '                <div style="border:2px solid #2d6987;padding: 10px;border-radius: 5px;" class="productP">\n' +
                '<h2>PRODUCTS & CATEGORIES</h2>' +
                '                </div>\n' +
                '                <div style="border:2px solid #2d6987;padding: 10px;border-radius: 5px;" class="orderP">\n' +
                '<h2>ORDERS</h2>' +
                '                </div>\n' +
                '                <div style="border:2px solid #2d6987;padding: 10px;border-radius: 5px;" class="adminP">\n' +
                '<h2>ADMINISTRATION</h2>' +
                '                </div>\n' +
                '                <div style="border:2px solid #2d6987;padding: 10px;border-radius: 5px;" class="productFeatureP">\n' +
                '<h2>PRODUCT FEATURES</h2>' +
                '                </div>\n' +
                '                <div style="border:2px solid #2d6987;padding: 10px;border-radius: 5px;" class="logP">\n' +
                '<h2>LOG ACTIVITIES</h2>' +
                '                </div>\n' +
                '                <div style="border:2px solid #2d6987;padding: 10px;border-radius: 5px;" class="pagesP">\n' +
                '<h2>PAGES</h2>' +
                '                </div>');
            if(!CheckPrivilege('SHOW_PRODUCTS_PORTAL')){
                $('.productP').css('display','none');
            }
            if(!CheckPrivilege('SHOW_ORDERS_PORTAL')){
                $('.orderP').css('display','none');
            }
            if(!CheckPrivilege('SHOW_ADMINISTRATIONS')){
                $('.adminP').css('display','none');
            }
            if(!CheckPrivilege('SHOW_PRODUCT_FEATURES')){
                $('.productFeatureP').css('display','none');
            }
            if(!CheckPrivilege('SHOW_LOG_ACTIVITIES')){
                $('.logP').css('display','none');
            }
            if(!CheckPrivilege('SHOW_PAGES_PORTAL')){
                $('.pagesP').css('display','none');
            }

            $.get('Pages/PagesPHP/AdminsPrivilegesPHP/GetPrivileges.php',{'id':ID},function(data){
                if(data !== ''){
                    var array = $.parseJSON(data);
                    var changes = [];
                    var counter = 0;
                    $(array).each(function(id,val){
                        if(val['CATEGORY'] === 'PRODUCTS_CATEGORIES'){
                            var privilege = val['PRIVILEGE'].replace(/_/g,' ');
                            var checked = val['VALUE'] === "0" ? "" : "checked";
                            $('.privileges .productP').append('<label class="checkbox">' +
                                '<input value="'+val['ID']+'" type="checkbox" '+checked+'>' +
                                privilege +
                                '</label>');
                        }
                        else if(val['CATEGORY'] === 'ORDERS'){
                            var privilege = val['PRIVILEGE'].replace(/_/g,' ');
                            var checked = val['VALUE'] === "0" ? "" : "checked";
                            $('.privileges .orderP').append('<label class="checkbox">' +
                                '<input value="'+val['ID']+'" type="checkbox" '+checked+'>' +
                                privilege +
                                '</label>');
                        }
                        else if(val['CATEGORY'] === 'ADMINISTRATION'){
                            var privilege = val['PRIVILEGE'].replace(/_/g,' ');
                            var checked = val['VALUE'] === "0" ? "" : "checked";
                            $('.privileges .adminP').append('<label class="checkbox">' +
                                '<input value="'+val['ID']+'" type="checkbox" '+checked+'>' +
                                privilege +
                                '</label>');
                        }
                        else if(val['CATEGORY'] === 'PRODUCT_FEATURES'){
                            var privilege = val['PRIVILEGE'].replace(/_/g,' ');
                            var checked = val['VALUE'] === "0" ? "" : "checked";
                            $('.privileges .productFeatureP').append('<label class="checkbox">' +
                                '<input value="'+val['ID']+'" type="checkbox" '+checked+'>' +
                                privilege +
                                '</label>');
                        }
                        else if(val['CATEGORY'] === 'LOG_ACTIVITIES'){
                            var privilege = val['PRIVILEGE'].replace(/_/g,' ');
                            var checked = val['VALUE'] === "0" ? "" : "checked";
                            $('.privileges .logP').append('<label class="checkbox">' +
                                '<input value="'+val['ID']+'" type="checkbox" '+checked+'>' +
                                privilege +
                                '</label>');
                        }
                        else if(val['CATEGORY'] === 'PAGES'){
                            var privilege = val['PRIVILEGE'].replace(/_/g,' ');
                            var checked = val['VALUE'] === "0" ? "" : "checked";
                            $('.privileges .pagesP').append('<label class="checkbox">' +
                                '<input value="'+val['ID']+'" type="checkbox" '+checked+'>' +
                                privilege +
                                '</label>');
                        }

                        counter++;
                    });
                    $('#saveBtn').on('click',function(){
                        var changes = '';
                        $('.privileges .productP input[type=checkbox]').each(function(){
                            changes += $(this).val()+ '_' +($(this).attr("checked") ? 1:0)+' ';
                        });
                        $('.privileges .orderP input[type=checkbox]').each(function(){
                            changes += $(this).val()+ '_' +($(this).attr("checked") ? 1:0)+' ';
                        });
                        $('.privileges .adminP input[type=checkbox]').each(function(){
                            changes += $(this).val()+ '_' +($(this).attr("checked") ? 1:0)+' ';
                        });
                        $('.privileges .productFeatureP input[type=checkbox]').each(function(){
                            changes += $(this).val()+ '_' +($(this).attr("checked") ? 1:0)+' ';
                        });
                        $('.privileges .logP input[type=checkbox]').each(function(){
                            changes += $(this).val()+ '_' +($(this).attr("checked") ? 1:0)+' ';
                        });
                        $('.privileges .pagesP input[type=checkbox]').each(function(){
                            changes += $(this).val()+ '_' +($(this).attr("checked") ? 1:0)+' ';
                        });

                        $.post('Pages/PagesPHP/AdminsPrivilegesPHP/UpdatePrivileges.php?maker='+PERSON_ID,{id:ID,changes:changes},function(data){
                            if(data.indexOf('true') >= 0){
                                $('#content').load('Pages/AdminsPrivileges.php');
                                $('.box-content p#information').html('<div class="container-fluid text-center"><span class="label label-warning">Privileges Are Updated Successfully.</span></div>');
                            }
                            else{
                                $('.box-content p#information').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                            }
                        });
                    });
                }
            });
        });
    }

});