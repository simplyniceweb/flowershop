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
		/* Modified */
		.thumbnail > img { width: 250px !important; height: 200px !important}
	</style>
</head>
<body>
<?php require_once('/../includes/header.php'); ?>
<div class="container">
    <div class="row divider">
    	<div class="col-md-12">
        <legend>Cart</legend>
    	<table class="table table-bordered table-hover">
        	<thead>
            	<tr>
            	<th>Flower Name</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Remove to cart</th>
                <th>Order now</th>
                </tr>
            </thead>
            
            <tbody>
            <tr>
            <?php foreach($flower as $flw) { ?>
            	<td><?php echo $flw->flower_name; ?></td>
                <td>Php <?php echo number_format($flw->flower_price, 2); ?></td>
                <td><?php echo number_format($flw->flower_availability); ?></td>
                <td>
                <button type="submit" class="remove-flower btn btn-xs btn-default" data-entry-id="<?php echo $flw->flower_id; ?>">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Remove to Cart
				</button>
                </td>
                <td>
                <button type="submit" class="btn btn-xs btn-default">
                    <span class="glyphicon glyphicon-credit-card"></span> 
                    <a href="cart/order/<?php echo $flw->flower_id; ?>">Order Now</a>
				</button>
                </td>
            <?php } ?>
            </tr>
           	</tbody>
        </table>
        </div>
    </div>
</div>

<?php require_once('/../includes/footer.php'); ?>
</body>
</html>