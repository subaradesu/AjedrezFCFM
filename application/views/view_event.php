
	<ul class="nav nav-pills">
			<li class="active"><a href="#">Ver Evento</a></li>
			<li><?php echo anchor('publication_controller/event_images/'.$event["event_data"]["id_event"], 'Ver Imagenes');?></li>
	</ul>
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
					<?php $Iassisted = false;?>
					<?php foreach ($event["user_list"] as $u) :?>
						<?php
						if (isset($_SESSION["username"]) && $_SESSION["username"]==$u["id_user"]){
							$Iassisted = true;
						}
						?>
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
		<?php if ($event["event_data"]["status"] == 'closed' && $Iassisted)  : ?>
		<p>Hola! Este evento ya fue dado por cerrado y como asististe a él puedes agregar imagenes!</p> 
		<div>
			<?php echo form_open_multipart('publication_controller/event_images/', array('class' => 'form-horizontal'));?>
				<?php echo form_hidden('event', $event["event_data"]["id_event"]);?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Título<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" id="title" placeholder="Un lindo título para la imagen." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">Imagen<span class="red-text">*</span>:</label>
					<input type="file" name="image" class="col-sm-8" id="image" required>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Publicar Imagen</button>
					</div>
				</div>
			</form>
		</div>
		
		<?php endif;?>
	</div>