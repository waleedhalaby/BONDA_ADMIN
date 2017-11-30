$(document).ready(function () {
    if(!CheckPrivilege('VIEW_LOGS')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to view logs.');
    }

    $('#deleteBtn').on('click',function(){
        var url = "Pages/PagesPHP/LogsPHP/DeleteLogs.php";

        $.ajax({
            type: 'POST',
            url: url,
            success: function (data) {
                $('#content').load('Pages/LogActivities.php');
            }
        });
    });

    $.get('Pages/PagesPHP/LogsPHP/GetLogs.php',function (data) {
        if(data !== ''){
            var logs = $.parseJSON(data);
            $(logs).each(function (id,log) {
                $('.datatable #logTable').append('<tr>' +
                    '<td class="center">'+log['DATE_TIME']+'</td>' +
                    '<td class="center">'+log['MEMBER_NAME']+'</td>' +
                    '<td class="center">'+log['PAGE']+'</td>' +
                    '<td class="center">'+log['DESCRIPTION']+'</td>' +
                    '</tr>');
            });


        }
        $('.datatable').DataTable();
    });
});