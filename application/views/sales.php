<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Flower Shop</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		@media print {
			.form, .print, img {
				display: none
			}
		}
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<div class="container">
	<div class="row wrapper">
		<div class="col-md-12 form">
			<legend><h1>Sales Report</h1></legend>
			<div class="form-group">
				<input type="month" class="sales-date form-control" value="<?php echo date("Y-m"); ?>"/>
			</div>
			<div class="btn-group pull-right ">
				<button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
					<i class="glyphicon glyphicon-stats"></i> Generate <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li class="generator" data-action="0"><a href="javascript:;">Generate by year</a></li>
					<li class="generator" data-action="1"><a href="javascript:;">Generate by year & month</a></li>
				</ul>
			</div>
            <br /><br />
            <br /><br />
		</div>
		<div class="col-md-12 generated-report-interface">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Order #</th>
						<th>Product</th>
						<th>Category</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Delivery Fee</th>
						<th>Order Date</th>
					</tr>
				</thead>
				
				<tbody>
					<?php 
					$delivery = 0;
					$price = 0;
					$total = 0;
					foreach($flower as $flw) { ?>
					<tr>
						<td><?php echo $flw->order_id; ?></td>
						<td><?php echo $flw->flower_name; ?></td>
						<td><?php echo $flw->category_name; ?></td>
						<td>₱ <?php echo number_format($flw->flower_price, 2); ?></td>
						<td><?php echo number_format($flw->quantity); ?></td>
						<td>₱ <?php echo number_format($flw->delivery_fee, 2); ?></td>
						<td><?php echo date("F m, Y", strtotime($flw->order_date)); ?></td>
					</tr>
					<?php
						$delivery += $flw->delivery_fee;
						$price += $flw->flower_price;
						$total += $flw->flower_price * $flw->quantity;
						}
					?>
				</tbody>
			</table>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Total Delivery</th>
						<th>Total Price</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>₱ <?php echo number_format($delivery,2); ?></td>
						<td>₱ <?php echo number_format($price,2); ?></td>
						<td>₱ <?php echo number_format($total, 2); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<button class="print btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-print"></i> Print</button>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>
