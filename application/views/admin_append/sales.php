<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Order #</th>
			<th>Product</th>
			<th>Category</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Delivery Fee</th>
			<th>Order Date</th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		$delivery = 0;
		$price = 0;
		$total = 0;
		foreach($flower as $flw) { ?>
		<tr>
			<td><?php echo $flw->order_id; ?></td>
			<td><?php echo $flw->flower_name; ?></td>
			<td><?php echo $flw->category_name; ?></td>
			<td>₱ <?php echo number_format($flw->flower_price, 2); ?></td>
			<td><?php echo number_format($flw->quantity); ?></td>
			<td>₱ <?php echo number_format($flw->delivery_fee, 2); ?></td>
			<td><?php echo date("F m, Y", strtotime($flw->order_date)); ?></td>
		</tr>
		<?php
			$delivery += $flw->delivery_fee;
			$price += $flw->flower_price;
			$total += $flw->flower_price * $flw->quantity;
			}
		?>
	</tbody>
</table>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Total Delivery</th>
			<th>Total Price</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>₱ <?php echo number_format($delivery,2); ?></td>
			<td>₱ <?php echo number_format($price,2); ?></td>
			<td>₱ <?php echo number_format($total, 2); ?></td>
		</tr>
	</tbody>
</table>
