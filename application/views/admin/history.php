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
        <legend>Login History</legend>
    	<table class="table table-bordered table-hover">
        	<thead>
            	<tr>
            	<th>Full Name</th>
                <th>Email</th>
                <th>Login Date / Time</th>
                </tr>
            </thead>
            
            <tbody class="append_orders">
            <?php foreach($history as $hs) { ?>
            <tr>
            	<td><?php echo $hs->user_name; ?></td>
                <td><?php echo $hs->user_email; ?></td>
                <td><?php echo date("F d, Y ( h:i A )", strtotime($hs->login_datetime)); ?></td>
			</tr>
            <?php } ?>
           	</tbody>
        </table>
        </div>
    </div>
</div>
<?php include(__DIR__ . "/../includes/footer.php"); ?>
</body>
</html>
