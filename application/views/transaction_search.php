	<div id="content">
		<div class=page-header>
			<h1>Ver Últimas Transacciones</h1>
		</div>
		<div>
			<?php echo form_open('publication_controller/transactions', array('class' => 'form-horizontal'));?>
				<div class="form-group">
					<label class="control-label col-sm-2" for="filter">Filtrar por Autor:</label>
					<div class="col-sm-10">
						<input name="filter" type="text" class="form-control" id="filter" placeholder="Ej: Juan">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="transactionType">Número de Resultados:</label>
					<div class="col-sm-10">
						<select class="form-control" id="transactionType" name="transactionType">
							<option value="comment">Comentarios</option>
							<option value="news">Noticias</option>
							<option value="event">Eventos</option>
							<option value="matchboard">Partidas</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="maxResults">Número de Resultados:</label>
					<div class="col-sm-10">
						<select class="form-control" id="maxResults" name="maxResults">
							<option>5</option>
							<option selected="selected">10</option>
							<option>25</option>
							<option>50</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Ir</button>
			    	</div>
			  	</div>
			</form>
		</div>
	</div>