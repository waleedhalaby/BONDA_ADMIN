<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-lock"></i>
        <em>Administration</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-sitemap"></i>
        <em>Members Roles</em>
    </li>
</ul>
<div class="ajax-loader">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="halflings-icon white cart"></i><span class="break"></span>Members Roles</h2>
            <div class="box-icon">
                <a id="addRoleBtn" onclick="ShowModal('Add Category','Close','Pages/PagesPHP/RolesPHP/role_add.php',true)"
                   class="btn-setting"><i class="halflings-icon white plus-sign"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr style="background-color: #0c5460;color:#F4F4F4;">
                    <th>Role</th>
                    <th>Number of Members</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="roleTable">
                <tr><td colspan="4">No Records Found</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="Pages/PagesJS/RolesJS.js"></script>