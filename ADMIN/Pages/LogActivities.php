<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-user"></i>
        <em>Log Activities</em>
    </li>
</ul>
<div class="ajax-loader">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<button id="deleteBtn" style="float: right" class="btn btn-danger">Delete All Logs</button>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="halflings-icon white cart"></i><span class="break"></span>Log Activities</h2>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr style="background-color: #0c5460;color:#F4F4F4;">
                    <th>DATE TIME</th>
                    <th>MEMBER NAME</th>
                    <th>PAGE</th>
                    <th>DESCRIPTION</th>
                </tr>
                </thead>
                <tbody id="logTable">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="Pages/PagesJS/LogActivitiesJS.js"></script>