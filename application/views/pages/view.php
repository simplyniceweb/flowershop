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
		.gallery > img { width: 150px; height: 150px }
		/* Modified */
		.thumbnail > img { width: 250px !important; height: 200px !important}
	</style>
</head>
<body>
<?php require_once('/../includes/header.php'); ?>
<div class="container">
    
    <div class="row divider wrapper box">
        <?php foreach($flower as $flw) { ?>
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail">
              <img src="assets/flower/<?php echo $flw->flower_img_name; ?>" alt="<?php echo $flw->flower_name; ?>" width="300" height="100">
              <div class="caption">
              	<h3><?php echo $flw->flower_name; ?></h3>
                <p><?php echo $flw->flower_description; ?> Gumamela is just a simple flower.</p>
              	<p>Price: Php <?php echo number_format($flw->flower_price, 2); ?></p>
                <p>Availability: <?php echo $flw->flower_availability; ?></p>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Actions <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0);"><i class="glyphicon glyphicon-shopping-cart"></i> Add to cart</a></li>
                    <li><a href="javascript:void(0);"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                    <li><a href="javascript:void(0);" class="delete" data-entry-id="<?php echo $flw->flower_id; ?>"><i class="glyphicon glyphicon-remove"></i> Delete</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
         <?php } ?>  
         <div class="col-md-9 gallery">
         <?php foreach($images as $img) { ?>
         	<img src="assets/flower/<?php echo $img->flower_img_name; ?>" alt="<?php echo $flw->flower_name; ?>" class="img-thumbnail">
         <?php } ?>
         </div>  
    </div>
</div>

<?php require_once('/../includes/footer.php'); ?>
</body>
</html>