<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Flower Shop</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
</head>
<body>
<?php require_once('/../includes/header.php'); ?>
<div class="container">
	<div class="row">
    
    	<div class="col-md-4 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-briefcase"></i> New Category</h3>
                </div>
                <div class="panel-body">
				<?php if(isset($_GET['add']) && $_GET['add'] == "true"): ?>
                <div class="alert alert-success">
                    <small>New category has been added.</small>
                </div>
                <?php endif; ?>
                <?php echo form_open("admin/new_category"); ?>
                    <div class="form-group">
                    	<label for="new_category"><small>Category Name</small></label>
                        <input type="text" id="new_category" class="form-control" name="new_category" required="required">
                    </div>
                    <button type="submit" class="pull-right btn btn-success">Save</button>
                <?php echo form_close(); ?>
                </div>
            </div>
		</div>
        
    	<div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-remove-circle"></i> Delete Category</h3>
                </div>
                <div class="panel-body">
					<?php if(isset($_GET['del']) && $_GET['del'] == "true"): ?>
                    <div class="alert alert-danger">
                        <small>Category has been deleted.</small>
                    </div>
                    <?php endif; ?>
                    
                	<?php
                    	if($category->num_rows > 0) {
							echo form_open("admin/archive_category");
					?>
                        <div class="form-group">
                            <label for="category_list"><small>List of category</small></label>
                            <select id="category_list" class="form-control" name="category">
                                <?php foreach($category->result() as $row) { ?>
                                    <option value="<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="pull-right btn btn-danger">Delete</button>
                    <?php 
							echo form_close(); 
						} else {
					?>
                    <div class="alert alert-info">
                        <small>No category yet.</small>
                    </div>
                    <?php } ?>
                </div>
            </div>
		</div>
        
	</div>
</div>

<?php require_once('/../includes/footer.php'); ?>
</body>
</html>