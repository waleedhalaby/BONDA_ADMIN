$(document).ready(function () {
    if(!CheckPrivilege('SHOW_BANNER')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to view banners.');
        $('#addBannerBtn').css('visibility','hidden');
    }
    else{
        $('.ajax-loader').css('visibility','visible');
        if(!CheckPrivilege('ADD_BANNER')){
            $('#addBannerBtn').css('visibility','hidden');
        }


        $('#bannerTable').html('');
        var banners = [];

        $.get('Pages/PagesPHP/BannerPHP/GetBanners.php',function (data) {
            if(data !== ''){
                banners = $.parseJSON(data);
                if(banners.length > 4){
                    $('#addBannerBtn').css('visibility','hidden');
                }
                else{
                    $('#addBannerBtn').css('visibility','visible');
                }
                var counter = 1;
                $(banners).each(function (id,banner) {
                    var image;
                    if(banner['IMAGE'] !== null){
                        image = '<img id="imageThumb'+banner['ID']+'" class="img-polaroid compress-image" style="height: 150px;width: 150px;" src="'+banner['IMAGE']+'"/>';
                    }
                    else{
                        image = '<img class="img-polaroid compress-image-none" style="width: 150px;height: 150px;" src="Images/default-image.png"/>';
                    }
                    $('#bannerTable').append('<tr>' +
                        '<td class="center">'+counter+'</td>' +
                        '<td class="center">'+image+'</td>' +
                        '<td class="center">' +
                        '<a id="detBannerBtn" class="detBanner btn btn-primary" ' +
                        'onclick="$(\'#content\').load(\'Pages/PagesPHP/BannerPHP/banner_details.php?id='+banner['ID']+'\')">' +
                        '<i class="halflings-icon white zoom-in"></i></a>'+
                        '<a id="editBannerBtn" class="editBanner btn btn-info" ' +
                        'onclick="$(\'#content\').load(\'Pages/PagesPHP/BannerPHP/banner_edit.php?id='+banner['ID']+'\')">' +
                        '<i class="halflings-icon white edit"></i></a>'+
                        '<a id="deleteBannerBtn" class="deleteBanner btn btn-danger" ' +
                        'onclick="ShowModal(\'Banner Image Delete\',\'Close\',\'Pages/PagesPHP/BannerPHP/banner_delete.php?id='+banner['ID']+'\',false)">' +
                        '<i class="halflings-icon white trash"></i></a>'+
                        '</td>' +
                        '</tr>');
                    counter++;
                });
                if(!CheckPrivilege('DELETE_BANNER')){
                    $('.deleteBanner').css('visibility','hidden');
                }
                if(!CheckPrivilege('EDIT_BANNER')){
                    $('.editBanner').css('visibility','hidden');
                }
            }
            else{
                banners = [];
            }
            $('.datatable').DataTable();
        }).success(function () {
            $('.ajax-loader').css('visibility','hidden');
        });
    }


});