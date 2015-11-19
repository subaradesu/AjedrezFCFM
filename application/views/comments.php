	<div class="container">
		<div class="post-comments">
		
<!-- 		Ingresar Comentarios -->
		<form>
			<div class="form-group">
			<label for="comment">Comentar</label>
			<textarea name="comment" class="form-control" rows="3"></textarea>
			</div>
			<button type="submit" class="btn btn-default">Enviar</button>
		</form>
		
<!-- 		Navegar en Comentarios -->
		<div class="comments-nav">
			<ul class="nav nav-pills">
				<li role="presentation" class="dropdown">
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
		
		<div class="row">
			<div class="media">
				<div class="media-heading">
					<button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseExample">
						<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
					<span class="label label-info">12314</span> terminator 12 hours ago
				</div>
				
				<div class="panel-collapse collapse in" id="collapseOne">
					<div class="media-left">
						<div class="vote-wrap">
							<div class="save-post">
								<a href="#"><span class="glyphicon glyphicon-star" aria-label="Save"></span></a>
							</div>
							<div class="vote up">
								<i class="glyphicon glyphicon-menu-up"></i>
							</div>
							<div class="vote inactive">
								<i class="glyphicon glyphicon-menu-down"></i>
							</div>
						</div>
					</div>
					<div class="media-body">
						<p>Este es el primer comentario!</p>
						<div class="comment-meta">
							<span><a href="#">borrar</a></span>
							<span><a href="#">reportar</a></span>
							<span><a href="#">ocultar</a></span>
							<span>
								<a class="" role="button" data-toggle="collapse" href="#replyCommentT" aria-expanded="false" aria-controls="collapseExample">responder</a>
							</span>
							<div class="collapse" id="replyCommentT">
								<form>
									<div class="form-group">
										<label for="comment">Your Comment</label>
										<textarea name="comment" class="form-control" rows="3"></textarea>
									</div>
									<button type="submit" class="btn btn-default">Send</button>
								</form>
							</div>
						</div>
					</div>
					
<!-- 					Inner Comentario -->
					<div class="media">
						<div class="media-heading">
							<button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseExample">
								<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
							</button>
							<span class="label label-info">12314</span> terminator 12 hours ago
						</div>
						
						<div class="panel-collapse collapse in" id="collapseFour">
							<div class="media-left">
								<div class="vote-wrap">
									<div class="save-post">
										<a href="#"><span class="glyphicon glyphicon-star" aria-label="Save"></span></a>
									</div>
									<div class="vote up">
										<i class="glyphicon glyphicon-menu-up"></i>
									</div>
									<div class="vote inactive">
										<i class="glyphicon glyphicon-menu-down"></i>
									</div>
								</div>
							</div>
						
						
						<div class="media-body">
							<p>Este es el segundo comentario!</p>
							<div class="comment-meta">
								<span><a href="#">borrar</a></span>
								<span><a href="#">reportar</a></span>
								<span><a href="#">ocultar</a></span>
								<span>
									<a class="" role="button" data-toggle="collapse" href="#replyCommentT" aria-expanded="false" aria-controls="collapseExample">responder</a>
								</span>
								<div class="collapse" id="replyCommentT">
									<form>
										<div class="form-group">
											<label for="comment">Your Comment</label>
											<textarea name="comment" class="form-control" rows="3"></textarea>
										</div>
										<button type="submit" class="btn btn-default">Send</button>
									</form>
								</div>
							</div>
						</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	</div>