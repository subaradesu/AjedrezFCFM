<!-- Support libraries from Yahoo YUI project -->  
<script type="text/javascript"  
    src="<?php echo base_url().'/chessboard/http_chesstempo.com_js_pgnyui.js'; //"http://chesstempo.com/js/pgnyui.js";?>">  
</script>   
<script type="text/javascript"  
    src="<?php echo base_url().'/chessboard/http_chesstempo.com_js_pgnviewer.js';//"http://chesstempo.com/js/pgnviewer.js"?>">  
</script>  
<link  
 type="text/css"   
 rel="stylesheet"   
 href="<?php echo base_url().'/chessboard/http_chesstempo.com_css_board-min.css'; //"http://chesstempo.com/css/board-min.css"?>">  
</link> 
<script>  
new PgnViewer({ boardName: "demo",  
    <?php 
    if($data_boardgame["format"]==0){
    	echo "pgnFile: '/AjedrezFCFM/boards/".$data_boardgame["pgn_board"]."',";/*.$data_boardgame["pgn_board"]."',";*/
    }
    else{
    	echo "pgnString: '".$data_boardgame["pgn_string"]."',";
    }
    ?>
    pieceSet: 'merida',   
    pieceSize: 46  
  }  
);  
</script>  

	<div id="content">
		<div class=page-header>
			<h1>Partida:</h1>
		</div>
		<table class="table table-hover">
			<tr >
				<th class"col-sm-offset-2">Título:</th>
				<td class"col-sm-offset-10"><?php echo($data_boardgame["title"]);?></td>
			</tr>
			<tr >
				<th class"col-sm-offset-2">Blancas:</th>
				<td class"col-sm-offset-10"><?php echo($data_boardgame["white_player"]);?></td>
			</tr>
			<tr >
				<th class"col-sm-offset-2">Negras:</th>
				<td class"col-sm-offset-10"><?php echo($data_boardgame["black_player"]);?></td>
			</tr>
			<tr >
				<th class"col-sm-offset-2">Origen:</th>
				<td class"col-sm-offset-10">
				<?php 
				switch($data_boardgame["match_origin"]){
					case 0: echo "Partida didáctica (Libro)"; break;
					case 1: echo "Campeonato Internacional"; break;
					case 2: echo "Campeonato Nacional"; break;
					case 3: echo "TIF Interfacultades"; break;
					case 4: echo "Torneo FCFM"; break;
					case 5: echo "Amistoso"; break;
					case 6: echo "Otro"; break;
				}?>
				</td>
			</tr>	
			<tr >
				<th class"col-sm-offset-2">Detalles:</th>
				<td class"col-sm-offset-10"><?php echo($data_boardgame["details"]);?></td>
			</tr>	
			<tr >
				<th class"col-sm-offset-2">Tablero:</th>
				<td class"col-sm-offset-10"><div id="demo-container"></div> 
				</td>
			</tr>	
			<tr >
				<th class"col-sm-offset-2">Publicado por:</th>
				<td class"col-sm-offset-10"><?php echo anchor('user_controller/user_profile/'.$data_boardgame["user"]["username"], $data_boardgame["user"]["first_name"]." ".$data_boardgame["user"]["last_name"]); ?></div>  
				<!--div id="demo-moves"></div--> 
				</td>
			</tr>

		</table>
	</div>