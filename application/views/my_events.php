	
	<div id="content">
		<div class=page-header>
			<h1>Mis Eventos:</h1>
		</div>
		<div>
			<p>Acá puedes ver tus eventos.</p>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h2>Eventos Privados:</h2>
				<?php foreach ($private_events as $event) : ?>
				<?php //debug_var($event);?>
				<div class="alert alert-success">
					<p><strong><?php echo $event["title"];?></strong></p>
					<p><?php echo "El ".$event["date"]." en ".$event["place"]." a las ".$event["time"]; ?></p>
					<p><?php echo $event["description"];?></p>
					<p>
						<?php echo anchor('publication_controller/view_event/'.$event["idevent"].'/confirm','Asistiré');?>
						<?php echo anchor('publication_controller/view_event/'.$event["idevent"].'/unconfirm','No Asistiré');?>
					</p>
				</div>
				<?php endforeach;?>
			</div>
			<div class="col-sm-6">
				<h2>Eventos Públicos:</h2>
				<?php foreach ($public_events as $event) : ?>
				<div class="alert alert-success">
					<p><strong><?php echo anchor('publication_controller/view_event/'.$event["publication_idPublication"].'/confirm',$event["title"]);?></strong></p>
					<p><?php echo "El ".$event["date"]." en ".$event["place"]." a las ".$event["time"]; ?></p>
					<p><?php echo $event["description"];?></p>
					<p>
						<?php //echo anchor('main_controller/view_event/'.$event["publication_idPublication"].'/confirm','Asistiré');?>
						<?php //echo anchor('main_controller/view_event/'.$event["publication_idPublication"].'/unconfirm','No Asistiré');?>
					</p>
				</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>