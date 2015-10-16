<!DOCTYPE html>
<?php session_start()?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Enlaces - Ajedrez Fcfm</title>
	

	
	<!-- Latest compiled and minified CSS (Bootstrap)-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- General Custom Style -->
	<link href="default.css" rel="stylesheet">
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php require_once 'utils.php';?>
</head>

<body>
<?php addNavBar();?>
	
<div class="container">
	<div class=page-header>	
		<h1>Enlaces</h1>
	</div>
		
		
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse1">Universidad de Chile</a>
		      	</h4>
		    </div>
		    <div id="collapse1" class="panel-collapse collapse">
		      <ul class="list-group">
		        <li class="list-group-item"><a href="http://ingenieria.uchile.cl/facultad/estructura/94684/area-de-deportes-recreacion-y-cultura">Área de Deportes FCFM</a></li>
		        <li class="list-group-item"><a href="http://deporteazul.cl/noticias/">Deporte Azul</a></li>
		      </ul>
		    </div>
		  </div>
	</div>
	
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse2">Jugar Ajedrez Online</a>
		      	</h4>
		    </div>
		    <div id="collapse2" class="panel-collapse collapse">
		      <ul class="list-group">
		        <li class="list-group-item"><a href="www.chessclub.com/">Internet Chess Club (ICC)</a></li>
		        <li class="list-group-item"><a href="http://www.chess.com">Chess.com </a></li>
		      </ul>
		    </div>
		  </div>
	</div>
	
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse3">Ajedrez en Chile</a>
		      	</h4>
		    </div>
		    <div id="collapse3" class="panel-collapse collapse">
		      <ul class="list-group">
		        <li class="list-group-item"><a href="http://www.fenach.cl">Federación Nacional de Ajedrez de Chile</a></li>
		        <li class="list-group-item"><a href="http://www.clubajedrezchile.cl/">Club de Ajedrez Chile</a></li>
		        <li class="list-group-item"><a href="http://www.ajedrezchileno.cl">Ajedrez Chileno.</a></li>
		        <li class="list-group-item"><a href="http://www.ajefech.cl/">Ajedrez Federado de Chile</a></li>
		        <li class="list-group-item"><a href="http://www.fundaciondeajedrez.cl/">Fundación chilena de Ajedrez</a></li>
		      </ul>
		    </div>
		  </div>
	</div>
	
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse4">Ajedrez Internacional</a>
		      	</h4>
		    </div>
		    <div id="collapse4" class="panel-collapse collapse">
		      <ul class="list-group">
		        <li class="list-group-item"><a href="http://www.chess-results.com/">Chess Results</a></li>
		        <li class="list-group-item"><a href="http://www.chess24.com/">Chess 24</a></li>
		      </ul>
		    </div>
		  </div>
	</div>
	
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse4">Software Ajedrez</a>
		      	</h4>
		    </div>
		    <div id="collapse4" class="panel-collapse collapse">
		      <ul class="list-group">
		        <li class="list-group-item"><a href="https://stockfishchess.org/">Stockfish</a></li>
		      </ul>
		    </div>
		  </div>
	</div>
	
</div>
</body>
</html>