<!-- Support libraries from Yahoo YUI project -->  
<script type="text/javascript"  
    src="http://chesstempo.com/js/pgnyui.js">  
</script>   
<script type="text/javascript"  
    src="http://chesstempo.com/js/pgnviewer.js">  
</script>  
<link  
 type="text/css"   
 rel="stylesheet"   
 href="http://chesstempo.com/css/board-min.css">  
</link> 
<script>  
new PgnViewer({ boardName: "demo",  
    <?php 
    if($data_boardgame["format"]==0){
    	echo "pgnFile: 'pgn/Kramnik - Annotated Chess Games.pgn',";
    }
    else{
    	echo "pgnString: '".$data_boardgame["pgn_string"]."'";
    }
    ?>
    pieceSet: 'leipzig',   
    pieceSize: 46  
  }  
);  
</script>  

	<div id="content">
		<div class=page-header>
			<h1>Partida:</h1>
		</div>
		<table width="100%">
			<tr >
				<th class"col-sm-offset-2">Título:</th>
				<td class"col-sm-offset-10">Partida de Prueba</td>
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
				<td class"col-sm-offset-10"><?php echo($data_boardgame["match_origin"]);?></td>
			</tr>	
			<tr >
				<th class"col-sm-offset-2">Detalles:</th>
				<td class"col-sm-offset-10"><?php echo($data_boardgame["details"]);?></td>
			</tr>	
			<tr >
				<th class"col-sm-offset-2">Tablero:</th>
				<td><div id="demo-container"></div>  
				<div id="demo-moves"></div> 
				</td>
			</tr>	

		</table>
	</div>