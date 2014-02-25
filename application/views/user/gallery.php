<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>About</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		img { width: 200px; height: 200px; margin:3px; }
	</style>
</head>
<body>
<?php include(__DIR__ . "/../includes/header.php"); ?>

<div class="container">
	<div class="row">
    <?php if(isset($session)) if($session['user_level'] == 1){ ?>
		<div class="col-md-12">
			<div class="btn-group">
			  <a href="<?php echo base_url(); ?>admin/product" class="btn btn-default">Add Product</a>
			  <a href="<?php echo base_url(); ?>admin/package" class="btn btn-default">Add Package</a>
			</div>
		</div>
	<?php } ?>
		<div class="col-md-12">
        <?php foreach($flower as $flw) { ?>
        	<a href="view/<?php echo $flw->flower_id; ?>" target="_blank">
            <img src="assets/flower/<?php echo $flw->flower_img_name; ?>" alt="<?php echo $flw->flower_name; ?>" class="img-thumbnail" data-toggle="tooltip" data-placement="top" title="<?php echo $flw->flower_name; ?>" data-original-title="<?php echo $flw->flower_name; ?>">
        	</a>
		<?php } ?>
        </div>
	</div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
</body>
</html>
