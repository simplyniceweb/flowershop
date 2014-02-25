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
                <th>Order count</th>
                </tr>
            </thead>
            
            <tbody class="append_orders">
            <?php foreach($user as $u) { ?>
            <tr>
            	<td><?php echo ucfirst($u->user_name); ?></td>
                <td><?php echo $u->user_email; ?></td>
                <td><?php echo $u->user_address; ?></td>
                <td><?php if($u->user_birthday != "0000-00-00") echo date("F d, Y", strtotime($u->user_birthday)); ?></td>
                <td>
                <?php if($u->user_favorite == 0) { ?>
                <button class="favorite-user btn btn-xs btn-default" data-action="1" data-entry-id="<?php echo $u->user_id; ?>"><i class="glyphicon glyphicon-star"></i> Priority</button>
                <?php } else { ?>
                <button class="favorite-user btn btn-xs btn-success" data-action="0" data-entry-id="<?php echo $u->user_id; ?>"><i class="glyphicon glyphicon-star"></i> Priority</button>
                <?php } ?>
                <?php if($u->user_status == 0) { ?>
                <button class="delete-user btn btn-xs btn-default" data-action="1" data-entry-id="<?php echo $u->user_id; ?>"><i class="glyphicon glyphicon-trash"></i> <span class="del">Delete</span></button>
                <?php } else { ?>
                <button class="delete-user btn btn-xs btn-danger" data-action="0" data-entry-id="<?php echo $u->user_id; ?>"><i class="glyphicon glyphicon-trash"></i> <span class="del">Undelete</span></button>
				<?php } ?>
				<a href="settings/<?php echo $u->user_id; ?>"><button class="btn btn-xs btn-default"><i class="glyphicon glyphicon-wrench"></i> Edit</button></a>
                </td>
                <td>
                	<?php 
						$this->db->where("user_id", $u->user_id);
						$count = $this->db->get('orders');
						echo $count->num_rows();
					?>
                </td>
			</tr>
            <?php } ?>
           	</tbody>
        </table>
        <ul class="pagination">
        <?php echo $pagination; ?>
        </ul>
        </div>
    </div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
<script>
	$(document).ready(function(){
		$( "ul.pagination > a" ).each(function(){
			$( this ).wrap( "<li></li>" );
		})
	})
</script>
</body>
</html>
