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
		/* Modified */
		.thumbnail > img { width: 250px !important; height: 200px !important}
	</style>
</head>
<body>
<?php include(__DIR__ . "/../includes/header.php"); ?>
<div class="container">
    
    <div class="row divider wrapper box">
        <?php foreach($flower as $flw) { ?>
          <div class="col-md-3">
            <div class="thumbnail">
              <img src="assets/flower/<?php echo $flw->flower_img_name; ?>" alt="<?php echo $flw->flower_name; ?>" width="300" height="100">
              <div class="caption">
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
				<?php 
                    if($session['user_level'] == 1){ 
                    $category = $flw->flower_category;
                    if($category == 1) {
                        $category = "product";
                    } else {
                        $category = "package";
                    }
                ?>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Actions <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="admin/<?php echo $category; ?>/<?php echo $flw->flower_id; ?>"><i class="glyphicon glyphicon-pencil"></i> Edit</a></li>
                    <li><a href="javascript:void(0);" class="delete" data-entry-id="<?php echo $flw->flower_id; ?>"><i class="glyphicon glyphicon-remove"></i> Delete</a></li>
                  </ul>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
         <?php } ?>  

         <div class="col-md-9 gallery">
             <ul>
                 <?php foreach($images as $img) { ?>
                    <li>
                    	<?php if($session['user_level'] == 1){ ?>
                        	<i class="specific-delete glyphicon glyphicon-remove" data-entry-id="<?php echo $img->flower_img_id; ?>" style="top:-60px;left:20px;position:relative;background: #f1f1f1;"></i>
                        <?php } ?>
                        <img src="assets/flower/<?php echo $img->flower_img_name; ?>" alt="<?php echo $flw->flower_name; ?>" class="img-thumbnail img-<?php echo $img->flower_img_id; ?>">
                    </li>
                 <?php } ?>
             </ul>
         </div>
    </div>
</div>

<?php include(__DIR__ . "/../includes/footer.php"); ?>
</body>
</html>
