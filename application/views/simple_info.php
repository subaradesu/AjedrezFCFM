	<div id="content">
		<div class="alert alert-info">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><?php echo $heading;?></strong>
			<?php if (!is_array($message)) : ?>
			<p><?php echo $message;?>
			<?php endif;?>
		</div>
	</div>