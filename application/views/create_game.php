<script type="text/javascript">
	
	function change_upload(){
		f = document.getElementById("format");
		if(f.selectedIndex == 0){
			document.getElementById("fileload").style.display="block";
			document.getElementById("fileToUpload").required = true;
			document.getElementById("stringload").style.display="none";
			document.getElementById("textToUpload").required = false;
			document.getElementById("textToUpload").value=null;
		}
		else {
			document.getElementById("fileload").style.display="none";
			document.getElementById("fileToUpload").required = false;
			document.getElementById("fileToUpload").value=null;
			document.getElementById("stringload").style.display="block";
			document.getElementById("textToUpload").required = true;
		}
	};
</script>	
	<div id="content">
		<div class=page-header>
			<h1>Nueva Partida:</h1>
		</div>
		<div>
			<p>Acá puedes publicar partidas para que sean visibles por cualquiera que esté inscrito en la página.</p>
			<p>Los campos con <span class="red-text">*</span> son obligatorios.</p>
		</div>
		<div class="col-sm-12">
			<!--form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"-->
			<?php echo form_open_multipart('main_controller/publish_game/', array('class' => 'form-horizontal', 'role' => 'form'));?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Título<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" id="title" placeholder="El título de tu publicación. Ej: Clase 1: Aperturas" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">Blancas<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="white" class="form-control" id="white" placeholder="Ej: Spassky, Boris V." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">Negras<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="black" class="form-control" id="black" placeholder="Fischer, Robert J." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="origin">Origen de la partida:<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<select name="origin" class="form-control" id="origin">
							<option value="0" name="libro">Partida didáctica (Libro)</option>
							<option value="1" name="internacional">Campeonato Internacional</option>
							<option value="2" name="nacional">Campeonato Nacional</option>
							<option value="3" name="universidad">TIF Interfacultades</option>
							<option value="4" name="facultad">Torneo FCFM</option>
							<option value="5" name="amistoso">Amistoso</option>
							<option value="6" name="otro">Otro</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="content">Detalles<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<textarea name="content" class="form-control" rows="4" id="content" placeholder="El contenido de la publicación." required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="format">Formato Partida:<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<select name="format" class="form-control" id="format" onchange="javascript:change_upload();">
							<option value="0">Archivo PGN</option>
							<option value="1" class="disabled">String PGN</option>
						</select>
					</div>
				</div>
				<div class="form-group" id="fileload" display="block">
					<label class="control-label col-sm-2" for="fileToUpload">Archivo<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="file" name="fileToUpload" id="fileToUpload" required>
					</div>
				</div>
				<div class="form-group" id="stringload" style="display:none">
					<label class="control-label col-sm-2" for="textToUpload">String PGN<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="textarea" name="textToUpload" id="textToUpload" class="form-control" rows="4" placeholder="Contenido de la partida">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Publicar Partida</button>
					</div>
				</div>
			</form>
		</div>
	</div>