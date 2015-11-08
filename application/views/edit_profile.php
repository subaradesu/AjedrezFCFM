	<div id="content">
		<div class=page-header>
			<h1>Editar Perfil - <?php echo $username;?></h1>
		</div>
		<div>
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" for="name">Nombre:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" placeholder="Usuario">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="lastname">Apellido:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nombre">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Correo Electrónico:</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" placeholder="Correo Electronico">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="sex">Hombre:</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="sex" value="0" checked>
					</div>
					<label class="control-label col-sm-2" for="sex">Mujer:</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="sex" value="1">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2">Recibir Notificaciones:</label>
					<div class="col-sm-1">
						<input type="checkbox" class="form-control" id="notifications" name="notifications">
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="password">Password:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="password" name="password" placeholder="Ingresar Nueva Contraseña">
					</div>
				</div>
					<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default" name="submit" id="submit">Cambiar</button>
			    </div>
			  </div>
			</form>
		</div>
	</div>