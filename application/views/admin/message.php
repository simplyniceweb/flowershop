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
        <p><h3>Messages</h3></p>
        <a href="message/contact"><button class="btn btn-primary btn-sm pull-right">New message</button></a>
        <br /><br />
		<?php if(isset($_GET['del']) && $_GET['del'] == "true"): ?>
        <div class="alert alert-success">
            <small>Message has been deleted successfully!</small>
        </div>
		<?php endif; ?>
    	<table class="table table-bordered table-hover">
        	<thead>
            	<tr>
                <th>Sender</th>
            	<th>Subject</th>
                <th>Message Date</th>
                <th>Actions</th>
                </tr>
            </thead>
            
            <tbody class="append_orders">
            <?php foreach($messages as $msg) { ?>
            <tr>
            	<td><?php echo $msg->user_name; ?></td>
            	<td><?php echo $msg->message_title; ?></td>
                <td><?php echo date("F d, Y", strtotime($msg->date_created)); ?></td>
                <td>
                	<a href="message/view/<?php echo $msg->main_id; ?>">
                    <button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button>
                    </a>
                    <?php if(isset($session)) if($session['user_level'] == 1) { ?>
                    <a href="message/delete/<?php echo $msg->main_id; ?>">
                    <button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-remove"></i> Delete</button>
                    </a>
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
