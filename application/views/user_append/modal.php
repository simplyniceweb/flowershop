<?php $status = array( 0 => "Cancelled", 1 => "Pending", 2 => "On Delivery", 3 => "Delivered", 4 => "Processing" ); ?>
<?php foreach($flower as $flw) { ?>
<div class="thumbnail">
  <img src="assets/flower/<?php echo $flw->flower_img_name; ?>" alt="<?php echo $flw->flower_name; ?>" width="530" height="340">
  <div class="caption">
	<?php if($session['user_level'] == 1){ ?>
  	<legend>Customer information</legend>
    <p>Full Name: <?php echo $flw->user_name; ?></p>
    <p>Type of customer: 
	<?php if($flw->user_favorite == 1): ?>
    <span class="glyphicon glyphicon-star" style="color: #F0FF00"></span>
    <small>Regular / Priority</small>
    <?php else: ?>
    <span class="glyphicon glyphicon-star" style="color: #F0FF00"></span>
    <small>Normal</small>
    <?php endif; ?>
    </p>
	<?php } ?>
  	<legend>Product information</legend>
    <p>Product Name: <?php echo $flw->flower_name; ?></p>
    <p>Description: <?php echo $flw->flower_description; ?></p>
    <p>Price: Php <?php echo number_format($flw->flower_price, 2); ?></p>
    <p>Category: <?php echo $flw->category_name; ?></p>
    <legend>Order information</legend>
    <p>Receiver: <?php echo $flw->receiver; ?></p>
    <p>Receiver Number: <?php echo $flw->receiver_no; ?></p>
    <p>Payment method: <?php echo $flw->payment_name; ?></p>
    <p>Order Status: <?php echo $status[$flw->order_status]; ?></p>
    <p>Order Date: <?php echo date("F d, Y", strtotime($flw->order_date)); ?></p>
    <p>Delivery Date: <?php echo  date("F d, Y", strtotime($flw->delivery_date)); ?></p>
    <p>Receiver Address: <?php echo $flw->receiver_address; ?></p>
    <p>Card Message: <?php echo $flw->card_message; ?></p>
    <p>Suggestions: <?php echo $flw->suggestions; ?></p>
  </div>
</div>
<?php } ?>