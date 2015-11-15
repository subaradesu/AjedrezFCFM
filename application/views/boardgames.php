		<div id="content">
		<div class=page-header>
			<h1>Partidas Publicadas:</h1>
		</div>
		<div class="container">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Título</th>
						<th>Descripción</th>
						<th>Tipo</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($boardgames as $boardgame) :?>
					<tr>
						<th><?php echo anchor('publication_controller/view_boardgame/'.$boardgame["matchboard_id"], $boardgame["title"]);?></th>
						<th><?php echo $boardgame["details"];?></th>
						<th>				<?php 
					switch($boardgame["match_origin"]){
					case 0: echo "Partida didáctica (Libro)"; break;
					case 1: echo "Campeonato Internacional"; break;
					case 2: echo "Campeonato Nacional"; break;
					case 3: echo "TIF Interfacultades"; break;
					case 4: echo "Torneo FCFM"; break;
					case 5: echo "Amistoso"; break;
					case 6: echo "Otro"; break;
				}?></th>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>