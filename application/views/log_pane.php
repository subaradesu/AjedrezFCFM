	<div id="content">
		<form class="form-signin" action="" method="POST">
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
			<p>¿Aún no tienes cuenta? <a href="register.php">Regístrate aquí.</a></p>
		</form>
	</div>