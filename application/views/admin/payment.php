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
	<div class="row">
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->uri->segment(1); ?>"><?php echo ucfirst($this->uri->segment(1)); ?></a></li>
      <li class="active"><?php echo ucfirst($this->uri->segment(2)); ?></li>
    </ol>
    	<div class="col-md-4 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-briefcase"></i> New Payment</h3>
                </div>
                <div class="panel-body">
				<?php if(isset($_GET['add']) && $_GET['add'] == "true"): ?>
                <div class="alert alert-success">
                    <small>New payment has been added.</small>
                </div>
                <?php endif; ?>
                <?php echo form_open("admin/new_payment"); ?>
                    <div class="form-group">
                    	<label for="new_payment"><small>Payment Type</small></label>
                        <input type="text" id="new_payment" class="form-control" name="new_payment" required="required">
                    </div>
                    <button type="submit" class="pull-right btn btn-success">Save</button>
                <?php echo form_close(); ?>
                </div>
            </div>
		</div>
        
    	<div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-remove-circle"></i> Delete Payment</h3>
                </div>
                <div class="panel-body">
					<?php if(isset($_GET['del']) && $_GET['del'] == "true"): ?>
                    <div class="alert alert-danger">
                        <small>Payment has been deleted.</small>
                    </div>
                    <?php endif; ?>
                    
                	<?php
                    	if($payment->num_rows > 0) {
							echo form_open("admin/archive_payment");
					?>
                        <div class="form-group">
                            <label for="payment_list"><small>List of payment</small></label>
                            <select id="payment_list" class="form-control" name="payment">
                                <?php foreach($payment->result() as $row) { ?>
                                    <option value="<?php echo $row->payment_id; ?>"><?php echo $row->payment_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="pull-right btn btn-danger">Delete</button>
                    <?php 
							echo form_close(); 
						} else {
					?>
                    <div class="alert alert-info">
                        <small>No payment yet.</small>
                    </div>
                    <?php } ?>
                </div>
            </div>
		</div>
        
	</div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
</body>
</html>
