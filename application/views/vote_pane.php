	<div class="col-sm-12 vote-pane">
		<p>¿Qué te parece la publicación? Ayúdanos a mejorar votando!
		<?php
		$up = $up = array('class' => 'btn btn-sm btn-primary thumbs-up-unmarked');
		$down = array('class' => 'btn btn-sm btn-primary thumbs-down-unmarked');
		if ($vote == 1){
			$up = array('class' => 'btn btn-sm btn-primary thumbs-up-marked');
		}
		elseif ($vote == -1){
			$down = array('class' => 'btn btn-sm btn-primary thumbs-down-marked');
		}
		?>
		<?php echo anchor('publication_controller/vote_publication/'.$my_id.'/1', '<span class="glyphicon glyphicon-thumbs-up"></span>', $up);?>
		<a class="btn btn-sm btn-default"><?php echo $score;?></a>
		<?php echo anchor('publication_controller/vote_publication/'.$my_id.'/-1', '<span class="glyphicon glyphicon-thumbs-down"></span>', $down);?>
		</p>
	</div>