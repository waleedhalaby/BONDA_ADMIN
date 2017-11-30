<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-star"></i>
        <em>Products Portal</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-tasks"></i>
        <em>Categories</em>
    </li>
</ul>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="halflings-icon white cart"></i><span class="break"></span>Categories</h2>
            <div class="box-icon">
                <a id="addCategoryBtn" onclick="ShowModal('Add Category','Close','Pages/PagesPHP/CategoriesPHP/category_add.php')"
                   class="btn-setting"><i class="halflings-icon white plus-sign"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr style="background-color: #0c5460;color:#F4F4F4;">
                    <th>Category</th>
                    <th>Number of Products</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="categoryTable">
                <tr><td colspan="4">No Records Found</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="Pages/PagesJS/CategoriesJS.js"></script>