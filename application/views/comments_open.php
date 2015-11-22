
	<?php //Recibe $id_publication la id de la publicación que se está comentando?>
	<div class="container">
		<div class="post-comments">
			
	<!-- Panel para Comentar -->
		<?php echo form_open('publication_controller/publish_comment/'.$id_publication, array('class' => 'form-comment'));?>
			<div class="form-group">
			<label for="comment">Comentar</label>
			<textarea name="comment" class="form-control" rows="3"></textarea>
			</div>
			<button type="submit" class="btn btn-default">Enviar</button>
		</form>
		
	<!-- Barra de Navegación en Comentarios -->
		<div class="comments-nav hidden">
			<ul class="nav nav-pills">
				<li role="presentation" class="dropdown hidden">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
					there are 2593 comments <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					<li><a href="#">Best</a></li>
					<li><a href="#">Hot</a></li>
					</ul>
				</li>
			</ul>
		</div>
		
	<!-- Abrir panel de Comentarios -->
		
		<div class="row">