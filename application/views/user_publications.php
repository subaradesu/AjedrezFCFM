	<div id="content">
		<div class=page-header>
			<h1>Eventos:</h1>
		</div>
		<div class="container">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($events as $anevent) :?>
					<tr>
						<th><?php echo anchor('publication_controller/view_event/'.$anevent["id_publication"], $anevent["title"]);?></th>
						<th><?php echo anchor('user_controller/user_publications/'.$anevent["id_user"].'/'.$anevent["id_publication"].'/delete', 'Borrar Publicación', array('class' => 'btn btn-lg btn-primary') )?></th>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
		
		<div class=page-header>
			<h1>Noticias:</h1>
		</div>
		<div class="container">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($news as $anew) :?>
					<tr>
						<th><?php echo anchor('publication_controller/view_new/'.$anew["id_new"], $anew["title"]);?></th>
						<th><?php echo anchor('user_controller/user_publications/'.$anew["id_user"].'/'.$anew["id_publication"].'/delete', 'Borrar Publicación', array('class' => 'btn btn-lg btn-primary') )?></th>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>