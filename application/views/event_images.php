

	<table class="table table-hover">
		<tr>
			<td><h1><?php echo $image["title"];?></h1></td>
		</tr>
		<tr>
			<td><?php echo img(getEventImagePath($image["image_filename"]), false, array('class' => 'news-image'));?></td>
		</tr>
		<tr>
			<td>Publicado por <?php echo anchor('/user_controller/user_profile/'.$image["id_user"], $image["first_name"].' '.$image["last_name"]);?> el <?php echo($image["publicationDate"]);?></td>
		</tr>
	</table>