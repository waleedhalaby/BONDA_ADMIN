<div id="main_container">
    <h2>My Cart</h2>
    <div class="row">
        <div class="col-md-8">
            <table id="cartTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>IMAGE</th>
                    <th>ID</th>
                    <th>PRODUCT NAME</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div id="orderDiv" style="visibility: hidden" class="container border">
                <div style="margin-top: 0" class="row bg-success">
                    <div class="col-md-12 text-center">
                        <h4 style="color: #f0f0f0;padding: 10px" class="label">Order</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <h3>Total</h3>
                    </div>
                    <div class="col-md-6 text-center">
                        <label id="Total"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button id="orderBtn" class="btn btn-block btn-primary">Order Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/cart.js"></script>