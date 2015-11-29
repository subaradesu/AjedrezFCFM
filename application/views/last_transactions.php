	
	<div id="content">
		<div class=page-header>
			<h1>Ver Transacciones:</h1>
		</div>
		<div class="news-wrapper">
			<table class="table table-hover">
				<thead>
					<tr>
						<?php if($type == "comment") : ?>
						<th>Tipo</th>
						<th>Id</th>
						<th>Publisher</th>
						<th>Contenido</th>
						<th>Fecha de Publicación</th>
						<th>Respuesta a</th>
						<?php elseif($type == "news") : ?>
						<th>Tipo</th>
						<th>Título</th>
						<th>Id</th>
						<th>Publisher</th>
						<th>Fecha de Publicación</th>
						<?php elseif($type == "event") : ?>
						<th>Tipo</th>
						<th>Título</th>
						<th>Id</th>
						<th>Publisher</th>
						<th>Fecha de Publicación</th>
						<th>Visibilidad</th>
						<th>Estado</th>
						<?php elseif($type == "matchboard") : ?>
						
						<?php endif;?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($transactions as $t):?>
					<tr>
						<?php if($type == "comment") : ?>
						<th>Comentario</th>
						<th><?php echo $t["id_comment"];?></th>
						<th><?php echo $t["id_user"];?></th>
						<th><?php echo $t["content"];?>
						<th><?php echo $t["publicationDate"];?></th>
						<th><?php echo $t["commented_publication"];?></th>
						<?php elseif($type == "news") : ?>
						<th>Noticia</th>
						<th><?php echo $t["title"];?></th>
						<th><?php echo $t["id_new"];?></th>
						<th><?php echo $t["id_user"];?></th>
						<th><?php echo $t["publicationDate"];?></th>
						<?php elseif($type == "event") : ?>
						<th>Evento</th>
						<th><?php echo $t["title"];?></th>
						<th><?php echo $t["id_event"];?></th>
						<th><?php echo $t["id_user"];?></th>
						<th><?php echo $t["publicationDate"];?></th>
						<th><?php echo $t["visibility"];?></th>
						<th><?php echo $t["status"];?></th>
						<?php elseif($type == "matchboard") : ?>
						<?php endif;?>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>