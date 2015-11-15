<div id="content">
		<div class=page-header>
			<h1>Página de Administración:</h1>
		</div>
		<div>
			<p>Esta es la página de administración. Administre acá.</p>
		</div>
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nombre de Usuario</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Correo Electrónico</th>
					<th>Tipo de Usuario</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			
			
			<?php foreach ($users as $user_found) :?>
					<tr>
						<th><?php echo $user_found["username"];?></th>
						<th><?php echo $user_found["first_name"];?></th>
						<th><?php echo $user_found["last_name"];?></th>
						<th><?php echo $user_found["email"];?></th>
						<th><?php if ($user_found["userStatus"]==1){echo "Usuario Registrado";} elseif ($user_found["userStatus"]==2){echo "Usuario Baneado";} else {echo "Usuario Administrador";}?></th>
						
						<th><?php echo anchor('user_controller/user_profile/'.$user_found["username"], 'Perfil', array('class' => 'btn btn-lg btn-primary') )?></th>
						
						<?php if ($user_found["userStatus"]==2) :?>
						<th><a class="btn btn-lg btn-primary" role="button" <?php echo 'href="'.base_url('index.php/user_controller/admin/unban').'/'.$user_found["username"].'"';?>>Desbanear</a></th>
						<?php elseif ($user_found["userStatus"]==1) : ?>
						<th><a class="btn btn-lg btn-primary" role="button" <?php echo 'href="'.base_url('index.php/user_controller/admin/ban').'/'.$user_found["username"].'"';?>>Banear</a></th>
						<?php else : ?>
						<th></th>
						<?php endif;?>
						<th><?php echo anchor('user_controller/user_publications/'.$user_found["username"], 'Ver Publicaciones', array('class' => 'btn btn-lg btn-primary') )?></th>
						
					</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	</div>