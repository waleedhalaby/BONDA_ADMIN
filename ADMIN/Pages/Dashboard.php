<?php session_start(); ?>
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-dashboard"></i>
        <em>Dashboard</em>
    </li>
</ul>
<script>
    $(document).ready(function(){
        $.ajax({
                type:'GET',
                url: 'Handlers/UpdateDashboard.php',
                success: function(data){
                    var array = $.parseJSON(data);
                    if(array !== ''){
                        $('#row1').html(
                            '<a class="quick-button metro yellow span4">' +
                            '        <i class="icon-group"></i>' +
                            '        <p>Users</p>' +
                            '        <span class="badge">'+array['USERS_COUNT']+'</span>' +
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/Categories.php\')" class="quick-button metro red span4">' +
                            '        <i class="icon-tasks"></i>' +
                            '        <p>Active Categories</p>' +
                            '        <span class="badge">'+array['CATEGORIES_COUNT'] + ' / ' + array['ALL_CATEGORIES_COUNT']+'</span>'+
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/Products.php\')" class="quick-button metro green span4">' +
                            '        <i class="icon-gift"></i>' +
                            '        <p>Products</p>' +
                            '        <span class="badge">'+array['PRODUCTS_COUNT']+'</span>' +
                            '    </a>' +
                            '    <div class="clearfix"></div>'
                        );

                        $('#row2').html(
                            '<a onclick="$(\'#content\').load(\'Pages/PendingOrders.php\')" class="quick-button metro blue span3">' +
                            '        <i class="icon-envelope"></i>' +
                            '        <p>Pending Orders</p>' +
                            '        <span class="badge">'+array['PEND_ORDERS_COUNT']+'</span>' +
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/QueuedOrders.php\')" class="quick-button metro orange span3">' +
                            '        <i class="icon-envelope-alt"></i>' +
                            '        <p>Queued Orders</p>' +
                            '        <span class="badge">'+array['QUEUE_ORDERS_COUNT']+'</span>' +
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/ShippedOrders.php\')" class="quick-button metro black span3">' +
                            '        <i class="icon-truck"></i>' +
                            '        <p>Shipped Orders</p>' +
                            '        <span class="badge">'+array['SHIP_ORDERS_COUNT']+'</span>' +
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/DeliveredOrders.php\')" class="quick-button metro purple span3">' +
                            '        <i class="icon-shopping-cart"></i>' +
                            '        <p>Delivered Orders</p>' +
                            '        <span class="badge">'+array['DEL_ORDERS_COUNT']+'</span>' +
                            '    </a>' +
                            '' +
                            '    <div class="clearfix"></div>'
                        );
                        var month_total = '';
                        if(array['LAST_MONTHLY_INCOME'] && array['LAST_2_MONTHLY_INCOME']  === "0.00"){
                            month_total = numberWithCommas(array['LAST_MONTHLY_INCOME'])+' <i class=\'icon-minus\'></i>';
                        }
                        else if(array['LAST_MONTHLY_INCOME'] >= array['LAST_2_MONTHLY_INCOME']){
                            month_total = numberWithCommas(array['LAST_MONTHLY_INCOME'])+' <i class=\'icon-arrow-up\'></i>';
                        }
                        else if(array['LAST_MONTHLY_INCOME'] < array['LAST_2_MONTHLY_INCOME']){
                            month_total = numberWithCommas(array['LAST_MONTHLY_INCOME'])+' <i class=\'icon-arrow-down\'></i>';
                        }
                        $('#row3').html(
                            '<div class="span4 statbox green" ontablet="span8" ondesktop="span4">' +
                            '        <div class="number">'+numberWithCommas(array['TOTAL_INCOME'])+' <i class=\'icon-minus\'></i></div>' +
                            '        <div class="title">Total Income</div>' +
                            '    </div>'+
                            '<div class="span4 statbox blueDark" ontablet="span8" ondesktop="span4">' +
                            '        <div class="number">'+month_total+'</div>' +
                            '        <div class="title">['+array['LAST_MONTH']+'] Income</div>' +
                            '    </div>'+
                            '<div class="span4 statbox greenDark" ontablet="span8" ondesktop="span4">' +
                            '        <div class="number">'+numberWithCommas(array['CURRENT_MONTHLY_INCOME'])+' <i class=\'icon-minus\'></i></div>' +
                            '        <div class="title">Current Month Income</div>' +
                            '    </div>'
                        );

                        $('#row4').html(
                            '<div class="widget blue span6" ontablet="span6" ondesktop="span6">' +
                            '        <h2><span class="glyphicons charts"><i></i></span>2 Months Delivered Orders Stats</h2>' +
                            '        <hr>' +
                            '        <div class="content">' +
                            '            <div class="verticalChart">' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W1_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W1_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W1</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W2_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W2_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W2</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W3_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W3_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W3</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W4_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W4_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W4</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W5_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W5_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W5</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W6_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W6_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W6</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W7_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W7_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W7</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W8_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W8_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W8</div>' +
                            '                </div>' +
                            '                <div class="clearfix"></div>' +
                            '            </div>' +
                            '        </div>' +
                            '    </div>'
                        );
                    }
                }
            });
        setInterval(function(){
            $.ajax({
                type:'GET',
                url: 'Handlers/UpdateDashboard.php',
                success: function(data){
                    var array = $.parseJSON(data);
                    if(array !== '') {
                        $('#row1').html(
                            '<a class="quick-button metro yellow span4">' +
                            '        <i class="icon-group"></i>' +
                            '        <p>Users</p>' +
                            '        <span class="badge">' + array['USERS_COUNT'] + '</span>' +
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/Categories.php\')" class="quick-button metro red span4">' +
                            '        <i class="icon-tasks"></i>' +
                            '        <p>Active Categories</p>' +
                            '        <span class="badge">' + array['CATEGORIES_COUNT'] + ' / ' + array['ALL_CATEGORIES_COUNT'] + '</span>' +
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/Products.php\')" class="quick-button metro green span4">' +
                            '        <i class="icon-gift"></i>' +
                            '        <p>Products</p>' +
                            '        <span class="badge">' + array['PRODUCTS_COUNT'] + '</span>' +
                            '    </a>' +
                            '    <div class="clearfix"></div>'
                        );

                        $('#row2').html(
                            '<a onclick="$(\'#content\').load(\'Pages/PendingOrders.php\')" class="quick-button metro blue span3">' +
                            '        <i class="icon-envelope"></i>' +
                            '        <p>Pending Orders</p>' +
                            '        <span class="badge">'+array['PEND_ORDERS_COUNT']+'</span>' +
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/QueuedOrders.php\')" class="quick-button metro orange span3">' +
                            '        <i class="icon-envelope-alt"></i>' +
                            '        <p>Queued Orders</p>' +
                            '        <span class="badge">'+array['QUEUE_ORDERS_COUNT']+'</span>' +
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/ShippedOrders.php\')" class="quick-button metro black span3">' +
                            '        <i class="icon-truck"></i>' +
                            '        <p>Shipped Orders</p>' +
                            '        <span class="badge">'+array['SHIP_ORDERS_COUNT']+'</span>' +
                            '    </a>' +
                            '    <a onclick="$(\'#content\').load(\'Pages/DeliveredOrders.php\')" class="quick-button metro purple span3">' +
                            '        <i class="icon-shopping-cart"></i>' +
                            '        <p>Delivered Orders</p>' +
                            '        <span class="badge">'+array['DEL_ORDERS_COUNT']+'</span>' +
                            '    </a>' +
                            '' +
                            '    <div class="clearfix"></div>'
                        );
                        var month_total = '';
                        if(array['LAST_MONTHLY_INCOME'] && array['LAST_2_MONTHLY_INCOME']  === "0.00"){
                            month_total = numberWithCommas(array['LAST_MONTHLY_INCOME'])+' <i class=\'icon-minus\'></i>';
                        }
                        else if(array['LAST_MONTHLY_INCOME'] >= array['LAST_2_MONTHLY_INCOME']){
                            month_total = numberWithCommas(array['LAST_MONTHLY_INCOME'])+' <i class=\'icon-arrow-up\'></i>';
                        }
                        else if(array['LAST_MONTHLY_INCOME'] < array['LAST_2_MONTHLY_INCOME']){
                            month_total = numberWithCommas(array['LAST_MONTHLY_INCOME'])+' <i class=\'icon-arrow-down\'></i>';
                        }
                        $('#row3').html(
                            '<div class="span4 statbox green" ontablet="span8" ondesktop="span4">' +
                            '        <div class="number">'+numberWithCommas(array['TOTAL_INCOME'])+' <i class=\'icon-minus\'></i></div>' +
                            '        <div class="title">Total Income</div>' +
                            '    </div>'+
                            '<div class="span4 statbox blueDark" ontablet="span8" ondesktop="span4">' +
                            '        <div class="number">'+month_total+'</div>' +
                            '        <div class="title">['+array['LAST_MONTH']+'] Income</div>' +
                            '    </div>'+
                            '<div class="span4 statbox greenDark" ontablet="span8" ondesktop="span4">' +
                            '        <div class="number">'+numberWithCommas(array['CURRENT_MONTHLY_INCOME'])+' <i class=\'icon-minus\'></i></div>' +
                            '        <div class="title">Current Month Income</div>' +
                            '    </div>'
                        );

                        $('#row4').html(
                            '<div class="widget blue span6" ontablet="span6" ondesktop="span6">' +
                            '        <h2><span class="glyphicons charts"><i></i></span>2 Months Delivered Orders Stats</h2>' +
                            '        <hr>' +
                            '        <div class="content">' +
                            '            <div class="verticalChart">' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W1_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W1_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W1</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W2_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W2_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W2</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W3_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W3_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W3</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W4_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W4_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W4</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W5_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W5_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W5</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W6_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W6_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W6</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W7_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W7_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W7</div>' +
                            '                </div>' +
                            '                <div class="singleBar">' +
                            '                    <div class="bar">' +
                            '                        <div class="value" style="height: '+array['DEL_ORDERS_W8_COUNT']+'%;">' +
                            '                            <span style="color: rgb(87, 142, 190); display: inline;">'+array['DEL_ORDERS_W8_COUNT']+'</span>' +
                            '                        </div>' +
                            '                    </div>' +
                            '                    <div class="title">W8</div>' +
                            '                </div>' +
                            '                <div class="clearfix"></div>' +
                            '            </div>' +
                            '        </div>' +
                            '    </div>'
                        );
                    }
                }
            });
        },10000);

    });
</script>


<div id="row1" class="row-fluid">

</div>
<br/>
<div id="row2" class="row-fluid">

</div>
<br/>
<div id="row3" class="row-fluid">

</div>
<div id="row4" class="row-fluid">

</div>
