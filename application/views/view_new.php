	<div class="content">
		<div class=page-header>
			<h1><?php echo $data_new["title"];?>:</h1>
		</div>
		<table class="table table-hover">
			<tr>
				<td><?php echo img(getCoverPath($data_new["image_cover"]), false, array('class' => 'news-image'));?></td>
			</tr>
			<tr>
				<td><?php echo $data_new["content"];?></td>
			</tr>
			<tr>
				<td>Publicado por <?php echo anchor('/user_controller/user_profile/'.$data_new["id_user"], $data_new["first_name"].' '.$data_new["last_name"]);?> el <?php echo($data_new["date"]);?> en la categoría: <?php echo($data_new["category"]);?></td>
			</tr>
		</table>
	</div>