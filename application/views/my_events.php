	
	<div id="content">
		<?php //TODO: Hacer la vista más bonita?>
		<div class=page-header>
			<h1>Mis Eventos:</h1>
		</div>
		
		<div class="row">
			<div class="col-sm-12">
				<ul class="event-list">
					<?php foreach ($events as $event): ?>
					
					<li>
						<time datetime="2014-07-20 2000">
							<span class="day">20</span>
							<span class="month">Jan</span>
							<span class="year">2014</span>
							<span class="time">8:00 PM</span>
						</time>
					
						<?php echo img('/img/avatar/avatar0.jpg', false, array('class' => 'event_cover'));?>
						
						<div class="info">
							<h2 class="title"><?php echo anchor('publication_controller/view_event/'.$event["id_event"], $event["title"]);?></h2>
							<p class="desc"><?php echo $event["description"];?></p>
							<ul>
								<li style="width:33%;">1 <span class="glyphicon glyphicon-ok"></span></li>
								<li style="width:34%;">3 <span class="glyphicon glyphicon-remove"></span></li>
								<li style="width:33%;">103 <span class=" glyphicon glyphicon-envelope"></span></li>
							</ul>
						</div>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>