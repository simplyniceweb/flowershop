<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Message</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		.footer { height: 150px }
		p.name { color: #619def; }
	</style>
</head>
<body>
<?php include(__DIR__ . "/../includes/header.php"); ?>

<div class="container">
	<div class="row">
    
    <div class="col-md-12">
        <div class="panel panel-primary">
        <?php foreach($messages as $msg) { ?>
          <div class="panel-heading"><h3 class="panel-title"><?php echo $msg->message_title; ?> <i class="glyphicon glyphicon-comment pull-right"></i></h3></div>
          <div class="panel-body">
            <ul class="list-group">
            <?php foreach($record as $rec) { ?>
              <li class="list-group-item">
              <p class="name"><?php echo $rec->user_name; ?> 
              <span class="pull-right"><?php echo date("F d, Y h:i:s A", strtotime($rec->message_datetime)); ?></span>
              </p>
              <hr />
			  <?php echo ucfirst(nl2br(htmlspecialchars($rec->message))); ?>
              </li>
            <?php } ?>
            </ul>
          </div>
        <?php } ?>
        </div>
        <div class="col-md-12">
        <?php echo form_open("message/reply"); ?>
        	<div class="form-group">
            	<textarea class="form-control" name="reply" placeholder="Write a reply..."></textarea>
            </div>
            <div class="form-group">
            	<input type="hidden" name="message_id" value="<?php echo $msg->main_id; ?>" />
            	<button class="btn btn-sm btn-primary pull-right">Reply</button>
            </div>
		<?php echo form_close(); ?>
        </div>
    </div>

	<div class="footer"></div>
	</div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
</body>
</html>
