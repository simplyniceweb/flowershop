<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Flower Shop</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		.divider { margin-top: 15px; }
		.wrapper { border-radius: 3px; background: #F1F1F1; border: 1px solid #CCC; }
		.box { padding: 5px }
		
		/* Modified */
		.thumbnail > img { width: 250px !important; height: 200px !important}
	</style>
</head>
<body>
<?php require_once('/../includes/header.php'); ?>
<div class="container">
    
    <div class="row divider wrapper box">
    	<?php if(count($flower) < 1) { ?>
        	<p>No package yet.</p>
        <?php } ?>
        <?php foreach($flower as $flw) { ?>
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail">
              <img src="assets/flower/<?php echo $flw->flower_img_name; ?>" alt="<?php echo $flw->flower_name; ?>" width="300" height="100">
              <div class="caption">
              	<a class="pull-right" href="view/<?php echo $flw->flower_id; ?>" data-entry-id="<?php echo $flw->flower_id; ?>">View</a>
                <h3><?php echo $flw->flower_name; ?></h3>
                <p><?php echo $flw->flower_description; ?></p>
              	<p>Price: Php <?php echo number_format($flw->flower_price, 2); ?></p>
                <p>
                <a href="javascript:void(0);" class="btn <?php if(!is_null($flw->c_flower_id) && $session) { echo "remove-cart btn-danger"; } else { echo "add-cart btn-primary"; } ?> btn-xs" data-cart-id="<?php if(!is_null($flw->c_flower_id) && $session) echo $flw->c_flower_id; ?>" data-entry-id="<?php echo $flw->flower_id; ?>" role="button">
                    <?php if(!is_null($flw->c_flower_id) && $session) { ?>
                    <i class="glyphicon glyphicon-remove"></i> 
                    Remove to cart
                    <?php } else { ?>
                    <i class="glyphicon glyphicon-shopping-cart"></i> 
                    Add to cart
                    <?php } ?>
                </a>
                </p>
                
              </div>
            </div>
          </div>
         <?php } ?>         
    </div>
</div>

<?php require_once('/../includes/footer.php'); ?>
</body>
</html>