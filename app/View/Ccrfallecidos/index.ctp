<?php echo $this->Html->script(array('/js/ccrfallecidos/index.js','fgenerales','jquery.toastmessage','jquery.numeric','fmensajes.js','dateformat.js','bootstrap-datetimepicker'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>

<script>
	var link="<?php echo $this->Html->url(array('controller'=>'ccrfallecidos','action'=>'listccrfallecidos')) ?>"
</script>
	
<?php echo $this->element('flash_message')?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Listados de Fallecidos Informados')?>    </div>
	<br>
<div class="panel-body">
    <div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtro Personas Fallecidas') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<?php echo $this->Form->create('Fallecidoccr',array('action'=>'#','id'=>'personafilter'));?>
					<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>    
					<div class="row">	
						<div class="col-lg-2">			
							<?php echo $this->Form->input('Persona.nrodoc', array(
									'label' => __('Documento '),
									'type'=>'text',
									'placeholder' => __('Nro de Documento'),
									'class'=>'form-control input-sm',
									'size'=>10
								))?>
						</div>
						<div  class="col-lg-4">
							<?php echo $this->Form->input('Persona.apellido', array(
									'label' => __('Apellido '),
									'placeholder' => __('Ingrese Apellido a Buscar'),
									'class'=>'form-control input-sm',
									'size'=>30
								))?>
						</div>
						<div class="col-lg-4">
							<?php echo $this->Form->input('Persona.nombre', array(
									'label' => __('Nombre '),
									'placeholder' => __('Ingrse Nombre a Buscar'),
									'class'=>'form-control input-sm',
									'size'=>30
								))?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">		
							<label><?php echo __('Fecha Fallece Desde')?></label>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
								<?php echo $this->Form->input('Persona.fecdesde',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
								</div>
							</div>
							</div>
							<div class="col-lg-8">			
								<label><?php echo __('Fecha Fallece Hasta')?></label>
								<div class="form-group">
								<div class="row">
								<div class="col-lg-3">
										<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
										<?php echo $this->Form->input('Persona.fechasta',array('label' =>false,
														'placeholder' => false,
														'class'=>'form-control input-sm',
														'type'=>'text',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
										</div>
									</div>
								<div class="col-lg-2">
									<button type="button" class="btn btn-info btn-lw" id='buscar'>
											<span class="glyphicon glyphicon-search"></span> <?php echo __('Buscar');?>
									</button>
								</div>
								</div>
										
								</div>
							</div>	
							<div class="col-lg-2">				
							</div>
						</div>    
				    </div>
				</div>
				<?php echo $this->Form->end()?>
			</div>
	<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
			<?php echo $this->Html->image('carga.gif')?>
	</div>		
	<div id='fallecidosccrs'></div>

	</div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
