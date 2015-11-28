	<div id="content">
		<div class=page-header>
			<h1>Editar Perfil - <?php echo $username;?></h1>
		</div>
		<div>
			<?php echo form_open_multipart(uri_string(), array('class' => 'form-horizontal', 'role' => 'form'));?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="name">Nombre:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="name" name="name" placeholder="<?php echo $first_name;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="lastname">Apellido:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="<?php echo $last_name;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Correo Electrónico:</label>
					<div class="col-sm-6">
						<input type="email" class="form-control" id="email" placeholder="<?php echo $email;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="sex">Hombre:</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="sex" value="1" <?php if($sex==1) echo "checked";?>>
					</div>
					<label class="control-label col-sm-2" for="sex">Mujer:</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="sex" value="2" <?php if($sex==2) echo "checked";?>>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="avatar">Avatar:</label>
					<input type="file" name="avatar" class="col-sm-8" id="avatar">
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="password">Password:</label>
					<div class="col-sm-6">
						<input type="password" class="form-control" id="password" name="password" placeholder="Ingresar Nueva Contraseña">
					</div>
				</div>
					<div class="form-group">
					<div class="col-sm-offset-2 col-sm-6">
					<button type="submit" class="btn btn-default" name="submit" id="submit">Cambiar</button>
			    </div>
			  </div>
			</form>
		</div>
	</div>