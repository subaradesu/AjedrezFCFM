	
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
						<?php $d = date_create_from_format('Y-m-d H:i:s', $event["event_data"]["date_start"]);?>
						<time datetime="2014-07-20 2000">
							<span class="day"><?php echo $d->format('d');?></span>
							<span class="month"><?php echo $d->format('M');?></span>
							<span class="year"><?php echo $d->format('Y');?></span>
							<span class="time"><?php echo $d->format('H:i a');?></span>
						</time>
					
						<?php echo img('/img/avatar/avatar0.jpg', false, array('class' => 'event_cover'));?>
						
						<div class="info">
							<h2 class="title"><?php echo anchor('publication_controller/view_event/'.$event["event_data"]["id_event"], $event["event_data"]["title"]);?></h2>
							<p class="desc"><?php echo $event["event_data"]["description"];?></p>
							<ul>
								<?php if($event["event_data"]["status"] != 'closed') :?>
								<li style="width:33%;"><?php echo anchor('publication_controller/event_assistance/'.$event["event_data"]["id_event"].'/confirmed', ''.$event["assistance"]["confirmed"].' <span class="glyphicon glyphicon-ok"></span>');?></li>
								<li style="width:34%;"><?php echo anchor('publication_controller/event_assistance/'.$event["event_data"]["id_event"].'/unconfirmed', ''.$event["assistance"]["unconfirmed"].' <span class="glyphicon glyphicon-remove"></span>');?></li>
								<li style="width:33%;"><?php echo $event["comment_number"];?> <span class=" glyphicon glyphicon-envelope"></span></li>
								<?php else :?>
								<li style="width:33%;"><?php echo $event["assistance"]["confirmed"].' <span class="glyphicon glyphicon-ok"></span>';?></li>
								<li style="width:34%;"><?php echo $event["assistance"]["unconfirmed"].' <span class="glyphicon glyphicon-remove"></span>';?></li>
								<li style="width:33%;"><?php echo $event["comment_number"];?> <span class=" glyphicon glyphicon-envelope"></span></li>
								<?php endif;?>
							</ul>
						</div>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>