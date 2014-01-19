<?php if($category->num_rows > 0) {  ?> 
<label for="category_list"><small>List of category</small></label>
<select id="category_list" class="form-control" name="category">
    <?php foreach($category->result() as $row) { ?>
        <option value="<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></option>
    <?php } ?>
</select>
<?php } else { ?>
<label for="category_list"><small>List of category</small></label>
<select id="category_list" class="form-control" name="category">
        <option value="">No category to delete.</option>
</select>
<?php } ?>