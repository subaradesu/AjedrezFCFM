		<?php //acá va el contenido del comentario, recibe $id_comment, $username, $score?>
		<!-- Acá comienza el comentario -->
			<div class="media">
				<div class="media-heading">
					<button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapse<?php echo $id_comment;?>" aria-expanded="false" aria-controls="collapseExample">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
					<span class="label label-info"><?php echo $score;?></span> <?php echo anchor('/user_controller/user_profile/'.$id_publisher, $publisher);?> 12 hours ago
				</div>
				
				<div class="panel-collapse collapse in" id="collapse<?php echo $id_comment;?>">
					<div class="media-left">
						<div class="vote-wrap">
							<div class="save-post">
								<a href="#"><span class="glyphicon glyphicon-star" aria-label="Save"></span></a>
							</div>
							<div class="vote up">
								<?php
								$up_arrow = array('class' => $vote > 0 ? 'flechita-up-mark' : 'flechita-up-unmark');
								echo anchor('/publication_controller/vote_publication/'.$id_comment.'/'.'1', '<i class="glyphicon glyphicon-arrow-up"></i>', $up_arrow);
								?>
							</div>
							<div class="vote inactive">
								<?php
								$down_arrow = array('class' => $vote < 0 ? 'flechita-down-mark' : 'flechita-down-unmark');
								echo anchor('/publication_controller/vote_publication/'.$id_comment.'/'.'-1', '<i class="glyphicon glyphicon-arrow-down"></i>', $down_arrow);
								?>
							</div>
						</div>
					</div>
					<div class="media-body">
						<p><?php echo $content;?></p>
						<div class="comment-meta">
							<span><a >reportar</a></span>
							<span><a >ocultar</a></span>							
							<span>
								<a class="" role="button" data-toggle="collapse" href="#replyComment<?php echo $id_comment;?>" aria-expanded="false" aria-controls="collapseExample">responder</a>
							</span>
							<div class="collapse" id="replyComment<?php echo $id_comment;?>">
								<?php echo form_open('publication_controller/publish_comment/'.$id_comment, array('class' => 'form-comment'));?>
									<div class="form-group">
										<label for="comment">Tu comentario</label>
										<textarea name="comment" class="form-control" rows="3"></textarea>
									</div>
									<button type="submit" class="btn btn-default">Enviar</button>
								</form>
							</div>
						</div>
					</div>
		