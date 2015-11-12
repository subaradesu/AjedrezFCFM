		<div id="content">
		<div class=page-header>
			<h1>Noticias:</h1>
		</div>
		<div class="container">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Título</th>
						<th>Descripción</th>
						<th>Fecha de Publicación</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($publications as $new) :?>
					<tr>
						<th><?php echo anchor('main_controller/view_new/'.$new["idNew"], $new["title"]);?></th>
						<th><?php echo $new["content"];?></th>
						<th><?php echo $new["date"];?></th>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>