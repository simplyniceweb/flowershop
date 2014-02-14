<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Flower Shop</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
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
                      <!--
                      <li class="list-group-item">
                        <a href="admin/payment">Type of Payment</a>
                      </li>
                      -->
                      <li class="list-group-item">
                        <a href="admin/product">Add Product</a>
                      </li>
                      <li class="list-group-item">
                        <a href="admin/package">Add Package</a>
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
                        <a href="admin/orders">Orders</a>
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
                        <a href="admin/users">Modify account</a>
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
</body>
</html>
