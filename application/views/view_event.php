				
	<div id="content">
		<div class=page-header>
			<h1>Evento "<?php echo $event["title"];?>"</h1>
		</div>
		<div>
			<p>
			<p><strong>Descripción: </strong><?php echo $event["description"];?></p>
			<p><strong>Desde: </strong><?php echo $event["date_start"];?></p>
			<p><strong>Hasta: </strong><?php echo $event["date_end"];?></p>
			<p><strong>En: </strong><?php echo $event["place"];?></p>
		</div>
		<div class=page-header>
			<h1>Lista de Invitados:</h1>
		</div>
		<div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Usuario:</th>
						<th>Participación:</th>
					</tr>
				</thead>
				<tbody>
				
				</tbody>
			</table>
		</div>
	</div>