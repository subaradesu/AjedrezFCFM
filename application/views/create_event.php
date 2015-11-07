<div id="content">
		<div class=page-header>
			<h1>Crear Evento:</h1>
		</div>
		<div>
			<p>Acá puedes crear eventos dentro de la plataforma. Los usuarios invitados podrán ver el evento en su pestaña de eventos.</p>
			<p>Los campos con <span class="red-text">*</span> son obligatorios.</p>
		</div>
		<div class="col-sm-12">
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Título<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" id="title" placeholder="El título de tu publicación. Ej: 5° Torneo Internacional Beauchef." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="date">Fecha<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="date" class="form-control" id="date" placeholder="Fecha de realización del evento." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="location">Lugar<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="location" class="form-control" id="location" placeholder="Lugar de realización del evento." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="time">Horario<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="time" class="form-control" id="time" placeholder="Hora de realización del evento." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="description">Contenido<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<textarea name="description" class="form-control" rows="2" id="description" placeholder="Pequeña descripción sobre el evento." required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="visibility">Tipo de Evento<span class="red-text">*</span>:</label>
					<label class="control-label col-sm-2" for="visibility">Público</label>
					<div class="col-sm-1">
						<input type="radio" name="visibility" class="form-control" id="visibility" value="public" checked="checked">
					</div>
					<label class="control-label col-sm-2" for="visibility">Privado</label>
					<div class="col-sm-1">
						<input type="radio" name="visibility" class="form-control" id="visibility" value="private">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="invited[]">Invitados<span class="red-text"></span>:</label>
					<div class="col-sm-8">
						<select name="invited[]" multiple>
							<option value="user01">Hibiki Tachibana</option>
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