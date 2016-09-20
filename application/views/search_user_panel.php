	<div id="content">
		<div class=page-header>
			<h1>Buscador:</h1>
		</div>
		<div>
			<?php echo form_open('user_controller/search_user', array('class' => 'form-horizontal'));?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="search">Termino</label>
					<div class="col-sm-10">
						<input name="search" type="text" class="form-control" id="search" placeholder="Ej: Magnus">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="searchby">Buscar por:</label>
					<label class="control-label col-sm-1" for="searchby">Nombre</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="searchby" value="first_name" checked>
					</div>
					<label class="control-label col-sm-1" for="sex">Apellido</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="searchby" value="last_name">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Buscar</button>
			    	</div>
			  	</div>
			</form>
		</div>
	</div>