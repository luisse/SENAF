<?php echo $this->Html->script(array('/js/personas/index.js','jquery.toastmessage','jquery.numeric'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>	
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'personas','action'=>'listpersonas')) ?>"
</script>

<div class="panel panel-personas">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Listado de Personas')?>    </div>
	<br>
<div class="table-responsive">
<div class="panel-body">
    <div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtro Personas') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<!-- <form id="filteralumno" accept-charset="utf-8" method="post" action="#">  -->
					<?php echo $this->Form->create('User',array('action'=>'#','id'=>'personafilter'));?>
					<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>    
				<fieldset>
					<div class="row">	
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Persona.nrodoc', array(
									'label' => __('Documento '),
									'type'=>'text',
									'placeholder' => __('Nro de Documento'),
									'class'=>'form-control input-sm',
									'size'=>10
								))?>
						</div>
						<div  class="col-lg-1">
							<label><?php echo 'Es NN'?></label>
							<div class='checkbox'>
									<?php echo $this->Form->input('Persona.nn', array(
											'label' => false,
											'type'=>'checkbox'/*,
											'class'=>'form-control input-sm'*/
										))?>
							</div>
						
						</div> 						
						<div class="col-lg-1">			
							<?php echo $this->Form->input('Persona.id', array(
									'label' => __('Identificador'),
									'type'=>'text',
									'placeholder' => __('Identificador'),
									'class'=>'form-control input-sm',
									'size'=>5
								))?>
						</div>
						<div class="col-lg-4">			
							<?php echo $this->Form->input('Persona.detalle', array(
									'label' => __('Detalles Morfológicos'),
									'type'=>'text',
									'placeholder' => __('Detalles'),
									'class'=>'form-control input-sm',
									'size'=>5
								))?>
						</div>						
												
					</div>			
					<div class="row">
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
						<div  class="col-lg-2">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-search"></span> <?php echo __('Buscar');?>
							</button>
						</div>    
					    
				    </div>
				</div>
				</fieldset>
				<?php echo $this->Form->end()?>
			</div>
	</div>			
	<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
		<?php echo $this->Html->image('carga.gif')?>
	</div>		
	<div id='personas'></div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
