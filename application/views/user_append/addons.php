<?php foreach($item as $i) { ?>
<tr>
	<td>
	<?php echo $i->item_name; ?>
    <input type="hidden" name="item_id[]" value="<?php echo $i->item_id; ?>"/>
    <input type="hidden" name="item_price[]" value="<?php echo $i->item_price; ?>"/>
    </td>
    <td class="item_price" data-price="<?php echo $i->item_price; ?>">Php <?php echo $i->item_price; ?></td>
    <td><input type="text" class="form-control" name="ao_quantity[]" value="1" /></td>
    <td><a href="javascript:void(0);" class="btn btn-danger btn-sm add-on-remove" data-item-id="<?php echo $i->item_id; ?>"><i class="glyphicon glyphicon-remove"></i></a></td>
</tr>
<?php } ?>