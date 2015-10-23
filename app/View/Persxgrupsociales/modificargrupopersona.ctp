<?php echo $this->Html->script(array('/js/persxgrupsociales/editgrup.js','fmensajes.js','fgenerales.js','jquery.toastmessage','jquery-ui.min'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css(array('message'), null, array('inline' => false))?>
<style>
	  ul { list-style-type: none; }
</style>
<?php echo $this->element('flash_message')?>
<fieldset>
	<legend>		<?php echo __('Modificar Grupo Social') ?></legend>
							<?php
							$li='';
							$listname='';
							$objname='';
							$i=0;
							$col=0;
	
							foreach($gruposocialpersonas as $gruposocialpersona):?>
							<?php if($col == 0):?>
							<div class='row'>	
							<?php endif;?>
							<div class="col-lg-4">	
								<?php $listname= $listname.$li.'#'.$gruposocialpersona['Grupsociale']['id'].'G'.$i.' li';?>
								<?php $objname=$objname.$li.'#'.$gruposocialpersona['Grupsociale']['id'].'G'.$i; ?>
								<ul id="<?php echo $gruposocialpersona['Grupsociale']['id'].'G'.$i?>">
									<div class="alert alert-success" role="alert"><i class="fa fa-users fa-fw"></i>&nbsp<?php echo $gruposocialpersona['Afinidade']['descrip']?></div>
								<?php foreach($gruposocialpersona as $grupsociale):?>
									<?php if(!empty($grupsociale['Persona']['apellido'])):?>
										<li id="<?php echo $grupsociale['Grupsociale']['id']?>-<?php echo $grupsociale['Persona']['id']?>">
											<div class="alert alert-info" role="alert" id="det<?php echo $grupsociale['Persxgrupsociale']['id'] ?>">
												<div class='row'>
													<div class="col-lg-8">
														<i class="fa fa-user fa-fw"></i>&nbsp;
														<?php echo $grupsociale['Persona']['apellido'].', '.$grupsociale['Persona']['nombre']?>
													</div>
													<div class="col-lg-1">
														<button type="button" class="btn btn-danger btn-lw" id='borrar' onclick='borrarpersonagrupo(<?php echo $grupsociale['Persxgrupsociale']['id'] ?>,<?php echo $grupsociale['Persxgrupsociale']['persona_id']?>)'>
				  												<span class="glyphicon glyphicon-trash"></span>&nbsp;
														</button>
													</div>
												</div>	
											</div>
										</li>
									<?php endif;?>	
								<?php endforeach;?>
								</ul>
							</div>
							<?php if($col == 2):?>
							</div>
							<?php endif;?>
							
							
						<?php
							if($col == 2) 
								$col=0;
							else
								$col++;
							$li=',';
							$i++;
							
							endforeach;?>
</fieldset>		
<div class="row">	
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
		</button>	
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>

<!-- save sort order here which can be retrieved on server on postback -->
<script type="text/javascript">
		var listname='<?php echo $listname?>'
		var objname='<?php echo $objname?>'
</script>