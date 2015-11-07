	<div id="content">
		<?php echo form_open('main_controller/user_login', array('class' => 'form-signin'));?>
			<h2 class="form-signin-header"> Ingresar </h2>
			
			<label for="inputUsername" class="sr-only">Nombre de Usuario</label>
			<input type="text" id="inputUsername" name="user" class="form-control" placeholder="Nombre de Usuario" required autofocus>
			<label for="inputPassword" class="sr-only">Contraseña</label>
			<input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Contraseña" required>
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me">No cerrar sesión 
				</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
			<p>¿Aún no tienes cuenta? <?php echo anchor("/main_controller/user_register", "Regístrate aquí.");?></p>
		</form>
	</div>