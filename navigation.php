<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" align="left" class="btn pull-left navbar-toggle" data-toggle="collapse" 
	    			data-target=".navbar-collapse"> <!-- You had ID from the docs example -->
	        	<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span> 
      		</button>
			<a class="navbar-brand" href="index.php">Inicio</a>
		</div>
		<div class="collapse navbar-collapse">
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
				<?php if(isLogged() && $_SESSION["permission"]==3):?>
				<li><a href="publish.php">Publicar</a>
				<li><a href="create_event.php">Crear Evento</a>
				<?php endif;?>
				<li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if(!isLogged()) : ?>
					<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Ingresar</a></li>
					<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>
				<?php else : ?>
					<?php
					$s = $_SESSION["sex"]==2 ? 'a' : 'o';
					?>
						<li><a>Bievenid<?php echo $s.', '.$_SESSION["first_name"];?></a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="news.php">Mi Cuenta
							<span class="glyphicon glyphicon-cog"></span></a>
						<ul class="dropdown-menu">
							<li><a href="profile.php<?php echo '?id_user='.$_SESSION["username"]?>">Mi Perfil</a></li>
							<li class="disabled"><a>Preferencias</a></li>
							<li class="disabled"><a>Historial</a></li>
							<?php if($_SESSION["permission"]==1 || $_SESSION["permission"]==3) : ?>
							<li role="separator" class="divider"></li>
							<li><a href="myevents.php">Mis Eventos</a></li>
							<?php endif;?>
							<?php if($_SESSION["permission"]==3) : ?>
							<li role="separator" class="divider"></li>
							<li><a href="admin.php">Administrar</a></li>
							<li><a href="publish.php">Publicar</a></li>
							<li><a href="create_event.php">Crear Evento</a></li>
							<?php endif;?>
						</ul>
						<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>