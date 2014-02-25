<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Flower Shop</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		.divider { margin-top: 15px; }
		.wrapper { border-radius: 3px; background: #FFF; border: 1px solid #CCC; }
		.box { padding: 5px }
		.flower-title { margin-left: 20px }
		.footer { height: 50px }
		.gallery ul li { list-style-type: none; float: left; }
		.gallery img { width: 150px; height: 150px }
		.specific-delete { cursor: pointer }
		.caption { background: #f1f1f1; }
	</style>
</head>
<body>
<?php include(__DIR__ . "/../includes/header.php"); ?>
<div class="container">
    <div class="row divider">
    	<div class="col-md-12">
        <legend>Orders</legend>
        <div class="form-group">
        	<label><small>Order Month and Year</small></label>
        	<input type="month" class="form-control by_date" value="<?php echo date("Y-m"); ?>">
        </div>
        <div class="form-group">
        	<label><small>Flower Category</small></label>
        	<select class="form-control flower_category">
            	<option value="empty">Select flower category</option>
            	<option selected value="1">Product</option>
            	<option value="2">Package</option>
            </select>
        </div>
        <div class="form-group">
        	<label><small>Type of order</small></label>
        	<select class="form-control append-orders" data-action="1">
            	<option value="empty">Select type of orders</option>
            	<option value="0">Cancelled Orders</option>
                <option selected value="1">Pending Orders</option>
                <option value="2">On delivery</option>
                <option value="3">Delivered</option>
                <option value="4">Processing</option>
            </select>
        </div>
    	<table class="table table-bordered table-hover">
        	<thead>
            	<tr>
            	<th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Cancel Order</th>
                <th>Re-schedule Order</th>
                <th>View details</th>
                <th>Billing</th>
                <th>Order Status</th>
                <th>Payment Status</th>
                </tr>
            </thead>
            
            <tbody class="append_orders">
            <?php foreach($flower as $flw) { ?>
            <tr>
            	<td><?php echo ucfirst($flw->flower_name); ?></td>
                <td><?php echo ucfirst($flw->category_name); ?></td>
                <td>Php <?php echo number_format($flw->flower_price, 2); ?></td>
                <td>
                <button type="submit" class="cancel-flower btn btn-xs btn-default" data-entry-id="<?php echo $flw->flower_id; ?>">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancel Order
				</button>
                </td>
                <td>
                <button type="submit" class="btn btn-xs btn-default">
                    <span class="glyphicon glyphicon-credit-card"></span> 
                    <a href="orders/order/<?php echo $flw->flower_id; ?>/1">Re-schedule Order</a>
				</button>
                </td>
                <td>
                <button type="submit" class="view-details btn btn-xs btn-default" data-flower-id="<?php echo $flw->flower_id; ?>" data-order-id="<?php echo $flw->order_id; ?>" data-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-new-window"></span> 
                    <a href="javascript:void(0)">View Details</a>
				</button>
                </td>
                <td>
                <button type="submit" class="view-billing btn btn-xs btn-default" data-flower-id="<?php echo $flw->flower_id; ?>" data-order-id="<?php echo $flw->order_id; ?>" data-toggle="modal" data-target="#billing">
                    <span class="glyphicon glyphicon-usd"></span> 
                    <a href="javascript:void(0)">View Billing</a>
				</button>
                </td>
                <td>
                	<select class="form-control order-status" data-entry-id="<?php echo $flw->order_id; ?>" data-status="<?php echo $flw->order_status; ?>">
                        <option selected value="1">Pending</option>
                        <option value="2">On Delivery</option>
                        <option value="3">Delivered</option>
                        <option value="4">Processing</option>
                    </select>
                </td>
                <td>
                    <select class="form-control payment-status" data-entry-id="<?php echo $flw->order_id; ?>" data-status="<?php echo $flw->payment_status; ?>">
                    	<option <?php if($flw->payment_status == 2){ ?>selected<?php } ?> value="2">Downpayment</option>
                        <option <?php if($flw->payment_status == 1){ ?>selected<?php } ?> value="1">Paid</option>
                        <option <?php if($flw->payment_status == 0){ ?>selected<?php } ?> value="0">Unpaid</option>
                    </select>
                </td>
			</tr>
            <?php } ?>
           	</tbody>
        </table>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Order Details</h4>
      </div>
      <div class="modal-body">
        <p>Loading...</p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="billing">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Billing Statement</h4>
      </div>
      <div class="modal-body">
        <p>Loading...</p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include(__DIR__ . "/../includes/footer.php"); ?>
</body>
</html>
