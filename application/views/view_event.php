
	<div id="content">
		<div class=page-header>
			<h1><?php echo $event["event_data"]["title"];?></h1>
		</div>
		<div>
			<p>
			<p><strong>Descripción: </strong><?php echo $event["event_data"]["description"];?></p>
			<p><strong>Desde: </strong><?php echo $event["event_data"]["date_start"];?></p>
			<p><strong>Hasta: </strong><?php echo $event["event_data"]["date_end"];?></p>
			<p><strong>En: </strong><?php echo $event["event_data"]["place"];?></p>
			<p><strong>Categoría: </strong><?php echo $event["event_data"]["category_name"];?></p>
		</div>
		<div class=page-header>
			<?php if($event["event_data"]["visibility"] == 'private') :?>
				<h2>Evento Privado:</h2>
				<p>Sólo los invitados de la lista pueden asistir</p>
			<?php else : ?>
				<h2>Evento Público:</h2>
				<p>Cualquier usuario puede confirmar o desconfirmar su asistencia a este evento.</p>
			<?php endif;?>
			<h2>Lista de Invitados:</h2>
			<p>Confirmados: <?php echo $event["assistance"]["confirmed"];?></p>
			<p>No Confirmados: <?php echo $event["assistance"]["unconfirmed"];?></p>
		</div>
		<div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Usuario:</th>
						<th>Participación:</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($event["user_list"] as $u) :?>
					<tr>
						<th><?php echo anchor('/user_controller/user_profile/'.$u["id_user"], $u["first_name"].' '.$u["last_name"]);?></th>
						<th><?php echo $u["assistance"];?></th>
						<th>
						<?php
						if ($event["event_data"]["status"] != 'closed'){
							if($u["assistance"] == 'unconfirmed'){
								echo anchor('publication_controller/event_assistance/'.$event["event_data"]["id_event"].'/confirmed', 'Confirmar Asistencia', array('class' => 'btn btn-sm btn-primary')); 
							}
							else{
								echo anchor('publication_controller/event_assistance/'.$event["event_data"]["id_event"].'/unconfirmed', 'Desconfirmar Asistencia', array('class' => 'btn btn-sm btn-primary'));
							}
						}?>
						</th>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
		<?php if ($event["event_data"]["status"] == "closed") : ?>
		<div>
		</div>
		<?php endif;?>
	</div>