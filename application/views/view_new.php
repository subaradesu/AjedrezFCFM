	<div class="content">
		<div class=page-header>
			<h1><?php echo $data_new["title"];?>:</h1>
		</div>
		<table class="table table-hover">
			<tr>
				<td><?php echo img(getCoverPath($data_new["image_cover"]), false, array('class' => 'news-image'));?></td>
			</tr>
			<tr>
				<td><?php echo(str_replace('\r\n','<br>',($data_new["content"])));?></td>
			</tr>
			<tr>
				<td>Publicado por <?php echo 'mono';?> el <?php echo($data_new["date"]);?> en <?php echo($data_new["category"]);?></td>
			</tr>
		</table>
	</div>