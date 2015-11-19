	
	<div id="content">
		<?php //TODO: Hacer la vista más bonita?>
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
				
				<div class="alert alert-success">
					<p><strong><?php echo anchor('publication_controller/view_event/'.$event["id_event"],$event["title"]);?></strong></p>
					<p><strong>Desde: </strong><?php echo $event["date_start"];?></p>
					<p><strong>Hasta: </strong><?php echo $event["date_end"];?></p>
					<p><strong>En: </strong><?php echo $event["place"];?></p>
					<p><?php echo $event["description"];?></p>
					<p>
						<?php echo anchor('publication_controller/view_event/'.$event["id_event"].'/confirm','Asistiré');?>
						<?php echo anchor('publication_controller/view_event/'.$event["id_event"].'/unconfirm','No Asistiré');?>
					</p>
				</div>
				<?php endforeach;?>
			</div>
			<div class="col-sm-6">
				<h2>Eventos Públicos:</h2>
				<?php foreach ($public_events as $event) : ?>
				<div class="alert alert-success">
					<p><strong><?php echo anchor('publication_controller/view_event/'.$event["id_event"],$event["title"]);?></strong></p>
					<p><strong>Desde: </strong><?php echo $event["date_start"];?></p>
					<p><strong>Hasta: </strong><?php echo $event["date_end"];?></p>
					<p><strong>En: </strong><?php echo $event["place"];?></p>
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