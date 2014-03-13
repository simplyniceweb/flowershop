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
    <div class="row divider">
    	<div class="col-md-12">
        <legend>Cart</legend>
		<?php if(isset($_GET['add_ons']) && $_GET['add_ons'] == "true"): ?>
        <div class="alert alert-success">
            <small>Add-ons has been added successfully.</small>
        </div>
        <?php endif; ?>
        <!-- <a href="#" class="order-all btn btn-sm btn-primary" data-toggle="modal" data-target="#orderForm"><span class="glyphicon glyphicon-credit-card"></span> Order Now</a> -->
        <br /><br />
    	<table class="table table-bordered table-hover">
        	<thead>
            	<tr>
                <!-- <th><input type="checkbox" class="multiple-order" /></th> -->
            	<th>Product Name</th>
                <th>Category</th>
                <th>Add-ons</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Remove to cart</th>
                <th>Order now</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($flower as $flw) { ?>
            <tr class="row-<?php echo $flw->cart_id; ?>">
            	<!-- <td>
                <input type="checkbox" id="my_id<?php echo $flw->cart_id; ?>" class="child-order" name="child-order[]" value="<?php echo $flw->cart_id; ?>" data-flower-id="<?php echo $flw->flower_id; ?>"/>
                </td>
                -->
            	<td><?php echo ucfirst($flw->flower_name); ?></td>
                <td><?php echo ucfirst($flw->category_name); ?></td>
                <td><a href="#" class="btn btn-primary btn-sm show-order" data-cart-id="<?php echo $flw->cart_id; ?>" data-toggle="modal" data-target="#addOns" data-backdrop="static" data-keyboard="false">Add-ons</a></td>
                <td>Php <?php echo number_format($flw->flower_price, 2); ?></td>
                <td>
                    <div class="input-group" style="width:90px">
                      <input type="text" class="quantity_val form-control input-sm" value="<?php echo $flw->quantity; ?>" />
                      <span class="quantity input-group-addon" data-entry-id="<?php echo $flw->cart_id; ?>" style="cursor: pointer"><i class="glyphicon glyphicon-refresh"></i></span>
                    </div>
                </td>
                <td>
                <button type="submit" class="remove-flower btn btn-xs btn-default" data-entry-id="<?php echo $flw->cart_id; ?>">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Remove to Cart
				</button>
                </td>
                <td>
                <button type="submit" class="btn btn-xs btn-default">
                    <span class="glyphicon glyphicon-credit-card"></span> 
                    <a href="orders/order/<?php echo $flw->flower_id; ?>/0" style="color:#FFF">Order Now</a>
				</button>
                </td>
			</tr>
            <?php } ?>
           	</tbody>
        </table>
		<!-- <a href="#" class="order-all btn btn-sm btn-primary" data-toggle="modal" data-target="#orderForm">
        <span class="glyphicon glyphicon-credit-card"></span> Order Now</a> -->
        </div>
    </div>
</div>
<div class="modal fade" id="orderForm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Order Form</h4>
      </div>
      <form id="order_all_form">
      <div class="modal-body">
        <div class="form-group">
            <label for="payment_type"><small>Type of payment</small></label>
            <select id="payment_type" class="form-control" name="payment">
                <?php foreach($payment->result() as $row) { ?>
                    <option value="<?php echo $row->payment_id; ?>"><?php echo $row->payment_name; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="delivery_fee"><small>Delivery Location</small></label>
            <select id="delivery_fee" name="delivery_fee" class="form-control" required>
                <?php foreach($fee as $fe) { ?>
                    <option value="<?php echo $fe->fee; ?>"><?php echo $fe->location . " - " . $fe->fee; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="receiver"><small>Receiver Name</small></label>
            <input type="text" id="receiver" name="receiver" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="receiver_no"><small>Receiver Mobile/Phone Number</small></label>
            <input type="text" id="receiver_no" name="receiver_no" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="delivery_date"><small>Delivery Date/Time</small></label>
            <input type="date" id="delivery_date" name="delivery_date" class="form-control" required/>
        </div>
        <div class="form-group">
            <label for="receiver_address"><small>Receiver Address</small></label>
            <textarea id="receiver_address" name="receiver_address" class="form-control"></textarea>
            <small>If we are delivering to an office address, kindly provide us the company name and recipient's department.
            Please include the recipient's landline number if available. For more info kindly read our <a href="company/terms_conditons" target="_blank">Terms and Conditions.</a></small>
        </div>
        <div class="form-group">
            <label for="card_message"><small>Card Message</small></label>
            <textarea id="card_message" name="card_message" class="form-control"></textarea>
            <small>Exact message will be printed on card. Please include sender name if you want this printed.</small>
        </div>
        <div class="form-group">
            <label for="suggestions"><small>Suggestions</small></label>
            <textarea id="suggestions" name="suggestions" class="form-control"></textarea>
            <small>You can add accompaniment, chocolates, stuffed toys and also can change the color.</small>
        </div>
        <div class="form-group">
        <small>
        Have you read and understand our terms and conditions? <br />
        <input type="checkbox" name="read_terms" required/>
        </small>
        </div>
        <input type="hidden" class="order_all_name" name="order_all" />
      	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="order-btn btn btn-primary" data-action="0">Submit</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="addOns">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close_add_ons" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add-ons</h4>
      </div>
      <?php echo form_open("addons/save"); ?>
      <div class="modal-body">
        <div class="form-group">
        <label for="select_add_ons"><small>Select Add-ons</small></label>
        	<select id="select_add_ons" class="form-control select-add-ons">
            	<option value="">Select Add-ons</option>
            <?php foreach($add_ons as $ao) { ?>
            	<option value="<?php echo $ao->item_id; ?>" data-item-name="<?php echo $ao->item_name; ?>"><?php echo $ao->item_name; ?></option>
            <?php } ?>
            </select>
        <div class="append_add_ons">
        	<table class="table table-bordered table-hover">
            	<thead>
                    <tr>
                		<th>Item Name</th>
                        <th>Item Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
					</tr>
                </thead>
                
                <tbody class="append_row">
                    <tr>
                    	<td>Total: <span class="total_price"></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="ao_cart_id" value=""/>
      	<input type="hidden" name="total_price" value=""/>
        <button type="button" class="close_add_ons btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary">Save</button>
      </div>
      <?php echo form_close(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php include(__DIR__ . "/../includes/footer.php"); ?>
<script>
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

$(".quantity_val").keydown(function (e) {
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
</script>
</body>
</html>
