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
    
    	<div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-body">
                <?php echo form_open("admin/new_product"); ?>
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
                    	<label for="flower_availabilty"><small>Availabilty</small></label>
                        <input type="text" id="flower_availabilty" class="form-control" name="flower_availabilty" required="required">
                    </div>
                    
                    <div class="form-group">
                    	<label for="flower_images"><small>Upload images</small></label>
                        <input type="file" id="flower_images" class="form-control" name="flower_images[]" required="required">
                    </div>
                    
                    <div class="form-group">
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" name="options" id="option1"> Featured
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="options" id="option2"> Promo
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