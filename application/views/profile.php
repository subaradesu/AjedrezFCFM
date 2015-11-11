
	<div id="content">
		<div class="row-profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<div class="profile-userAvatar">
						<img alt="avatar" src="<?php echo $avatar;?>">
					</div>
					<div class="profile-userAbout">
						<div class="profile-userAbout-name">
							<?php echo $first_name.' '.$last_name;?>
						</div>
						<div class="profile-userAbout-description">
							<?php echo $username;?>
						</div>
					</div>
					<?php if(false) :?>
					<div class="profile-userContact">
						<a class="btn btn-success btn-sm" href="#"></a>
					</div>
					<?php endif;?>
					<div class="profile-userMenu">
						<ul class="nav">
							<li class="active">
								<a href="#">
								<i class="glyphicon glyphicon-home"></i> Ver Perfil
								</a>
							</li>
							<?php if($username == $_SESSION["username"]) : ?>
							<li class="#">
								<a href="#">
								<i class="glyphicon glyphicon-edit"></i> Editar Información
								</a>
							</li>
							<?php else : ?>
							<li>
								<a href="#">
								<i class="glyphicon glyphicon-envelope"></i> Contactar</a>
							</li>
							
							<?php endif;?>
							<li>
								<a href="#">
								<i class="glyphicon glyphicon-flag"></i> Ver Publicaciones</a>
							</li>
							<li>
								<a href="#">
								<i class="glyphicon glyphicon-stats"></i> Estadísticas</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				<?php if($userStatus == 2) : ?>
				<div class="alert alert-danger">
					<strong>El dueño de esta cuenta se encuentra baneado!</strong> si lo conoces pídele que se contacte con nosotros para solucionar su situación.
				</div>
				<?php endif;?>
		    	<div class="profile-content">
					<?php echo anchor('main_controller/user_publications/'.$username,'Ver Publicaciones.');?>
				</div>
			</div>
		</div>
	</div>