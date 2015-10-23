<?php echo $this->Html->script(array('/js/personas/seleccionapersona.js'),array('block'=>'scriptjs'));?>
<script>
	var personaslink="<?php echo $this->Html->url(array('controller'=>'personas','action'=>'listpersonassel')) ?>";
	<?php if(empty($rowpos)): ?>
		var rowpos='';
	<?php endif; ?>	
	<?php if(!empty($rowpos)): ?>
		var rowpos=<?php echo $rowpos;?>
	<?php endif; ?>		
</script>
<?php echo $this->element('modalboxcabecera',array('title'=>'Seleccionar Persona','paneltipo'=>'panel-primary'));?>
<div class="table-responsive">
	<ul class="nav nav-tabs" id='myTab'>
		<li class="active"><a href="#tabs-1"   data-toggle="tab"><?php echo __('Filtros de Busqueda') ?></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabs-1">
			<div class="panel panel-default">
				<form id="filterpersona" accept-charset="utf-8" method="" action="#">
				<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>    
				<div class="row">
					<div class="col-lg-3">
						<?php echo $this->Form->input('Persona.nrodoc', array(
							'label' => __('Documento'),
							'placeholder' => __('Nro. Documento'),
							'class'=>'form-control input-sm',
							'size'=>5
						)); ?>	
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
						<div class="col-lg-2">			
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
					<div class="col-lg-4">
					<?php echo $this->Form->input('Persona.apellido', array(
						'label' => __('Apellido'),
						'placeholder' => __('Apellido'),
						'class'=>'form-control input-sm',
						'size'=>30
					)); ?>			
					</div>
					<div class="col-lg-4">
					<?php echo $this->Form->input('Persona.nombre', array(
						'label' => __('Nombre '),
						'placeholder' => __('Nombre'),
						'class'=>'form-control input-sm',
						'size'=>30
					)); ?>		
					</div>
					<div class="col-lg-3">
						<br>
						<button type="button" class="btn btn-info btn-lw" id='buscarpersonas'>
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</div>
				</div>
				<?php echo $this->Form->end()?>
			</div>
		</div>
	</div>
	<div id='cargandodatosp' style='display:none;top: 50%;left: 50%;text-align:center'>
		<?php echo $this->Html->image('carga.gif')?>
	</div>	
	<div id='listarpersonas'>
	</div>	
</div>

<?php echo $this->element('modalboxpie');?>
