<div class="container">
<?php if(!empty($persona)){?>
			<div class="page-header">
				<h1 id="timeline"><?php echo __('')?></h1>
			</div>
			<ul class="timeline">
				<?php if(!empty($persona)): ?>
				<li>
				  <div class="timeline-badge"><i class="glyphicon glyphicon-user"></i></div>
				  <div class="timeline-panel">
					<div class="timeline-heading">
					  <h3 class="timeline-title"><?php echo __('Datos Personales')?></h3>
					</div>
					<div class="timeline-body">
					  <h4><?php echo __('Apellido y Nombre');?></h4><p><?php echo $persona['Persona']['apellido'].', '.$persona['Persona']['nombre']?></p>
					  <h4><?php echo __('Fecha de Nacimiento');?></h4><p><?php echo $this->Time->format('d/m/Y',$persona['Persona']['fnac'])?></p>
					  <h4><?php echo __('Tipo y Nro de Doc.');?></h4><p><?php echo $tipodocs[$persona['Tipdocxper'][0]['tipodoc_id']].' '. $persona['Tipdocxper'][0]['nrodoc']?></p>
					</div>
				  </div>
				</li>
				<?php endif; ?>
				<li class="timeline-inverted">
				  <div class="timeline-badge warning"><i class="glyphicon glyphicon-th"></i></div>
				  <div class="timeline-panel">
					<div class="timeline-heading">
					  <h3 class="timeline-title"><?php echo __('Grupo Social')?></h3>
					</div>
					<div class="timeline-body">
						<div class='row'>
							<div class="col-lg-6">
								<?php if(empty($persxgrupsociales)):?>
								<p><?php echo __('Persona no asignada a grupo social');?></p>
								<?php endif;?>
								<?php if(!empty($persxgrupsociales)):?>
								<p><?php echo __('Persona asignada a grupo social');?></p>
								<?php endif;?>
							</div>
							<div class="col-lg-1">
							  <div class="btn-group">
								<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
								  <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
								</button>
									<ul class="dropdown-menu" role="menu">
										<li>
										<?php 
										echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Asociar a Nuevo Grupo Social'),array('controller'=>'grupsociales',
											'action'=>'add',$persona['Persona']['id']),
											array('onclick'=>'','escape'=>false),
											'');?>
										</li>
										<li>
										<?php 
										echo $this->Html->link('<i class="fa fa-pencil-square-o fa-fw"></i>&nbsp;'.__('Actualizar Grupos'),array('controller'=>'persxgrupsociales',
											'action'=>'modificargrupopersona',$persona['Persona']['id']),
											array('onclick'=>'','escape'=>false),
											'');?>
										</li>
										
									</ul>
								</div>
							</div>
						</div>
						<?php if(!empty($gruposocialpersonas)):?>
							<?php foreach($gruposocialpersonas as $gruposocialpersona):?>
								<div class='row'>
									<div class="col-lg-6">
										<h5><span class="label label-success"><?php echo $gruposocialpersona['Grupsociale']['id'].'-'.$gruposocialpersona['Afinidade']['descrip']?></span><h5>
									</div>
									<div class="col-lg-1">
									  <div class="btn-group">
										<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
										  <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li>
												<?php
														echo $this->Html->link('<i class="fa fa-home fa-fw"></i>&nbsp;'.__('Agregar Domicilio'),array('controller'=>'domicilios',
															'action'=>'add',$gruposocialpersona['Grupsociale']['id']),
															array('onclick'=>'','escape'=>false),
														'');?>												
											</li>
											<li>
												<?php 
														echo $this->Html->link('<i class="fa fa-user fa-fw"></i>&nbsp;'.__('Agregar Persona'),array('controller'=>'persxgrupsociales',
															'action'=>'add',$gruposocialpersona['Grupsociale']['id']),
															array('onclick'=>'','escape'=>false),
												'');?>												
											</li>
											
										</ul>
									  </div>
									 </div>
									
								</div>
									<?php foreach($gruposocialpersona as $persxgrupsociale):?>
										<?php if(!empty($persxgrupsociale['Persona']['apellido'])):?>
										<div class='row'>
											<div class='col-lg-5'>
													<?php echo $this->Html->link($persxgrupsociale['Persona']['apellido'].', '.$persxgrupsociale['Persona']['nombre'],'#',
																			array('onclick'=>'return verPersona('.$persxgrupsociale['Persona']['id'].')')) ?>										
											</div>
										</div>
										<?php endif;?>
									<?php endforeach;?>
									<hr>
								<?php endforeach;?>
							<?php endif; ?>
					</div>
				  </div>
				</li>
				<li>
				  <div class="timeline-badge danger"><i class="glyphicon glyphicon-home"></i></div>
				  <div class="timeline-panel">
					<div class="timeline-heading">
					  <h3 class="timeline-title"><?php echo __('Domicilios')?></h3>
					</div>
					<div class="timeline-body">
					<?php if(empty($domicilios)):?>
					  <p><?php echo __('Persona Sin Domicilios Asociados') ?></p>
					<?php endif;?>				
					<?php if(!empty($domicilios)):?>
						<?php 
							$i=0;
							foreach($domicilios as $domicilio):?>
								<hr>
								<div class="row">
									<h5><span class="label label-success"><?php echo $domicilio['Grupsociale']['id'].'-'.$domicilio['Afinidade']['descrip']?></span></h5>
								</div>
								<?php foreach($domicilio as $dom):?>
										<?php if(!empty($dom['Calle']['descrip'])):?>
										  <div class="row" id="dom<?php echo $dom['Grupsocxdomi']['id']?>">
												<div class="col-lg-7">
												<?php echo $this->Html->link($dom['Calle']['descrip'].' - '.$dom['Domicilio']['nro'],'#',
																		array('onclick'=>'return verDomicilio('.$dom['Domicilio']['id'].')')) ?>
												</div>
												<div class="col-lg-1">
													  <div class="btn-group">
														<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
														  <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
														</button>
														<ul class="dropdown-menu" role="menu">
															<li>
																<?php 
																		echo $this->Html->link('<i class="fa fa-user fa-fw"></i>&nbsp;'.__('Actualizar Domicilio'),array('controller'=>'domicilios',
																			'action'=>'edit',$dom['Domicilio']['id']),
																			array('onclick'=>'','escape'=>false),
																'');?>												
															</li>
															<li>
																<?php 
																		echo $this->Html->link('<i class="fa fa-map-marker fa-fw"></i>&nbsp;'.__('Actualizar GPS Domicilio'),array('controller'=>'domicilios',
																			'action'=>'getlocalize',$dom['Domicilio']['id']),
																			array('onclick'=>'','escape'=>false),
																'');?>												
															</li>
																					
															<li>
																<?php 
																		echo $this->Html->link('<i class="fa fa-home fa-fw"></i>&nbsp;'.__('Borrar Domicilio'),'#',
																			array('onclick'=>'return borrarDomicilio('.$dom['Grupsocxdomi']['id'].')','escape'=>false));?>												
															</li>
														</ul>
													  </div>					
												</div>
										  </div>
										<?php endif;?>
								<?php endforeach; ?>
						<?php $i++;
								endforeach; ?>
					 <?php endif;?>
					</div>
				  </div>
				</li>
				<li  class="timeline-inverted">
				  <div class="timeline-badge info"><i class="glyphicon glyphicon-map-marker"></i></div>
				  <div class="timeline-panel">
					<div class="timeline-heading">
					  <h3 class="timeline-title"><?php echo __('Puntos GPS Activos')?></h3>
					</div>
					<div class="timeline-body">
						<?php if(empty($coordsxpersonas)):?>
							<p><?php echo __('Persona sin Coordenadas GPS Activas') ?></p>
						<?php endif; ?>
						<?php if(!empty($coordsxpersonas)):?>
							<p><?php echo __('Persona con Coordenadas GPS Activas') ?></p>
						<?php endif; ?>
					  <hr>
					  <div class="btn-group">
						<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
						  <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
						  <li>
							<?php 
							echo $this->Html->link('<i class="fa fa-map-marker fa-fw"></i>&nbsp;'.__('Coordenadas'),array('controller'=>'personas',
								'action'=>'getlocalize',$persona['Persona']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>
						</li>
						</ul>
					  </div>
					</div>
				  </div>
				</li>
				<li>
				  <div class="timeline-badge info"><i class="glyphicon glyphicon-th"></i></div>
				  <div class="timeline-panel">
					<div class="timeline-heading">
					  <h3 class="timeline-title"><?php echo __('Vinculo de Persona')?></h3>
					</div>
					<div class="timeline-body">
						<?php if(empty($vinculopers)):?>
							<p><?php echo __('Persona sin Vinculos') ?></p>
						<?php endif; ?>
						<?php if(!empty($vinculopers)):?>
							<p><?php echo __('Persona con Vinculos') ?></p>
						<?php endif; ?>
					  <div class="btn-group">
						<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
						  <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
						  <li>
							<?php 
							echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Agregar Vinculos'),array('controller'=>'vinculopers',
								'action'=>'add'),
								array('onclick'=>'','escape'=>false),
								'');?>
						</li>
						</ul>
						</div>
						
					  <hr>
						<?php foreach($vinculopers as $vinculoper):?>
						<div class="row">
							<div class="col-lg-5"><?php echo $vinculoper['Personaizq']['apellido'].', '.$vinculoper['Personaizq']['nombre']; ?></div>
							<div class="col-lg-2"><?php echo $vinculoper['Parentesco']['descrip']; ?></div>
							<div class="col-lg-5"><?php echo $vinculoper['Personadrch']['apellido'].', '.$vinculoper['Personadrch']['nombre']; ?></div>
						</div>
						<?php endforeach;?>
					  
					</div>
				  </div>
				</li>
				
			</ul>
<?php }else{?>
	<br>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>	
		<strong><?php echo __('Advertencia!')?></strong>&nbsp;<?php echo "No se recuperaron datos para los filtros seleccionados";?></div>
	</div>
<?php }?>
</div>