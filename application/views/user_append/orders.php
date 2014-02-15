<?php if($counter > 0) { ?>
<?php foreach($flower as $flw) { ?>
<tr>
	<td><?php echo ucfirst($flw->flower_name); ?></td>
	<td><?php echo ucfirst($flw->category_name); ?></td>
	<td>Php <?php echo number_format($flw->flower_price, 2); ?></td>
	<td>
    <?php if($status == 1) { ?>
	<button type="submit" class="cancel-flower btn btn-xs btn-default" data-entry-id="<?php echo $flw->flower_id; ?>">
		<span class="glyphicon glyphicon-remove"></span> 
		Cancel Order
	</button>
    <?php } else { ?>
    No action.
    <?php } ?>
	</td>
    <td>
    <?php if($status == 1) { ?>
	<button type="submit" class="btn btn-xs btn-default">
		<span class="glyphicon glyphicon-credit-card"></span> 
		<a href="orders/order/<?php echo $flw->flower_id; ?>">Re-schedule Order</a>
	</button>
    <?php } else { ?>
    No action.
    <?php } ?>
    </td>
	<td>
	<button type="submit" class="view-details btn btn-xs btn-default" data-flower-id="<?php echo $flw->flower_id; ?>" data-order-id="<?php echo $flw->order_id; ?>" data-toggle="modal" data-target="#myModal">
		<span class="glyphicon glyphicon-new-window"></span> 
		<a href="javascript:void(0)">View Details</a>
	</button>
	</td>
    <td>
    <button type="submit" class="view-billing btn btn-xs btn-default" data-flower-id="<?php echo $flw->flower_id; ?>" data-order-id="<?php echo $flw->order_id; ?>" data-toggle="modal" data-target="#billing">
        <span class="glyphicon glyphicon-usd"></span> 
        <a href="javascript:void(0)">View Billing</a>
    </button>
    </td>
    <?php if($category != 0) { ?>
    <td>
        <select class="form-control order-status" data-entry-id="<?php echo $flw->order_id; ?>" data-status="<?php echo $flw->order_status; ?>">
            <!-- <option <?php if($status == 0) { echo "selected";} ?> value="0">Cancel Order</option> -->
            <option <?php if($status == 1) { echo "selected";} ?> value="1">Pending</option>
            <option <?php if($status == 2) { echo "selected";} ?> value="2">On Delivery</option>
            <option <?php if($status == 3) { echo "selected";} ?> value="3">Delivered</option>
            <option <?php if($status == 4) { echo "selected";} ?> value="4">Processing</option>
        </select>
    </td>
    <?php } else { ?>
    No action.
    <?php } ?>
    <?php if($category != 0) { ?>
    <td>
        <select class="form-control payment-status" data-entry-id="<?php echo $flw->order_id; ?>" data-status="<?php echo $flw->payment_status; ?>">
            <option <?php if($flw->payment_status == 1){ ?>selected<?php } ?> value="1">Paid</option>
            <option <?php if($flw->payment_status == 0){ ?>selected<?php } ?> value="0">Unpaid</option>
        </select>
    </td>
    <?php } ?>
</tr>
<?php } } else { ?>
<tr>
	<td>No orders.</td>
</tr>
<?php } ?>