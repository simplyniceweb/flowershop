<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Message</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
</head>
<body>
<?php include(__DIR__ . "/../includes/header.php"); ?>

<div class="container">
	<div class="row">

		<?php if(isset($_GET['msg']) && $_GET['msg'] == "sent"): ?>
        <div class="alert alert-success">
            <small>Message sent. We will get back to you after 24 hours. Thank you!</small>
        </div>
		<?php endif; ?>

		<?php echo form_open('message/process'); ?>
        <div class="form-group">
        	<label><small>Subject</small></label>
        	<input type="text" class="form-control" name="subject" autofocus />
		</div>
        <div class="form-group">
        	<label><small>Message</small></label>
        	<textarea class="form-control" name="message"></textarea>
		</div>
        <div class="form-group">
        	<button class="btn btn-sm btn-primary">Send</button>
        </div>
        <?php echo form_close(); ?>
	</div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
</body>
</html>
