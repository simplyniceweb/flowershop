<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>About</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		.col-md-12 img { width: 200px; height: 200px; margin:3px; }
		.modal-body img { width: 100%; height: 100%; }
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
        <?php foreach($gallery as $gall) { ?>
        	<a href="javascript:;" target="_blank">
            <img src="assets/flower/<?php echo $gall->image; ?>" alt="<?php echo $gall->image; ?>" class="img-thumbnail img-modal"  data-toggle="modal" data-target="#myModal">
        	</a>
		<?php } ?>
        </div>
	</div>
</div>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <br />
      </div>
      <div class="modal-body">
        <img src="" />
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php include(__DIR__ . "/../includes/footer.php"); ?>
</body>
</html>
