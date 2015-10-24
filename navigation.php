<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Inicio</a>
		</div>
		<div>
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="news.php">Noticias
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="news.php">Noticias Fcfm</a></li>
						<li class="disabled"><a>Noticias Chile</a></li>
						<li class="disabled"><a>Noticias Mundo</a></li>
					</ul>
				</li>
				<li><a href="about.php">Historia</a>
				<li><a href="links.php">Enlaces</a>
				<li><a href="contact.php">Contacto</a>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
				if(!isLogged()){
					echo '
						<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Ingresar</a></li>
						<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>';
				}
				else{
					$s = $_SESSION["sex"]==2 ? 'a' : 'o';
					echo '
						<li><a>Bievenid'. $s . ', ' . $_SESSION["first_name"] . '.</a></li>
						<li><a href="myaccount.php"><span class="glyphicon glyphicon-cog"></span> Mi Cuenta</a></li>
						<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a></li>';
				}
				?>
			</ul>
		</div>
	</div>
</nav>