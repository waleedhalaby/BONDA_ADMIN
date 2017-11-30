<div class="modal-feature-add-content">
    <form id="addFeatureForm">
        <table class="table table-striped table-bordered feature-details-table">
            <tbody>
            <tr><td style="background-color: #0c5460;color:#F4F4F4;">FEATURE</td><td><input name="addFeature" id="addFeature" type="text" placeholder="Enter Feature" required/></td></tr>
            <tr><td style="background-color: #0c5460;color:#F4F4F4;">DATA TYPE</td><td><select id="addType" name="addType" required><option disabled selected>Select Type</option></select></td></tr>
            </tbody>
        </table>
        <input type="submit" style="float: right" class="btn btn-warning" id="addFeatureBtn" value="Add"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $.get('Pages/PagesPHP/ProductFeaturesPHP/GetDataTypes.php',function(data){
            if(data !== ''){
                var types = $.parseJSON(data);
                $(types).each(function(id,type){
                    $('#addType').append('<option value="'+type['ID']+'">'+type['TYPE']+'</option>');
                });
            }
        });

        $('#addFeatureForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/ProductFeaturesPHP/AddProductFeature.php";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addFeatureForm').serialize(),
                success: function (data) {
                    if(data === "1"){
                        $('#content').load('Pages/ProductFeatures.php');
                        $('.modal-feature-add-content').html('<div class="container-fluid text-center"><span class="label label-warning">Feature is Added Successfully.</span></div>');
                    }
                    else{
                        $('.modal-feature-add-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-feature-add-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });
    });
</script>