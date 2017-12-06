$(document).ready(function(){
    $('#main-container-fluid').append(
        '<form id="contactFrm" class="form form-group">'+
        '<label for="titleTxt">Title</label>'+
        '<input class="form-control" type="text" name="titleTxt" id="titleTxt" required/>'+
        '<label for="descTxt">Description</label>'+
        '<textarea class="form-control" style="min-height: 300px;" type="text" id="descTxt" name="descTxt" required></textarea>'+
        '<input style="margin-top: 10px" class="btn btn-block btn-success" type="submit" name="submitBtn" id="submitBtn"/>'+
        '</form>'
    );

    $('#submitBtn').on('click',function(){
        var url = 'PagesPHP/AddContact.php';
        $.ajax({
            type: "POST",
            url: url,
            data: $('#contactFrm').serialize(),
            success: function (response) {
                if(response.indexOf("successfully") >= 0) {
                    $('#main-container-fluid #message').html(
                        '<div class="alert alert-success">' +
                        '  <strong>Success!</strong>' + response +
                        '</div>');
                }
                else{
                    $('#main-container-fluid #message').html(
                        '<div class="alert alert-danger">' +
                        '  <strong>Error!</strong>' + response +
                        '</div>');
                }
            },
            error: function(data){
                $('#main-container-fluid #message').html(
                    '<div class="alert alert-danger">' +
                    '  <strong>Error!</strong> Error occurred, please contact your administrator.'+
                    '</div>');
            }
        });
    });
});