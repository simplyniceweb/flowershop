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
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->uri->segment(1); ?>"><?php echo ucfirst($this->uri->segment(1)); ?></a></li>
      <li class="active"><?php echo ucfirst($this->uri->segment(2)); ?></li>
    </ol>
    	<div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-body">
				<?php if(isset($_GET['add']) && $_GET['add'] == "true"): ?>
                <div class="alert alert-success">
                    <small>New <?php echo $this->uri->segment(2); ?> has been added.</small>
                </div>
                <?php endif; ?>
                <?php echo form_open_multipart("admin/new_product"); ?>
                    <div class="form-group">
                        <label for="category_list"><small>Category</small></label>
                        <select id="category_list" class="form-control" name="category" required="required">
                            <?php foreach($category->result() as $row) { ?>
                                <option value="<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                    	<label for="flower_name"><small>Flower Name</small></label>
                        <input type="text" id="flower_name" class="form-control" name="flower_name" required="required">
                    </div>
                    
                    <div class="form-group">
                    	<label for="flower_description"><small>Flower Description</small></label>
                        <textarea id="flower_description" class="form-control" name="flower_description" required="required"></textarea>
                    </div>
                    
                    <div class="form-group">
                    	<label for="flower_price"><small>Flower Price</small></label>
                        <input type="text" id="flower_price" class="form-control" name="flower_price" required="required">
                    </div>
                    
                    <div class="form-group">
                    	<label for="flower_availability"><small>Availabilty</small></label>
                        <input type="text" id="flower_availability" class="form-control" name="flower_availability" required="required">
                    </div>
                    
                    <div class="form-group">
                    	<label for="flower_images"><small>Upload images</small></label>
                        <input type="file" id="flower_images" class="form-control" name="flower_images[]" multiple required="required">
                    </div>
                    
                    <div class="form-group">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" name="flower_type" value="1" id="option1"> Featured
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="flower_type" value-"2" id="option2"> Promo
                      </label>
                    </div>
                    </div>

                    <input type="hidden" name="flower_category" value="<?php echo $flower_category; ?>"/>
                    <button type="submit" class="btn btn-success">Save</button>
                <?php echo form_close(); ?>
                </div>
            </div>
		</div>
        
	</div>
</div>

<?php require_once('/../includes/footer.php'); ?>
</body>
</html>