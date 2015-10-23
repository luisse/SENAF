
<?php $i=0;?>
<?php foreach($seguimiento as $detalle):?>
		<?php $refcollapse = 'collapseOne'.$i?>
			<div class="panel panel-personas">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			      	<i class="fa fa-plus-square fa-lg"></i>
			        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $refcollapse ?>">
			          <?php echo $detalle['persona']['Persona']['apellido'].', '.$detalle['persona']['Persona']['nombre']; ?>&nbsp;
			        </a>
			      </h4>
			    </div>
			    <div id="<?php echo $refcollapse ?>" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<!-- GRUPOS SOCIALES ASOCIADOS A LA PERSONA -->
			      	<div class="table-responsive">
			  			<?php
			  				if(!empty($detalle['archivo']))
			  					$archivoimagen = $detalle['archivo']; 
							else
								$archivoimagen=array();

			  				if(empty($archivoimagen)): ?>
								<a href="#" class="thumbnail">
					  			<?php
					  				echo $this->Html->image('user_not.jpeg',
												array ('title' =>__('Sin Imagen de '.$detalle['persona']['Persona']['apellido'].', '.$detalle['persona']['Persona']['nombre']),
														'class'=>'img-rounded',
														'width'=>'160px','height'=>'160px'));
					  			?>
								</a>
				  			<?php endif;?>
				  			<?php if(!empty($archivoimagen)): ?>
									<a href="#" class="thumbnail">
											<img width='160px' height='160px' src="<?php echo $archivoimagen['Archivo']['archivo']; ?>"/>
									</a>
				  			<?php endif;?>			      	
				  		</div>
								      
					<div class="panel panel-primary">
					  <div class="panel-heading"><?php echo __('Grupos Sociales Asociado')?></div>
					  <div class="panel-body">
					  </div>
			      	<!-- GRUPOS SOCIALES ASOCIADOS A LA PERSONA -->
			      	<div class="table-responsive">
					<?php foreach($detalle['gruposocialpersona'] as $gruposociale):?>
			      		<table class="table  table-hover">	
			      			<thead>
			      			<tr>
			      				<th>
			      				<?php echo $gruposociale['Grupsociale']['id'].'-'.$gruposociale['Afinidade']['descrip']?>
			      				</th>
			      			</tr>
			      			</thead>
			      			<tbody>
			      				<?php foreach($gruposociale as $personas):?>
			      					<?php if(!empty($personas['Persona']['apellido'])):?>
			      					<tr>
			      						<td><?php echo $personas['Persona']['apellido'].', '.$personas['Persona']['nombre']?></td>
			      					</tr>
			      					<?php endif;?>
			      				<?php endforeach;?>
			      			</tbody>
			      		</table>
			      	<?php endforeach;?>
			      	</div>
					</div>
					<!-- PANEL GRUPOS ASOCIADOS -->
					<div class="panel panel-success">
					  <div class="panel-heading"><?php echo __('Domicilios Asociados a Grupos')?></div>
					  <div class="panel-body">
					  </div>
	 			      	<!-- DOMICILIOS -->
	 			      	<div class="table-responsive">
				      	<?php foreach($detalle['domicilios'] as $domicilios):?>
				      		<?php //print_r($domicilios)?>
				      		<table class="table  table-hover">	
				      			<thead>
				      			<tr>
				      				<th>
				      				<?php echo $domicilios['Grupsociale']['id'].'-'.$domicilios['Afinidade']['descrip']?>
				      				</th>
				      			</tr>
				      			</thead>
				      			<tbody>
				      				<?php foreach($domicilios as $domicilio):?>
				      				<?php if(!empty($domicilio['Calle']['descrip'])):?>
				      					<tr>
				      						<td><?php echo $domicilio['Calle']['descrip'].' - '.$domicilio['Domicilio']['nro'] ?></td>
				      					</tr>
				      				<?php endif;?>
				      				<?php endforeach;?>
				      			</tbody>
				      		</table>
				      	<?php endforeach;?>
				      	</div>
  				</div>
					<div class="panel panel-info">
					  <div class="panel-heading"><?php echo __('Vinculos')?></div>
					  <div class="panel-body">
					  </div>
	 			      	<!-- VINCULOS -->
			      		<table class="table  table-hover">	
			      			<thead>
			      			<tr>
			      				<th>
				      				<?php //echo 'Vinculos'?>
			      				</th>
			      				<th>
				      				<?php //echo 'Vinculos'?>
			      				</th>
			      				<th>
				      				<?php //echo 'Vinculos'?>
			      				</th>
				      		</tr>
				      		</thead>
				      		<tbody>
				      	<?php foreach($detalle['vinculos'] as $vinculoper):?>
							<tr>
							<td><?php echo $vinculoper['Personaizq']['apellido'].', '.$vinculoper['Personaizq']['nombre']; ?></td>
							<td><?php echo $vinculoper['Parentesco']['descrip']; ?></td>
							<td><?php echo $vinculoper['Personadrch']['apellido'].', '.$vinculoper['Personadrch']['nombre']; ?></td>
							</tr>
						<?php endforeach;?>
				      			</tbody>
				      		</table>
	  				</div>
			      </div>
			    </div>
			 </div>
<?php 
	$i++;
	endforeach;
?>
