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
    	<div class="col-md-12"><legend>Add-ons</legend></div>
		<?php if(isset($_GET['add']) && $_GET['add'] == "true"): ?>
        <div class="alert alert-success">
            <small>Add-ons has been added successfully.</small>
        </div>
        <?php endif; ?>
        <?php echo form_open_multipart("addons/add"); ?>
        	<div class="form-group">
            	<label for="item_name"><small>Item Name</small></label>
                <input type="text" id="item_name" name="item_name" class="form-control" value=""/>
            </div>
        	<div class="form-group">
            	<label for="item_price"><small>Price</small></label>
                <input type="text" id="item_price" name="item_price" class="form-control" value=""/>
            </div>
        	<div class="form-group">
            	<label for="item_image"><small>Image</small></label>
                <input type="file" id="item_image" name="item_image[]" class="form-control" value=""/>
            </div>
            <div class="form-group">
            	<button class="btn btn-sm btn-primary pull-right">Submit</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php include(__DIR__ . "/../includes/footer.php"); ?>
<script>
$(document).ready(function(){
    $("#item_price").keydown(function (e) {
		isNumeric(e);
    });
	
	function isNumeric(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
	}
})
</script>
</body>
</html>
