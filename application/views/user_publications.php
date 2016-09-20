	<div id="content">
		<div class=page-header>
			<h1>Eventos:</h1>
		</div>
		<div class="wrapper">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Tipo</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($events as $anevent) :?>
					<tr>
						<th><?php echo anchor('publication_controller/view_event/'.$anevent["id_publication"], $anevent["title"]);?></th>
						<th>Evento</th>
						<?php if ($_SESSION["permission"] == 3) : ?>
						<th><?php echo anchor('user_controller/user_publications/'.$anevent["id_user"].'/'.$anevent["id_publication"].'/delete', 'Borrar Publicación', array('class' => 'btn btn-sm btn-primary') )?></th>
						<?php endif;?>
					</tr>
				<?php endforeach;?>
				<?php foreach ($news as $anew) :?>
					<tr>
						<th><?php echo anchor('publication_controller/view_new/'.$anew["id_new"], $anew["title"]);?></th>
						<th>Noticia</th>
						<?php if ($_SESSION["permission"] == 3) : ?>
						<th><?php echo anchor('user_controller/user_publications/'.$anew["id_user"].'/'.$anew["id_publication"].'/delete', 'Borrar Publicación', array('class' => 'btn btn-sm btn-primary') )?></th>
						<?php endif;?>
					</tr>
				<?php endforeach;?>
				<?php foreach ($games as $game) :?>
					<tr>
						<th><?php echo anchor('publication_controller/view_boardgame/'.$game["id_matchboard"], $game["title"]);?></th>
						<th>Partida</th>
						<?php if ($_SESSION["permission"] == 3) : ?>
						<th><?php echo anchor('user_controller/user_publications/'.$game["id_user"].'/'.$game["id_publication"].'/delete', 'Borrar Publicación', array('class' => 'btn btn-sm btn-primary') )?></th>
						<?php endif;?>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>