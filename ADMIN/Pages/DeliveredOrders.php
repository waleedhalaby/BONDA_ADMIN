<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-book"></i>
        <em>Orders Portal</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-shopping-cart"></i>
        <em>Delivered Orders</em>
    </li>
</ul>
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header">
            <h2><i class="halflings-icon white cart"></i><span class="break"></span>Delivered Orders</h2>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                <tr>
                    <th>UNIQUE ID</th>
                    <th>FROM</th>
                    <th>NUMBER OF PRODUCTS</th>
                    <th>ORDER DATE</th>
                    <th>PAYMENT TYPE</th>
                    <th>TOTAL</th>
                    <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody id="orderTable">
                <tr><td colspan="8">No Records Found</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="Pages/PagesJS/DeliveredOrdersJS.js"></script>