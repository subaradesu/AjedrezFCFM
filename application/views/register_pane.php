	<div id="content">
		<?php echo form_open('main_controller/user_register', array('class' => 'form-signin'));?>
			<h2 class="form-signin-header"> Registrar Usuario </h2>
			
			<label for="inputUsername" class="sr-only">Nombre de Usuario</label>
			<input type="text" id="inputUsername" name="user" class="form-control" placeholder="Nombre de Usuario" required autofocus>
			
			<label for="inputPassword" class="sr-only">Contraseña</label>
			<input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Contraseña" required>
			
			<label for="inputName" class="sr-only">Nombre</label>
			<input type="text" id="inputName" name="first_name" class="form-control" placeholder="Nombre" required>
			
			<label for="inputLastName" class="sr-only">Apellido</label>
			<input type="text" id="inputLastName" name="last_name" class="form-control" placeholder="Apellido" required>
			
			<label for="inputEmail" class="sr-only">Correo Electrónico</label>
			<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Correo Electrónico" required>
			
			<button class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
			<p>¿Ya estás registrado? <?php echo anchor("/main_controller/user_login", "Ingresa aquí.");?></p>
		</form>
	</div>