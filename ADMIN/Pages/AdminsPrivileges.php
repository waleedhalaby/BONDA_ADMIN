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
        <i class="icon-eye-open"></i>
        <em>Members Privileges</em>
    </li>
</ul>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="halflings-icon white user"></i><span class="break"></span>Members Privileges</h2>
            <div class="box-icon">
                <a id="addPrivilegeBtn" onclick="ShowModal('Add New Privilege','Close','Pages/PagesPHP/AdminsPrivilegesPHP/member_privileges_add.php',true)"
                   class="btn-setting"><i class="halflings-icon white plus-sign"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="control-group">
                <label class="control-label" for="membersCB">Select Member</label>
                <div class="controls">
                    <select id="membersCB" data-rel="chosen">
                        <option disabled selected>Select Member</option>
                    </select>
                </div>
            </div>
            <p id="information"></p>
            <div class="privileges">

            </div>
            <button id="saveBtn" class="btn btn-success">Save</button>
        </div>
    </div>
</div>

<script src="Pages/PagesJS/AdminsPrivilegesJS.js"></script>