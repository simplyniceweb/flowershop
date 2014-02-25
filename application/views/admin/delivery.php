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
    	<div class="col-md-12"><legend>Delivery Fee</legend></div>
        <div class="col-md-4">
        <?php echo form_open("delivery/add"); ?>
		<?php if(isset($_GET['add']) && $_GET['add'] == "true"): ?>
        <div class="alert alert-success">
            <small>Added successfully!</small>
        </div>
        <?php endif; ?>
        <div class="form-group">
        	<label for="location"><small>Location</small></label>
        	<input type="text" id="location" name="location" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="fee"><small>Delivery Fee</small></label>
            <input type="text" id="fee" name="fee" class="form-control" required />
        </div>
        <button class="btn btn-sm btn-success pull-right">Add location</button>
        <?php echo form_close(); ?>
        </div>

        <div class="col-md-4">
        <?php echo form_open("delivery/update"); ?>
		<?php if(isset($_GET['update']) && $_GET['update'] == "true"): ?>
        <div class="alert alert-success">
            <small>Updated successfully!</small>
        </div>
        <?php endif; ?>
        <div class="form-group">
        	<label for="location"><small>Location</small></label>
        	<select id="location" name="location" class="form-control"required >
            <?php foreach($fee as $fe) { ?>
            	<option value="<?php echo $fe->id; ?>"><?php echo $fe->location; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group">
        	<label for="new_location"><small>New Location</small></label>
        	<input type="text" id="new_location" name="new_location" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="fee"><small>New Delivery Fee</small></label>
            <input type="text" id="fee" name="fee" class="form-control" required />
        </div>
        <button class="btn btn-sm btn-info pull-right">Update</button>
        <?php echo form_close(); ?>
        </div>

        <div class="col-md-4">
        <?php echo form_open("delivery/delete"); ?>
		<?php if(isset($_GET['delete']) && $_GET['delete'] == "true"): ?>
        <div class="alert alert-success">
            <small>Deleted successfully!</small>
        </div>
        <?php endif; ?>
        <div class="form-group">
        	<label for="location"><small>Location</small></label>
        	<select id="location" name="location" class="form-control"required >
            <?php foreach($fee as $fe) { ?>
            	<option value="<?php echo $fe->id; ?>"><?php echo $fe->location; ?></option>
            <?php } ?>
            </select>
        </div>
        <button class="btn btn-sm btn-danger pull-right">Delete</button>
        <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php include(__DIR__ . "/../includes/footer.php"); ?>
<script>
$(document).ready(function(){
    $("input[name=fee]").keydown(function (e) {
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
