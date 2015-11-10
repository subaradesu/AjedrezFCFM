	<div id="content">
		<?php if($userStatus == 2) : ?>
		<div class="alert alert-danger">
			<strong>El dueño de esta cuenta se encuentra baneado!</strong> si lo conoces pídele que se contacte con nosotros para solucionar su situación.
		</div>
		<?php endif;?>
		<div class=page-header>
			<h1>Perfil de <?php echo $first_name.' '.$last_name;?>:</h1>
		</div>
		<div>
			<img alt="avatar" src="<?php echo $avatar;?>">
			<p>Esta es el perfil de <?php echo $username;?>.</p>
			<p><?php echo anchor('main_controller/user_publications/'.$username,'Ver Publicaciones.');?></p>
		</div>
		
		<?php if($username == $_SESSION["username"]) : ?>
		<div>
			<p><a class="btn btn-lg btn-primary" href="editprofile.php" role="button">Editar mi información</a></p>
		</div>
		<?php endif;?>
	</div>