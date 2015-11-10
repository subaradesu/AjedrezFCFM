	<div id="content">
		<div class=page-header>
			<h1>Resultados:</h1>
		</div>
		<div class="container">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($search_result as $user_found) :?>
					<tr>
						<th><?php echo anchor('main_controller/user_profile/'.$user_found["username"], $user_found["first_name"].' '.$user_found["last_name"]);?></th>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>