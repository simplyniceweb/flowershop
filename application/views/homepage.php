<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta property="fb:app_id" content="223633884496335">
    <meta property="fb:admins" content="1692870492"/>
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
		.carousel-inner .item img { align: center }
		.bg-trans { padding-top:15px; background: #FFF }
	</style>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=223633884496335";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php require_once('includes/header.php'); ?>
<div class="container">

	<div class="row">
        <div class="col-md-6">
        	<div class="media">
            <a class="pull-left" href="#">
            <img src="assets/images/banner.jpg" class="img-thumbnail img-square" alt="">
            </a>
            </div>
        </div>

        <div class="col-md-6">
          <div class="media-body box" style="background: #FFF; border:1px solid #CCC">
            <h4 class="media-heading">Welcome</h4>
            Keanna's Flower Shop offers a wide variety of blossoms in fashion. We can make your gloomy event into a pleasant occasion through unique design of flowers, balloons and giveaways. We accept events such as: Weddings, Parties, Decorating, Orchid Plants, Burials, Gourmet Baskets and many more.
          </div>
        </div>
	</div> <!-- Header -->

    <div class="row divider">
    	<h4 class="flower-title">Featured</h4>
        <br/>
        <?php if(count($featured) < 1 ): ?>
        	<p class="flower-title">No featured product yet.</p>
        <?php endif; ?>
        <?php foreach($featured as $feat) { ?>
          <div class="col-sm-3 col-md-3 bg-trans">
            <div class="thumbnail">
              <img src="assets/flower/<?php echo $feat->flower_img_name; ?>" alt="<?php echo $feat->flower_name; ?>" width="300" height="100">
              <div class="caption">
              	<a class="pull-right" href="view/<?php echo $feat->flower_id; ?>" data-entry-id="<?php echo $feat->flower_id; ?>">View</a>
                <h3><?php echo $feat->flower_name; ?></h3>
                <p><?php echo $feat->flower_description; ?></p>
              	<p>Price: Php <?php echo number_format($feat->flower_price, 2); ?></p>
                <p>
                <a href="javascript:void(0);" class="btn <?php if(!is_null($feat->c_flower_id) && $session) { echo "remove-cart btn-danger"; } else { echo "add-cart btn-primary"; } ?> btn-xs" data-cart-id="<?php if(!is_null($feat->cart_id) && $session) { echo $feat->cart_id; } ?>" data-entry-id="<?php echo $feat->flower_id; ?>" role="button">
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
    <div class="row divider">
    	<h4 class="flower-title">Same Day Delivery</h4>
        <?php if(count($samedaydelivery) < 1 ): ?>
        	<p class="flower-title">No same day delivery product yet.</p>
        <?php endif; ?>
        <?php foreach($samedaydelivery as $sdd) { ?>
          <div class="col-sm-3 col-md-3 bg-trans">
            <div class="thumbnail">
            <img src="assets/flower/<?php echo $sdd->flower_img_name; ?>" alt="<?php echo $sdd->flower_name; ?>" width="300" height="100">
              <div class="caption">
              	<a class="pull-right" href="view/<?php echo $sdd->flower_id; ?>" data-entry-id="<?php echo $sdd->flower_id; ?>">View</a>
                <h3><?php echo $sdd->flower_name; ?></h3>
                <p><?php echo $sdd->flower_description; ?></p>
              	<p>Price: Php <?php echo number_format($sdd->flower_price, 2); ?></p>
                <p>
                <a href="javascript:void(0);" class="btn <?php if(!is_null($sdd->c_flower_id) && $session) { echo "remove-cart btn-danger"; } else { echo "add-cart btn-primary"; } ?> btn-xs" data-cart-id="<?php if(!is_null($sdd->cart_id) && $session) { echo $sdd->cart_id; } ?>" data-entry-id="<?php echo $sdd->flower_id; ?>" role="button">
                	<?php if(!is_null($sdd->c_flower_id) && $session) { ?>
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
	<br />
    <div class="row divider wrapper box">
    	<h4 class="flower-title">Promo</h4>
        <?php if($promo_count > 0) { ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
          <?php $i=0; for($i=0; $i<$promo_count; $i++) { ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if($i == 0) { ?>class="active"<?php } ?>></li>
          <?php } ?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
			<?php $active = 0; foreach($promo as $pr) { ?>
            <div class="item <?php if($active == 0) { ?>active<?php } ?>">
              <img src="assets/flower/<?php echo $pr->image; ?>" alt="<?php echo $pr->image; ?>">
              <!--
              <div class="carousel-caption">
              </div>
              -->
            </div>
			<?php $active = 1; } ?>
          </div>
        
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
        <?php } else { ?>
        <p class="flower-title">No Promo yet</p>
        <?php } ?>
    </div>
    <br />
    <div class="col-md-12 col-md-offset-1">
    	<div class="fb-comments" data-href="<?php echo base_url(); ?>/home" data-width="900" data-numposts="15" data-colorscheme="light"></div>
    </div>
    <div class="col-md-12 footer"></div>
</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>
