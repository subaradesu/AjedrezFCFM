
	<div id="content">
		<div class="row-profile">
			<div class="col-sm-3">
				<div class="profile-sidebar">
					<div class="profile-userAvatar">
						<img alt="avatar" src="<?php echo $profile_data["avatar"];?>">
					</div>
					<div class="profile-userAbout">
						<div class="profile-userAbout-name">
							<?php echo $profile_data["first_name"].' '.$profile_data["last_name"];?>
						</div>
						<div class="profile-userAbout-description">
							<?php echo $profile_data["username"];?>
						</div>
					</div>
					<?php if(false) :?>
					<div class="profile-userContact">
						<a class="btn btn-success btn-sm" href="#"></a>
					</div>
					<?php endif;?>
					<div class="profile-userMenu">
						<ul class="nav">
							<li class="<?php echo ($profile_section == 1 ? 'active' : '#');?>">
								<?php echo anchor('main_controller/user_profile/'.$profile_data["username"].'/1', '<i class="glyphicon glyphicon-home"></i> Ver Perfil');?>
							</li>
							<?php if(isset($_SESSION["username"]) && $profile_data["username"] == $_SESSION["username"]) : ?>
							<li class="<?php echo ($profile_section == 2 ? 'active' : '#');?>">
								<?php echo anchor('main_controller/user_profile/'.$profile_data["username"].'/2', '<i class="glyphicon glyphicon-edit"></i> Editar Información');?>
							</li>
							<?php else : ?>
							<li class="<?php echo ($profile_section == 3 ? 'active' : '#');?>">
								<?php echo anchor('main_controller/user_profile/'.$profile_data["username"].'/3', '<i class="glyphicon glyphicon-envelope"></i> Contactar');?>
							</li>
							<?php endif;?>
							<li class="<?php echo ($profile_section == 4 ? 'active' : '#');?>">
								<?php echo anchor('main_controller/user_profile/'.$profile_data["username"].'/4', '<i class="glyphicon glyphicon-flag"></i> Ver Publicaciones');?>
							</li>
							<li class="<?php echo ($profile_section == 5 ? 'active' : '#');?>">
								<?php echo anchor('main_controller/user_profile/'.$profile_data["username"].'/5', '<i class="glyphicon glyphicon-stats"></i> Estadísticas');?>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-9">
				<?php if($profile_data["userStatus"] == 2) : ?>
				<div class="alert alert-danger">
					<strong>El dueño de esta cuenta se encuentra baneado!</strong> si lo conoces pídele que se contacte con nosotros para solucionar su situación.
				</div>
				<?php endif;?>
		    	<div class="profile-content">
		    		<?php echo ($profile_content);?>
					<?php echo anchor('main_controller/user_publications/'.$profile_data["username"],'Ver Publicaciones.');?>
				</div>
			</div>
		</div>
	</div>