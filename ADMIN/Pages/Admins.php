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
        <i class="icon-user"></i>
        <em>Members</em>
    </li>
</ul>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="halflings-icon white user"></i><span class="break"></span>Members</h2>
            <div class="box-icon">
                <a id="addMemberBtn" onclick="ShowModal('Add Member','Close','Pages/PagesPHP/AdminsPHP/member_add.php')"
                   class="btn-setting"><i class="halflings-icon white plus-sign"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr style="background-color: #0c5460;color:#F4F4F4;">
                    <th>ID</th>
                    <th>E-Mail</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="adminTable">

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="Pages/PagesJS/AdminsJS.js"></script>