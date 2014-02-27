<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Flower Shop</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
	.advertise-format {
		margin-top:150px
	}
	.col-md-12 img { width: 200px; height: 200px; margin:3px; }
	.modal-body img { width: 100%; height: 100%; }
	.glyphicon-remove { cursor: pointer }
	</style>
</head>
<body>
<?php include(__DIR__ . "/../includes/header.php"); ?>
<div class="container">
	<div class="row">
        <ol class="breadcrumb">
			<li><a href="admin">Admin</a></li>
			<li class="active"><?php echo ucfirst($this->uri->segment(1)); ?></li>
        </ol>
        <div class="col-md-6 col-md-offset-3">
            <?php if(isset($_GET['fields']) && $_GET['fields'] == "required"): ?>
            <div class="alert alert-danger">
                <small>All fields are required.</small>
            </div>
            <?php endif; ?>
            <?php if(isset($_GET['add']) && $_GET['add'] == "true"): ?>
            <div class="alert alert-success">
                <small>Advertisement added successfully!.</small>
            </div>
            <?php endif; ?>
            <?php echo form_open_multipart("advertise/process"); ?>
                <div class="form-group">
                    <label for="type"><small>Advertisement Type</small></label>
                    <br/>
                    <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary">
                        <input type="radio" name="type" value="0" id="option1"> Promo
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="type" value="1" id="option2"> Gallery
                      </label>
                      <!--
                      <label class="btn btn-primary">
                        <input type="radio" name="type" value="2" id="option3"> Same day delivery
                      </label>
                      -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="image"><small>Select image</small></label>
                    <input type="file" id="image" class="form-control" name="advertise_file[]" multiple required/>
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-primary pull-right">Submit</button>
                </div>
            <?php echo form_close(); ?>
        </div>
        <br /><br />
        <div class="col-md-12">
        <select class="advertise-format form-control">
        	<option value="">Select Advertisement</option>
        	<option value="0">Promo</option>
            <option value="1">Gallery</option>
            <!-- <option value="2">Same day delivery</option> -->
        </select>
        </div>
        <br /><br />
        <div class="col-md-12 image-append-here">
        </div>
	</div>
</div>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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