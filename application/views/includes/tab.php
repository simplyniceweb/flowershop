<?php if($announcement): ?>
<?php foreach( $announcement as $ann ) { ?>
<li class="list-group-item">
	<div class="pull-right">
		<small><?php echo date('M d, Y', strtotime($ann->announcement_start)); ?> <strong>-</strong> <?php echo date('M d, Y', strtotime($ann->announcement_end)); ?></small>
	</div>
	<p><a href="a/<?php echo $ann->announcement_id; ?>"><?php echo ucfirst($ann->announcement_title); ?></a></p>
	<?php echo ucfirst(nl2br(htmlspecialchars($ann->announcement_description))); ?>
</li>
<?php } ?>
<?php else: ?>
<div class="alert alert-warning list-group-item">
	There are no announcement for this category.
</div>
<?php endif; ?>