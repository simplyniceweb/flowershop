<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Location</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
</head>
<body>
<?php include(__DIR__ . "/../includes/header.php"); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
        	<iframe height="700" class="col-md-12" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msa=0&amp;msid=215556998466327430384.0004c9d1d0ffcb32a32b1&amp;ie=UTF8&amp;t=m&amp;iwloc=0004c9d20de3c4299ca17&amp;ll=14.566048,121.012688&amp;spn=0,0&amp;output=embed"></iframe>
        </div>
	</div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
</body>
</html>
