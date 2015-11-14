	
	<?php $event = $event[0];?>
				
	<div id="content">
		<div class=page-header>
			<h1>Evento "<?php echo $event["title"];?>"</h1>
		</div>
		<div>
			<p>Descripción: <?php echo $event["description"];?></p>
			<p><?php echo "El ".$event["date"]." en ".$event["place"]." a las ".$event["time"]; ?></p>
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