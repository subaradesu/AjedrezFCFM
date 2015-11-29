<div id="content">
		<div>
			<?php echo validation_errors(); ?>
		</div>
		<div class=page-header>
			<h1>Crear Evento:</h1>
		</div>
		<div>
			<p>Acá puedes crear eventos dentro de la plataforma. Los usuarios invitados podrán ver el evento en su pestaña de eventos.</p>
			<p>Los campos con <span class="red-text">*</span> son obligatorios.</p>
		</div>
		<div class="col-sm-12">
			<?php echo form_open('publication_controller/publish_event/', array('class' => 'form-horizontal'));?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Título<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" id="title" placeholder="El título de tu publicación. Ej: 1er Torneo Navideño Bauchef." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="end">Inicio<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="start" class="form-control" id="end" placeholder="Fecha de inicio del evento. Ej: 25-12-2015 16:00." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="end">Término<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="end" class="form-control" id="end" placeholder="Fecha de inicio del evento. Ej: 25-12-2015 22:00." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="location">Ubicación<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="location" class="form-control" id="location" placeholder="Lugar de realización del evento. Ej: Hall Sur Edificio Escuela" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="description">Descripción<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<textarea name="description" class="form-control" rows="2" id="description" placeholder="Pequeña descripción sobre el evento." required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="visibility">Tipo de Evento<span class="red-text">*</span>:</label>
					<label class="control-label col-sm-2" for="visibility">Privado</label>
					<div class="col-sm-1">
						<input type="radio" name="visibility" class="form-control" id="visibility" value="private" data-toggle="tooltip" title="Se notificará sólo a los usuarios seleccionados.">
					</div>
					<label class="control-label col-sm-2" for="visibility">Público</label>
					<div class="col-sm-1">
						<input type="radio" name="visibility" class="form-control" id="visibility" value="public" checked="checked" data-toggle="tooltip" title="Se notificará a todos los usuarios.">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="category">Categoría:<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<select name="category" class="form-control" id="category">
							<option value="1" name="internacional">Torneo Interno</option>
							<option value="2" name="nacional">Torneo Externo</option>
							<option value="3" name="universidad">Reunión</option>
							<option value="4" name="facultad">TIF</option>
							<option value="5" name="amistoso">JOE</option>
							<option value="6" name="otro">Convivencia</option>
							<option value="7" name="libro">"Hacer Presencia"</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="invited[]">Invitados<span class="red-text"></span>:</label>
					<div class="col-sm-8">
						<select name="invited[]" multiple>
							<?php foreach ($users as $user_row) : ?>
							<option value="<?php echo $user_row["username"];?>"><?php echo $user_row["first_name"].' '.$user_row["last_name"];?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Publicar Evento</button>
					</div>
				</div>
			</form>
		</div>
	</div>