
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" align="left" class="btn pull-left navbar-toggle" data-toggle="collapse" 
		    			data-target=".navbar-collapse"> <!-- You had ID from the docs example -->
		        	<span class="icon-bar"></span>
	        		<span class="icon-bar"></span>
	        		<span class="icon-bar"></span> 
	      		</button>
	      		<!-- 			<a class="navbar-brand" href="index.php">Inicio</a> -->
	      		<?php echo anchor("/main_controller/index", "Inicio", array('class' => 'navbar-brand'))?>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="news.php">Noticias
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
	<!-- 					<li><a href="news.php">Noticias Fcfm</a></li> -->
							<li><?php echo anchor("/main_controller/news", "Noticias Fcfm");?></li>
							<li class="disabled"><a>Noticias Chile</a></li>
							<li class="disabled"><a>Noticias Mundo</a></li>
						</ul>
					</li>
					<li><?php echo anchor("/main_controller/about", "Historia");?></li>
					<li><?php echo anchor("/main_controller/links", "Enlaces");?></li>
					<li><?php echo anchor("/main_controller/search_user", "Buscar Usuario");?></li>
					<?php //if(isLogged() && $_SESSION["permission"]==3):?>
					<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="publish.php">Publicar
							<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><?php echo anchor("/main_controller/publish_new", "Noticia");?></li>
							<li><?php echo anchor("/main_controller/publish_event", "Evento");?></li>
							<li><?php echo anchor("/main_controller/publish_game", "Partida");?></li>
						</ul>
					<?php //endif;?>
					<li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php //if(!isLogged()) : ?>
						<li><?php echo anchor("/main_controller/user_login", '<span class="glyphicon glyphicon-log-in"></span> Ingresar');?></li>
						<li><?php echo anchor("/main_controller/user_register", '<span class="glyphicon glyphicon-user"></span> Registro');?></li>
					<?php //else : ?>
						<?php
						//$s = $_SESSION["sex"]==2 ? 'a' : 'o';
						?>
							<li><a>Bievenid<?php //echo $s.', '.$_SESSION["first_name"];?></a></li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="news.php">Mi Cuenta
								<span class="glyphicon glyphicon-cog"></span></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor("/main_controller/user_profile", "Mi Perfil");?></li>
								<li class="disabled"><a>Preferencias</a></li>
								<li class="disabled"><a>Historial</a></li>
								<?php //if($_SESSION["permission"]==1 || $_SESSION["permission"]==3) : ?>
								<li role="separator" class="divider"></li>
								<li><?php echo anchor("/main_controller/user_events", "Mis Eventos");?></li>
								<?php //endif;?>
							</ul>
							<li>
								<?php echo anchor("/main_controller/user_logout", '<span class="glyphicon glyphicon-off"></span> Cerrar Sesión');?>
							</li>
					<?php //endif; ?>
				</ul>
			</div>
		</div>
	</nav>
