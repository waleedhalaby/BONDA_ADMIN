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
        <i class="icon-gift"></i>
        <em>Products</em>
    </li>
</ul>
<div class="ajax-loader">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="halflings-icon white cart"></i><span class="break"></span>Products</h2>
            <div class="box-icon">
                <a id="addProductBtn" onclick="$('#content').load('Pages/PagesPHP/ProductsPHP/product_add.php')"
                   class="btn-setting"><i class="halflings-icon white plus-sign"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr style="background-color: #0c5460;color:#F4F4F4;">
                        <th>IMAGE</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    <tr><td colspan="8">No Records Found</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="Pages/PagesJS/ProductsJS.js"></script>