<style>
	li { list-style-type: none; float: left; }
</style>
<ul>
<?php if($result > 0 ) { foreach($advert as $ads) { ?>
<li>
<?php if($session['user_level'] == 1){ ?>
<i class="specific-delete glyphicon glyphicon-remove" data-entry-id="<?php echo $ads->id; ?>" style="top:-60px;left:20px;position:relative;background: #f1f1f1;"></i>
<?php } ?>
<img src="assets/flower/<?php echo $ads->image; ?>" alt="<?php echo $ads->image; ?>" class="img-thumbnail img-<?php echo $ads->id; ?> img-modal" data-toggle="modal" data-target="#myModal" style="cursor: pointer; width: 150px; height: 150px">
</li>
<?php } } else { ?>
	<p>No entry.</p>
<?php } ?>
</ul>