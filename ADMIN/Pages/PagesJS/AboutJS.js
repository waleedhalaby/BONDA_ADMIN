var isChanged = false;
function HandleFileClick(id) {
    var fileInput = document.getElementById(id);
    fileInput.click();
}

function HandleFileChange(id,image,text,remove) {

    var fileInput = document.getElementById(id);
    var imageInput = document.getElementById(image);
    var textInput = document.getElementById(text);
    var removeBtn = document.getElementById(remove);

    var reader = new FileReader();
    reader.onload = function(){
        imageInput.src = reader.result;
        imageInput.style.display = "block";
    };
    reader.readAsDataURL(fileInput.files[0]);
    imageName = fileInput.files[0]['name'];

    textInput.style.visibility = "hidden";
    removeBtn.style.visibility = "visible";
}

function RemoveImageBtn(file,removeButton,image,text){
    var fileInput = document.getElementById(file);
    var imageInput = document.getElementById(image);
    var textInput = document.getElementById(text);

    $.ajax({
        url:'Pages/PagesPHP/AboutPHP/RemoveAboutImages.php?id=1',
        type:"POST",
        success:function(data){
            $('#'+removeButton).css('visibility','hidden');
            imageInput.style.display = "none";
            imageInput.src = '';
            fileInput.value = '';
            textInput.style.visibility = "visible";
            isChanged = true;
        },
        error:function(data){
            $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
        }
    });

}
$(document).ready(function () {
    if(!CheckPrivilege('SHOW_ABOUT')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to view about.');
    }
    else{
        $('.ajax-loader').css('visibility','visible');

        $.get('Pages/PagesPHP/AboutPHP/GetAbout.php',function (data) {
            if(data !== ''){
                var about = $.parseJSON(data);
                var image;
                if(about['IMAGE'] !== null){
                    image = '<tr><td colspan="2" class="text-left">' +
                        '<div class="row-fluid">'+
                        '<div class="col-md-12">'+
                        '<a id="imageBtn1" onclick="HandleFileClick(\'fileupload1\')">' +
                        '<div class="image-portrait">' +
                        '<input type="file" id="fileupload1" style="display:none" onchange="HandleFileChange(\'fileupload1\',\'image1\',\'text1\',\'removeImage1\')"/>'+
                        '<img id="image1" src="'+about['IMAGE']+'" class="image-thumb"/>'+
                        '<input type="hidden" id="oldImage1" value="'+about['IMAGE']+'"/>'+
                        '<p style="visibility: hidden" id="text1"><span class="icon-plus"></span><br/>Click here to upload</p>'+
                        '</div>'+
                        '</a>' +
                        '</div></div>'+
                        '<div style="text-align: left" class="row-fluid">'+
                        '<div class="col-md-12">'+
                        '<input type="button" id="removeImage1" class="btn btn-small btn-danger"'+
                        ' onclick="RemoveImageBtn(\'fileupload1\',\'removeImage1\',\'image1\',\'text1\')" value="Remove Image"/>'+
                        '</div>'+
                        '</div>'+
                        '</td></tr>';
                }
                else{
                    image = '<tr><td colspan="2" class="text-left">' +
                        '<div class="row-fluid">'+
                        '<div class="col-md-12">'+
                        '<a id="imageBtn1" onclick="HandleFileClick(\'fileupload1\')">'+
                        '      <div class="image-portrait">'+
                        '            <input type="file" id="fileupload1" style="display:none" onchange="HandleFileChange(\'fileupload1\',\'image1\',\'text1\',\'removeImage1\')"/>' +
                        '            <img id="image1" class="image-thumb" style="display:none"/>' +
                        '            <input type="hidden" id="oldImage1" value="0"/>' +
                        '            <p id="text1"><span class="icon-plus"></span><br/>Click here to upload</p>' +
                        '      </div>'+
                        '    </a>'+
                        '</div></div>'+
                        '<div style="text-align: left" class="row-fluid">'+
                        '<div class="col-md-12">'+
                        '<input type="button" id="removeImage1" style="visibility: hidden;" class="btn btn-small btn-danger"'+
                        ' onclick="RemoveImageBtn(\'fileupload1\',\'removeImage1\',\'image1\',\'text1\')" value="Remove Image"/>'+
                        '</div>'+
                        '</div>'+
                        '</td></tr>';
                }
                var paragraph = about['PARAGRAPH'] !== null ? about['PARAGRAPH'] : '';
                var owner = about['OWNER'] !== null ? about['OWNER'] : '';
                $('.about-details-table tbody').html(
                    image+
                    '<tr><td style="background-color: #0c5460;color:#F4F4F4;">PARAGRAPH</td><td><textarea id="Paragraph"  style="width: 100%;" rows="3" name="Paragraph">'+ paragraph +'</textarea></td></tr>'+
                    '<tr><td style="background-color: #0c5460;color:#F4F4F4;">OWNER NAME</td><td><input name="Owner" id="Owner" type="text" value="'+ owner +'" placeholder="Enter Owner Name"/></td></tr>'
                );
            }

            $('#AboutForm').submit(function(e){
                e.preventDefault();

                $('#AboutBtn').attr('disabled','true');
                $('#AboutBtn').attr('value','Sending, please wait...');

                var url = "Pages/PagesPHP/AboutPHP/SaveAbout.php";


                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#AboutForm').serialize(),
                    success: function (data) {
                        if(!(data.indexOf('Error')>= 0)){
                            var url = "Pages/PagesPHP/AboutPHP/UpdateAboutImages.php?id="+data;
                            var form_data = new FormData();
                            var file_data1 = document.getElementById('fileupload1').files[0];
                            form_data.append("fileupload1",file_data1);
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function (data) {
                                    if(data.indexOf("successfully") >=0 || data === '' || isChanged){
                                        $('#content').load('Pages/About.php');
                                        $('#message').html('');
                                        ShowMessageModal('Message','<div class="container-fluid text-center"><span class="label label-warning">About us is saved successfully</span></div>');
                                        $( "#MyModal").unbind( "hide" );
                                    }
                                    else{
                                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                                    }
                                },
                                error: function(data){
                                    $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                                }
                            });
                        }
                        else{
                            $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                        }
                    },
                    error: function(data){
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                });
            });
        }).success(function () {
            $('.ajax-loader').css('visibility','hidden');
        });
    }


});