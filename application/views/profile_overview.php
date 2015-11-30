	<div id="content">
		<div class="page-header">
			<h1>Resumen Perfil - <?php echo $username;?></h1>
		</div>
		<div>
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-3" for="name">Nombre:</label>
					<div class="col-sm-6" style="margin: auto;">
						<p><?php echo $first_name;?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3" for="lastname">Apellido:</label>
					<div class="col-sm-6">
						<p><?php echo $last_name;?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3" for="email">Correo Electrónico:</label>
					<div class="col-sm-6">
						<p><?php echo $email;?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3" for="sex">Sexo:</label>
					<div class="col-sm-6">
						<p><?php if($sex==1) echo "Hombre";
								else echo "Mujer"; ?></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3" for="userStatus">Status:</label>
					<div class="col-sm-6">
						<p><?php if($userStatus==3){
								echo "Administrador";
							}
							elseif ($userStatus==1){
								echo "Usuario Activo";
							}
							elseif ($userStatus==2){
								echo "Usuario Baneado";
							}
							?></p>
					</div>
				</div>
			</form>
		</div>
	</div>