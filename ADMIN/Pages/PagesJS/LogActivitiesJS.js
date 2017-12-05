$(document).ready(function () {
    if(!CheckPrivilege('SHOW_LOG_ACTIVITIES')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to show log activities.');
        $('#deleteBtn').css('display','none');
    }
    else{
        $('.ajax-loader').css('visibility','visible');
        if(!CheckPrivilege('DELETE_LOG_ACTIVITIES')){
            $('#deleteBtn').css('display','none');
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
        }).success(function () {
            $('.ajax-loader').css('visibility','hidden');
        });
    }
});