<?php $status = array( 0 => "Cancelled", 1 => "Pending", 2 => "On Delivery", 3 => "Delivered", 4 => "Processing" ); ?>
<?php foreach($flower as $flw) { ?>
<div class="thumbnail">
  <img src="assets/images/banner.jpg" class="img-thumbnail img-square" alt="">
  <div class="caption" style="position:relative; overflow:hidden">
  <p style="text-align:center">1137 Chino Roces Ave. (formerly Pasong Tamo) Corner Kamagong Street, San Antonio Village, Makati City</p>
  <p style="text-align:center">Tel. No.: (02)553-4918 * 781-4147</p>
  <p style="text-align:center">Telefax:(02)553-4841</p>
  <p style="text-align:center">Mobile No.:09202738984</p>
  <br />
  <div class="col-md-3">Item</div>
  <div class="col-md-3">Quantity</div>
  <div class="col-md-3">Price</div>
  <div class="col-md-3">Total</div>
  
  <div class="col-md-3"><?php echo $flw->flower_name; ?></div>
  <div class="col-md-3"><?php echo $flw->quantity; ?></div>
  <div class="col-md-3"><?php echo number_format($flw->flower_price, 2); ?></div>
  <div class="col-md-3">Php <?php echo number_format($flw->quantity*$flw->flower_price, 2); ?></div>
  <br /><br /><br />
  <!-- <div class="col-md-3"></div> -->
  <div class="col-md-3">Payment method: <?php echo $flw->payment_name; ?></div>
  <div class="col-md-3">Add-ons total: <?php echo number_format($flw->addons_total, 2); ?></div>
  <div class="col-md-3">Delivery Fee: <?php echo number_format($flw->delivery_fee, 2); ?></div>
  <div class="col-md-3">Total: Php <?php echo number_format($flw->quantity*$flw->flower_price+$flw->delivery_fee+$flw->addons_total, 2); ?></div>
  </div>
</div>
<?php } ?>
