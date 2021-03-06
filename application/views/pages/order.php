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
<?php include(__DIR__ . "/../includes/header.php"); ?>
<div class="container">
    
    <div class="row divider wrapper box">

        <div class="col-md-9" style="background:#fce0ec">
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
            
            <div class="col-md-12">
            	<legend>Order Details</legend>
            	<form id="order_form">
                	<input type="hidden" name="flower_id" value="<?php echo $flw->flower_id; ?>"/>
					<input type="hidden" name="user_id" value="<?php echo $u->user_id; ?>"/>
                    <div class="form-group">
                        <label for="payment_type"><small>Type of payment</small></label>
                        <select id="payment_type" class="form-control" name="payment">
                            <?php foreach($payment->result() as $row) { ?>
                                <option <?php if(isset($flw->payment) && $flw->payment == $row->payment_id) { echo "selected"; } ?> value="<?php echo $row->payment_id; ?>"><?php echo $row->payment_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                	<div class="form-group">
                    	<label for="delivery_fee"><small>Delivery Location</small></label>
                        <select id="delivery_fee" name="delivery_fee" class="form-control" required>
							<?php foreach($fee as $fe) { ?>
                                <option <?php if(isset($flw->delivery_fee) && $flw->delivery_fee == $fe->fee) { echo "selected"; } ?> value="<?php echo $fe->fee; ?>"><?php echo $fe->location . " - " . $fe->fee; ?></option>
                            <?php } ?>
                        </select>
                    </div>
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
                    	<input type="date" id="delivery_date" name="delivery_date" class="form-control" value="<?php if(isset($flw->delivery_date)) { echo date("Y-m-d", strtotime($flw->delivery_date)); } ?>" required/>
                    </div>
                    
                	<div class="form-group">
                    	<label for="quantity"><small>Item Quantity</small></label>
                    	<input type="text" id="quantity" name="quantity" class="form-control" value="<?php if(isset($flw->quantity)) { echo $flw->quantity; } else { $flw->cart_quantity; } ?>"/>
                    </div>
                    
                	<div class="form-group">
                    	<label for="receiver_address"><small>Receiver Address</small></label>
                    	<textarea id="receiver_address" name="receiver_address" class="form-control"><?php if(isset($flw->receiver_address)) { echo $flw->receiver_address; } ?></textarea>
                        <small>If we are delivering to an office address, kindly provide us the company name and recipient's department.
                        Please include the recipient's landline number if available. For more info kindly read our <a href="company/terms_conditons" target="_blank">Terms and Conditions.</a></small>
                    </div>
                    
                	<div class="form-group">
                    	<label for="card_message"><small>Card Message</small></label>
                    	<textarea id="card_message" name="card_message" class="form-control"><?php if(isset($flw->card_message)) { echo $flw->card_message; } ?></textarea>
                        <small>Exact message will be printed on card. Please include sender name if you want this printed.</small>
                    </div>
                    <div class="form-group">
                    	<label for="suggestions"><small>Suggestions</small></label>
                        <textarea id="suggestions" name="suggestions" class="form-control"><?php if(isset($flw->suggestions)) { echo $flw->suggestions; } ?></textarea>
                        <small>You can add accompaniment, chocolates, stuffed toys and also can change the color.</small>
                    </div>
                    <?php if($action == 0) { ?>
                    <div class="form-group">
                    <small>
                    Have you read and understand our terms and conditions? <br />
                    <input type="checkbox" name="read_terms" required/>
                    </small>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                    	<input type="hidden" name="action" value="<?php echo $action; ?>"/>
                        <input type="hidden" name="cart_id" value="<?php if(isset($flw->cart_id)) { echo $flw->cart_id; }?>"/>
                        <input type="hidden" name="order_id" value="<?php if(isset($flw->order_id)) { echo $flw->order_id; }?>"/>
                    	<button type="button" class="order-btn btn btn-primary" data-action="1">
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

<?php include(__DIR__ . "/../includes/footer.php"); ?>
<script>
$(document).ready(function(){
/*
	$("#delivery_date").change(function(){
		var date  = new Date();
		var year  = date.getFullYear();
		var month = date.getMonth()+1;
		var today = date.getDate();
		if(month < 10) month = "0"+month;
		var delivery_date = $(this).val();
		var date_today = year+"-"+month+"-"+today;

		// console.log(date_today);
		// console.log(delivery_date);

		if(date_today == delivery_date || delivery_date < date_today) {
			$(this).val("");
			alert("Delivery date is not possible, please select a delivery date greater than date today.");
		}
	})
*/
    $("#quantity, #receiver_no").keydown(function (e) {
		isNumeric(e);
    });
	
	function isNumeric(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
	}
})
</script>
</body>
</html>
