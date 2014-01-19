<?php foreach($user as $u) { }?>
<?php foreach($flower as $flw) { }?>
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
		legend { margin-top:15px }
		
		/* Modified */
		.thumbnail > img { width: 250px !important; height: 200px !important}
	</style>
</head>
<body>
<?php require_once('/../includes/header.php'); ?>
<div class="container">
    
    <div class="row divider wrapper box">

        <div class="col-md-9" style="background:#FFF">
        <legend>Personal</legend>
        <div class="row user-data">
             <div class="col-md-3">
				<p>Full Name</p>
                <p>Email Address</p>
                <p>Birthday</p>
                <p>Address</p>
            </div>
            
            <div class="col-md-9">
            	<p><?php echo $u->user_name; ?></p>
                <p><?php echo $u->user_email; ?></p>
                <p><?php echo date("M d, Y", strtotime($u->user_birthday)); ?></p>
                <p><?php echo $u->user_address; ?></p>
            </div>
            
            <div class="col-md-8">
            	<legend>Order Details</legend>
            	<form id="order_form">
                	<input type="hidden" name="flower_id" value="<?php echo $flw->flower_id; ?>"/>
					<input type="hidden" name="user_id" value="<?php echo $u->user_id; ?>"/>
                    <!--
                    <div class="form-group">
                        <label for="payment_type"><small>Type of payment</small></label>
                        <select id="payment_type" class="form-control" name="payment">
                            <?php foreach($payment->result() as $row) { ?>
                                <option <?php if(isset($flw->payment) && $flw->payment == $row->payment_id) { echo "selected"; } ?> value="<?php echo $row->payment_id; ?>"><?php echo $row->payment_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
					-->
                	<div class="form-group">
                    	<label for="receiver"><small>Receiver Name</small></label>
                    	<input type="text" id="receiver" name="receiver" class="form-control" value="<?php if(isset($flw->receiver)) { echo $flw->receiver; } ?>"/>
                    </div>
                    
                	<div class="form-group">
                    	<label for="receiver_no"><small>Receiver Mobile/Phone Number</small></label>
                    	<input type="text" id="receiver_no" name="receiver_no" class="form-control" value="<?php if(isset($flw->receiver_no)) { echo $flw->receiver_no; } ?>"/>
                    </div>
                    
                	<div class="form-group">
                    	<label for="delivery_date"><small>Delivery Date/Time</small></label>
                    	<input type="datetime-local" id="delivery_date" name="delivery_date" class="form-control" value="<?php if(isset($flw->delivery_date)) { echo date("Y-m-d\TH:i", strtotime($flw->delivery_date)); } ?>"/>
                    </div>
                    
                	<div class="form-group">
                    	<label for="receiver_address"><small>Receiver Address</small></label>
                    	<textarea id="receiver_address" name="receiver_address" class="form-control"><?php if(isset($flw->receiver_address)) { echo $flw->receiver_address; } ?></textarea>
                        <small>If we are delivering to an office address, kindly provide us the company name and recipient's department.
                        Please include the recipient's landline number if available. For more info kindly read our <a href="">Terms and Conditions.</a></small>
                    </div>
                    
                	<div class="form-group">
                    	<label for="card_message"><small>Card Message</small></label>
                    	<textarea id="card_message" name="card_message" class="form-control"><?php if(isset($flw->card_message)) { echo $flw->card_message; } ?></textarea>
                        <small>Exact message will be printed on card. Please include sender name if you want this printed.</small>
                    </div>
                    <div class="form-group">
                    	<input type="hidden" name="action" value="<?php echo $action; ?>"/>
                        <input type="hidden" name="order_id" value="<?php if(isset($flw->order_id)) { echo $flw->order_id; }?>"/>
                    	<button type="button" class="order-btn btn btn-primary">
                        <?php if($action == 1) {
							echo "Update";
						} else {
							echo "Submit";
						}
						?>
                        </button>
					</div>
            	</form>
            </div>
        </div>
        
        </div>

        <div class="col-md-3">        
        <div class="thumbnail">
          <img src="assets/flower/<?php echo $flw->flower_img_name; ?>" alt="<?php echo $flw->flower_name; ?>" width="300" height="100">
          <div class="caption">
            <h3><?php echo $flw->flower_name; ?></h3>
            <p><?php echo $flw->flower_description; ?></p>
            <p>Php <?php echo number_format($flw->flower_price, 2); ?></p>
            <p><?php echo $flw->category_name; ?></p>            
          </div>
        </div>
        </div>
         
    </div>
</div>

<?php require_once('/../includes/footer.php'); ?>
</body>
</html>