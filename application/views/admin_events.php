
	<div id="content">
		<div class=page-header>
			<h1>Administrar mis Eventos:</h1>
		</div>
		<div class="events-wrapper">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Título</th>
						<th>Inicio</th>
						<th>Fin</th>
						<th>Estado</th>
						<th>Finalizar</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($events as $event) :?>
					<tr>
						<th><?php echo anchor('publication_controller/view_event/'.$event["id_event"], $event["title"]);?></th>
						<th><?php echo $event["date_start"];?></th>
						<th><?php echo $event["date_end"];?></th>
						<th><?php echo translateStatus($event["status"]);?></th>
						<th><?php
							if ($event["status"] == 'ended'){
									echo anchor('publication_controller/admin_events/'.$event["id_event"], 'Cerrar', array('class' => 'btn btn-sm btn-primary'));
							}?>
						</th>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>