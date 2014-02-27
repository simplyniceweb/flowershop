<?php foreach($item as $i) { ?>
<tr class="orig_addons">
	<td>
	<?php echo $i->item_name; ?>
    <input type="hidden" name="item_id[]" value="<?php echo $i->item_id; ?>"/>
    <input type="hidden" name="item_price[]" value="<?php echo $i->item_price; ?>"/>
    </td>
    <td class="item_price" data-price="<?php echo $i->item_price; ?>">Php <?php echo number_format($i->item_price, 2); ?></td>
    <td><input type="text" class="form-control" name="ao_quantity[]" value="<?php if(isset($i->quantity)) { echo $i->quantity; } else { echo "1"; } ?>" /></td>
    <td><a href="javascript:void(0);" class="btn btn-danger btn-sm add-on-remove" data-item-id="<?php echo $i->item_id; ?>"><i class="glyphicon glyphicon-remove"></i></a></td>
</tr>
<?php } ?>