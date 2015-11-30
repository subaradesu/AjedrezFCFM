	<script type="text/javascript">
		function origin_select(){
		f = document.getElementById("origin");
		if(f.value == -1){
			window.location = "<?php echo site_url().'/main_controller/boardgames/';?>";
		}
		else {
			window.location = "<?php echo site_url().'/main_controller/boardgames_by_origin/';?>"+f.value;	
		}
	};
	</script>
	<?php 
		function reorder($n){
			foreach ($n as $m){
				$array[$m["match_origin"]] = $m["quantity"];
			}
			return $array;
		}
		if(isset($boardgames["selected"])){
			$origin_id = $boardgames["selected"];
		}
		else{
			$origin_id=-1;
		}
		if(isset($boardgames["categories"])){
			$categories = reorder($boardgames["categories"]);
		}
		else{
			$categories=array(0,0,0,0,0,0,0);
		}
		unset($boardgames["categories"]);
		unset($boardgames["selected"]);
		$types = array(
			0 => "Partida didáctica (Libro)",
			1 => "Campeonato Internacional",
			2 => "Campeonato Nacional",
			3 => "TIF Interfacultades",
			4 => "Torneo FCFM",
			5 => "Amistoso",
			6 => "Otro");
	?>
		<div id="content">
		<div class=page-header>
			<h1>Partidas Publicadas:</h1>
			<select name="origin" class="form-control" id="origin" onchange="javascript:origin_select();">
				<option value="-1" name="All">Todas las Categorías visibles por el usuario</option>
				<?php foreach ($types as $i => $category):
					$quantity = 0;
					if(isset($categories[$i])) $quantity=$categories[$i];
					if($origin_id == $i)
						echo '<option value="'.$i.'" name="'.$category.'" selected>'.$category.' ['.$quantity.']</option>';
						else
							echo '<option value="'.$i.'" name="'.$category.'">'.$category.' ['.$quantity.']</option>';
					endforeach;?>
				</select>
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
						<th><?php echo anchor('publication_controller/view_boardgame/'.$boardgame["id_matchboard"], $boardgame["title"]);?></th>
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