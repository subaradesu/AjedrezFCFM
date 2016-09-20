	<div id="content">
		<div class=page-header>
			<h1>Cerrar Acceso:</h1>
		</div>
		<div>
			<p>Acá puedes cerrar el acceso a la página durante cierto periodo.</p>
		</div>
		<div class="col-sm-12">
			<?php echo form_open('main_controller/close/', array('class' => 'form-horizontal'));?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="cause">Razón<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="cause" class="form-control" id="cause" placeholder="Razón del cierre de plataforma (Será visto por los usuarios) Ej: Mantenimiento de la base de datos." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="description">Descripción<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<textarea name="description" class="form-control" rows="2" id="description" placeholder="Descripción específica sobre el cierre de plataforma." required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="datefrom">Desde<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input name="datefrom" id="datefrom" type="text" class="form-control" placeholder="Fecha y hora desde la que se cierra la plataforma. Formato: dd-MM-yyyy hh:mm">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="dateuntil">Hasta<span class="red-text">*</span>:</label>
					<div class="col-sm-8" >
						<input name="dateuntil" id="dateuntil" type="type" class="form-control" placeholder="Fecha y hora a la cual se abre la plataforma. Formato: dd-MM-yyyy hh:mm">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Cerrar Acceso</button>
					</div>
				</div>
			</form>
		</div>
	</div>