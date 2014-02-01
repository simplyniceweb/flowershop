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
            	<th>Full Name</th>
                <th>Email Address</th>
                <th>Address</th>
                <th>Birthday</th>
                <th>Actions</th>
                </tr>
            </thead>
            
            <tbody class="append_orders">
            <?php foreach($user as $u) { ?>
            <tr>
            	<td><?php echo ucfirst($u->user_name); ?></td>
                <td><?php echo $u->user_email; ?></td>
                <td><?php echo $u->user_address; ?></td>
                <td><?php echo $u->user_birthday; ?></td>
                <td>
                <?php if($u->user_favorite == 0) { ?>
                <button class="favorite-user btn btn-xs btn-default" data-action="1" data-entry-id="<?php echo $u->user_id; ?>"><i class="glyphicon glyphicon-star-empty"></i> Priority</button>
                <?php } else { ?>
                <button class="favorite-user btn btn-xs btn-success" data-action="0" data-entry-id="<?php echo $u->user_id; ?>"><i class="glyphicon glyphicon-star"></i> Priority</button>
                <?php } ?>
                <?php if($u->user_status == 0) { ?>
                <button class="delete-user btn btn-xs btn-default" data-action="1" data-entry-id="<?php echo $u->user_id; ?>"><i class="glyphicon glyphicon-trash"></i> <span class="del">Delete</span></button>
                <?php } else { ?>
                <button class="delete-user btn btn-xs btn-danger" data-action="0" data-entry-id="<?php echo $u->user_id; ?>"><i class="glyphicon glyphicon-trash"></i> <span class="del">Undelete</span></button>
				<?php } ?>
                </td>
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
