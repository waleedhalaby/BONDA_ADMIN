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

    $('#contactFrm').submit(function(){
        $.post('PagesPHP/AddContact.php',{titleTxt:$('#titleTxt').val(),descTxt:$('#descTxt').val()},function(data){
            if(data.indexOf("successfully") >= 0){
                $('#message').html(
                    '<div class="alert alert-success">' +
                    '  <strong>Success!</strong>'+ data +
                    '</div>');
            }
            else{
                $('#message').html(
                    '<div class="alert alert-danger">' +
                    '  <strong>Error!</strong> '+ data +
                    '</div>');
            }
        });
    });
});