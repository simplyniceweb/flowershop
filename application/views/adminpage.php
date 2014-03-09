<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Flower Shop</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		.bdg { margin-right: 2px }
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<div class="container">
	<div class="row">
    <ol class="breadcrumb">
      <li class="active"><?php echo ucfirst($this->uri->segment(1)); ?></li>
    </ol>
    	<div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Maintenance</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                      <li class="list-group-item">
                        <a href="admin/category">Category</a>
                      </li>
                      <li class="list-group-item">
                        <a href="addons">Add-ons</a>
                      </li>
                      <li class="list-group-item">
                        <a href="admin/payment">Type of Payment</a>
                      </li>
                      <li class="list-group-item">
                        <a href="admin/product">Add Product</a>
                      </li>
                      <li class="list-group-item">
                        <a href="admin/package">Add Package</a>
                      </li>
                      <li class="list-group-item">
                        <a href="advertise">Advertisement</a>
                      </li>
                      <li class="list-group-item">
                        <a href="delivery">Location / Delivery Fee</a>
                      </li>
                    </ul>
                </div>
            </div>
		</div>
        
    	<div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Monitoring</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                      <li class="list-group-item">
                        <a href="admin/orders">Orders 
<span class="bdg badge pull-right" data-toggle="tooltip" data-placement="right" title="Cancelled Order"><?php echo $not_cancel; ?></span>
<span class="bdg badge pull-right" data-toggle="tooltip" data-placement="bottom" title="Re-scheduled Order"><?php echo $not_sched; ?></span>
<span class="bdg badge pull-right" data-toggle="tooltip" data-placement="top" title="New Order"><?php echo $not_order; ?></span>
                        </a>
                      </li>
                      <li class="list-group-item">
                        <a href="orders/ticket">List of Payment 
<span class="bdg badge pull-right" data-toggle="tooltip" data-placement="right" title="New Payment"><?php echo $not_payment; ?></span></a>
                      </li>
                      <li class="list-group-item">
                        <a href="admin/history">Login History</a>
                      </li>
                      <li class="list-group-item">
                        <a href="message">Messages 
<span class="bdg badge pull-right" data-toggle="tooltip" data-placement="right" title="New Message"><?php echo $not_msg; ?></span></a>
                      </li>
                    </ul>
                </div>
            </div>
		</div>
        
        
    	<div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Reports</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                      <li class="list-group-item">
                        <a href="sales">Sales Report</a>
                      </li>
                    </ul>
                </div>
            </div>
		</div>
	</div>
    
    <div class="row">
    	<div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Users Maintenance</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                      <li class="list-group-item">
                        <a href="admin/users">View / Modify account</a>
                      </li>
                      <li class="list-group-item">
                        <a href="register">Add user</a>
                      </li>
                    </ul>
                </div>
            </div>
		</div>
    </div>
    
    
</div>

<?php require_once('includes/footer.php'); ?>
<script>
	$('.bdg').tooltip();
</script>
</body>
</html>
