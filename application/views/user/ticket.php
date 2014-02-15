<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Flower Shop</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
</head>
<body>
<?php include(__DIR__ . "/../includes/header.php"); ?>
<div class="container">
    <div class="row divider">
    	<div class="col-md-12">
        <legend>Users</legend>
    	<table class="table table-bordered table-hover">
        	<thead>
            	<tr>
            	<th>Details</th>
                <th>Proof</th>
                <th>Re-Schedule</th>
                <th>View Details</th>
                <th>View Billing</th>
                <th>Payment Status</th>
                </tr>
            </thead>
            
            <tbody class="append_orders">
            <?php foreach($flower as $flw) { ?>
            <tr>
                <td><?php echo $flw->ticket_details; ?></td>
                <td><a href="assets/ticket/<?php echo $flw->ticket_proof; ?>" target="_blank">Proof of ticket ( Click to view or download )</a></td>
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
                    <select class="form-control payment-status" data-entry-id="<?php echo $flw->order_id; ?>" data-status="<?php echo $flw->payment_status; ?>">
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