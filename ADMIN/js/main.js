const MEMBER_PRIVILEGES = [];
const CURRENT_PAGE = '';

$(document).ready(function(){
    $('#profileDiv').load('Shared/profile.php');

    var ID = $('#hiddenMemberID').val() || 0;

    $.get('Handlers/GetAllPrivileges.php',{'id':ID},function(data){
        if(data !== ''){
            var array = $.parseJSON(data);
            $(array).each(function(id,val){
                var privilege = val['PRIVILEGE'];
                var checked = val['VALUE'] === "0" ? false : true;

                MEMBER_PRIVILEGES.push({
                    'PRIVILEGE':privilege,
                    'CHECKED':checked
                });
            });
        }
        $('#notificationDiv').load('Shared/notification.php');
        $('#messageDiv').load('Shared/message.php');
    });

   $.get('Handlers/GetMenu.php', function (data) {
       var items = $.parseJSON(data);
       var firstLink = items[0]['LINK'];
       $(items).each(function (id,item) {
           if(item['SUBITEMS'].length === 0){
               $('#menuDiv').append('<li style="cursor: pointer;" id="'+item['ID']+'"><a><i class="'+item['ICON']+'"></i>' +
                   '<span class="hidden-tablet"> '+item['TITLE']+'</span></a></li>');

               $('#menuDiv li#'+item['ID']).on('click',function(){
                   $('#content').load(item['LINK']);
                   $('#menuDiv li').removeClass('active');
                   $(this).addClass('active');
               });
           }
           else if(item['SUBITEMS'].length > 0){
               $('#menuDiv').append('<li style="cursor: pointer;" id="'+item['ID']+'"><a class="dropmenu"><i class="'+item['ICON']+'">' +
                   '</i><span class="hidden-tablet"> '+
                   item['TITLE']+'</span><span class="icon-angle-down"></span></a>' +
                   '<ul>');
               $(item['SUBITEMS']).each(function(id,subitem){
                   if(subitem['IS_VISIBLE'].indexOf("1") >= 0)
                   {
                       $('#menuDiv #'+item['ID']+' ul').append(
                           '<li style="cursor: pointer;" id="'+subitem['ID']+'"><a class="submenu">' +
                           '<i class="'+subitem['ICON']+'"></i><span class="hidden-tablet">'+subitem['TITLE']+'</span></a></li>'
                       );

                       $('#menuDiv #'+item['ID']+' ul li#'+subitem['ID']).on('click',function(){
                           $('#content').load(subitem['LINK']);
                           $('#menuDiv li').removeClass('active');
                           $(this).addClass('active');
                       });
                   }
               });
               $('#menuDiv').append('</ul></li>');
           }
       });

       $('.dropmenu').click(function(e){

           e.preventDefault();

           $(this).parent().find('ul').slideToggle();

       });

       $('#menuDiv li:first').addClass('active');
       $('#content').load(firstLink);
   });
});

function CheckPrivilege(PrivilegeName){
    var privilege = MEMBER_PRIVILEGES.filter(function (PRIVILEGE) {
        return PRIVILEGE.PRIVILEGE === PrivilegeName;
    });
    if(privilege.length  === 0){
        return false;
    }


    return privilege[0]['CHECKED'];
}

function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}

function InputDataType(id,datatype,feature){
    switch (datatype){
        case 'STRING':
            return '<input type="text" id="value'+id+'" name="value'+id+'" placeholder="Enter '+(feature.toLowerCase()).charAt(0).toUpperCase() + feature.slice(1) +'"/>';
            break;
        case 'DATETIME':
            return '<input type="date" id="value'+id+'" name="value'+id+'" placeholder="Enter '+(feature.toLowerCase()).charAt(0).toUpperCase() + feature.slice(1) +'"/>';
            break;
        case 'INTEGER':
            return '<input type="number" id="value'+id+'" name="value'+id+'" placeholder="Enter '+(feature.toLowerCase()).charAt(0).toUpperCase() + feature.slice(1) +'"/>';
            break;
        case 'DOUBLE':
        case 'DECIMAL':
            return '<input type="number" step="0.01" id="value'+id+'" name="value'+id+'" placeholder="Enter '+(feature.toLowerCase()).charAt(0).toUpperCase() + feature.slice(1) +'"/>';
            break;
        case 'BOOLEAN':
            return '<input type="checkbox" value="off" id="value'+id+'" name="value'+id+'"/>';
        break;
    }
}

function InputEditDataType(id,datatype,feature,value){
    switch (datatype){
        case 'STRING':
            if(value === null){value = '';}
            return '<input class="val" type="text" id="value'+id+'" name="value'+id+'" value="'+value+'" placeholder="Enter '+(feature.toLowerCase()).charAt(0).toUpperCase() + feature.slice(1) +'"/>';
            break;
        case 'DATETIME':
            if(value === null){value = new Date();}
            return '<input class="val" type="date" id="value'+id+'" name="value'+id+'" value="'+value+'" placeholder="Enter '+(feature.toLowerCase()).charAt(0).toUpperCase() + feature.slice(1) +'"/>';
            break;
        case 'INTEGER':
            if(value === null){value = 0;}
            return '<input class="val" type="number" id="value'+id+'" name="value'+id+'" value="'+value+'" placeholder="Enter '+(feature.toLowerCase()).charAt(0).toUpperCase() + feature.slice(1) +'"/>';
            break;
        case 'DOUBLE':
        case 'DECIMAL':
            if(value === null){value = 0.00;}
            return '<input class="val" type="number" step="0.01" id="value'+id+'" name="value'+id+'" value="'+value+'" placeholder="Enter '+(feature.toLowerCase()).charAt(0).toUpperCase() + feature.slice(1) +'"/>';
            break;
        case 'BOOLEAN':
            if(value === "true")
                return '<input class="val" type="checkbox" id="value'+id+'" name="value'+id+'" checked/>';
            else
                return '<input class="val" type="checkbox" id="value'+id+'" name="value'+id+'"/>';
            break;
    }
}

function ShowModal(title,button,link,isBind) {
    if(isBind){
        $('#MyModal').bind('hide',function(){
            ShowActionModal();
        });
    }
    else{
        $('#MyModal').unbind('hide');
    }

    $('#MyModal .modal-title').html(title);
    $('#MyModal .modal-body').empty();
    $('#MyModal .modal-footer').empty();
    $('#MyModal .modal-body').load(link);

    switch(button){
        case 'Close':
            $('#MyModal .modal-footer').append('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
            break;
    }

    $('#MyModal').modal();
}

function ShowActionModal() {
    $('#MyActionModal .modal-title').html('Warning');
    $('#MyActionModal .modal-body').empty();
    $('#MyActionModal .modal-footer').empty();
    $('#MyActionModal .modal-body').html('Are you sure you want to close without saving or adding?');

    $('#MyActionModal .modal-footer').append('<button type="button" class="btn btn-primary" onclick="$(\'#MyActionModal\').modal(\'hide\');">Yes</button>');
    $('#MyActionModal .modal-footer').append('<button type="button" class="btn btn-default" onclick="$(\'#MyActionModal\').modal(\'hide\');$(\'#MyModal\').modal(\'show\');">No</button>');

    $('#MyActionModal').modal();
}