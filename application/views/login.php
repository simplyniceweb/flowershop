<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-4 col-md-offset-4" style="margin-top: 150px">

		<?php if(isset($_GET['login']) && $_GET['login'] == "false"): ?>
        <div class="alert alert-danger">
            <small>Please provide the right credentials.</small>
        </div>
		<?php endif; ?>
		
		<?php if(isset($_GET['block']) && $_GET['block'] == "true"): ?>
        <div class="alert alert-danger">
            <small>An adminastrator blocked you from viewing this system.</small>
        </div>
		<?php endif; ?>
		
		<?php echo form_open('login/verify'); ?>
        <div class="form-group">
        	<label><small>Email Address</small></label>
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				<input type="email" name="user_email" class="form-control" required="required">
			</div>
        </div>
		<div class="form-group">
        	<label><small>Password</small></label>
			<div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" name="user_password" class="form-control" required="required">
			</div>
		</div>
		<a href="register">Don't have an account? Register!</a>
		<button class="btn btn-primary pull-right">Log In <i class="glyphicon glyphicon-log-in"></i></button>
		<?php echo form_close(); ?>
		</div>
	</div>

</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>
