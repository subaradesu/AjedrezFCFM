	<div id="content">
		<div class=page-header>
			<h1>Publicar Noticias:</h1>
		</div>
		<div>
			<p>Acá puedes publicar noticias para que sean visibles por cualquiera que acceda a la página.</p>
			<p>Los campos con <span class="red-text">*</span> son obligatorios.</p>
		</div>
		<div class="col-sm-12">
			<?php echo form_open_multipart('main_controller/publish_new/', array('class' => 'form-horizontal'));?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Título<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" id="title" placeholder="El título de la Noticia. Ej: 5° Torneo Internacional Beauchef 851." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">Portada<span class="red-text">*</span>:</label>
					<input type="file" name="image" class="col-sm-8" id="image" required>
<!-- 						<div class="btn btn-default btn-file form-control"> -->
<!-- 							Seleccionar... <input type="file" name="image" id="image" placeholder="Seleccione la imagen que desea utilizar." required> -->
<!-- 						</div> -->
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="category">Tipo de Publicacion:<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<select name="category" class="form-control" id="category">
							<option value="None">Ninguna</option>
							<option value="fcfm">Noticia Fcfm</option>
							<option value="nacional">Noticia Nacional</option>
							<option value="internacional">Noticia Internacional</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="content">Contenido<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<textarea name="content" class="form-control" rows="4" id="content" placeholder="El contenido de la publicación." required></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Publicar Noticia</button>
					</div>
				</div>
			</form>
		</div>
	</div>