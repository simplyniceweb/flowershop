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
		.flower-title { margin-left: 20px }
		.footer { height: 50px }
		/* Modified */
		.thumbnail > img { width: 250px !important; height: 200px !important}
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<div class="container">

	<div class="row wrapper">
        <div class="col-md-6 box">
        	<div class="media">
            <a class="pull-left" href="#">
            <img src="assets/images/banner.jpg" class="img-thumbnail img-square" alt="">
            </a>
            </div>
        </div>

        <div class="col-md-6 box">
          <div class="media-body box" style="background: #FFF; border:1px solid #CCC">
            <h4 class="media-heading">Welcome</h4>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
          </div>
        </div>
	</div> <!-- Header -->

    <div class="row divider wrapper box">
    	<h4 class="flower-title">Featured</h4>
        <?php if(count($featured) < 1 ): ?>
        	<p class="flower-title">No featured product yet.</p>
        <?php endif; ?>
        <?php foreach($featured as $feat) { ?>
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail">
              <img src="assets/flower/<?php echo $feat->flower_img_name; ?>" alt="<?php echo $feat->flower_name; ?>" width="300" height="100">
              <div class="caption">
              	<a class="pull-right" href="view/<?php echo $feat->flower_id; ?>" data-entry-id="<?php echo $feat->flower_id; ?>">View</a>
                <h3><?php echo $feat->flower_name; ?></h3>
                <p><?php echo $feat->flower_description; ?></p>
              	<p>Price: Php <?php echo number_format($feat->flower_price, 2); ?></p>
                <p>Availability: <?php echo $feat->flower_availability; ?></p>
                <p>
                <a href="javascript:void(0);" class="btn <?php if(!is_null($feat->c_flower_id) && $session) { echo "remove-cart btn-danger"; } else { echo "add-cart btn-primary"; } ?> btn-xs" data-cart-id="<?php if(!is_null($feat->c_flower_id) && $session) { echo $feat->c_flower_id; } ?>" data-entry-id="<?php echo $feat->flower_id; ?>" role="button">
                    <?php if(!is_null($feat->c_flower_id) && $session) { ?>
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
    
    <div class="row divider wrapper box">
    	<h4 class="flower-title">Promo</h4>
        <?php if(count($promo) < 1 ): ?>
        	<p class="flower-title">No promo yet.</p>
        <?php endif; ?>
        <?php foreach($promo as $prom) { ?>
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail">
              <img src="assets/flower/<?php echo $prom->flower_img_name; ?>" alt="<?php echo $prom->flower_name; ?>" width="300" height="100">
              <div class="caption">
              	<a class="pull-right" href="view/<?php echo $prom->flower_id; ?>" data-entry-id="<?php echo $prom->flower_id; ?>">View</a>
                <h3><?php echo $prom->flower_name; ?></h3>
                <p><?php echo $prom->flower_description; ?></p>
              	<p>Price: Php <?php echo number_format($prom->flower_price, 2); ?></p>
                <p>Availability: <?php echo $prom->flower_availability; ?></p>
                <p>
                <a href="javascript:void(0);" class="btn <?php if(!is_null($prom->c_flower_id) && $session) { echo "remove-cart btn-danger"; } else { echo "add-cart btn-primary"; } ?> btn-xs" data-cart-id="<?php if(!is_null($prom->c_flower_id) && $session) echo $prom->c_flower_id; ?>" data-entry-id="<?php echo $prom->flower_id; ?>" role="button">
                    <?php if(!is_null($prom->c_flower_id) && $session) { ?>
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
    
    <div class="col-md-12 footer"></div>
</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>