<?php echo $this->Html->script(array('/js/vinculopers/index.js','jquery.toastmessage','jquery.numeric'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'vinculopers','action'=>'listvinculopers')) ?>"
</script>
<?php 
	$persona_nrodoc	 	= null;
	$persona_nombre 	= null;
	$persona_apellido 	= null;
	
	if(!empty($persona)){
		$persona_nombre 	= $persona['Persona']['nombre'];
		$persona_apellido 	= $persona['Persona']['apellido'];
		if(!empty($persona)){
			if(!empty($persona['Tipdocxper'][0]))
				$persona_nrodoc		= $persona['Tipdocxper'][0]['nrodoc'];
		}
	}
?>

<?php echo $this->element('flash_message')?>
<div class="panel panel-personas">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Vinculos')?>    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
    <div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtro Personas') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<?php echo $this->Form->create('User',array('action'=>'#','id'=>'personafilter'));?>
					<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>    
				<fieldset>
					<div class="row">	
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Persona.nrodoc', array(
									'label' => __('Documento '),
									'type'=>'text',
									'value'=>$persona_nrodoc,
									'placeholder' => __('Nro de Documento'),
									'class'=>'form-control input-sm',
									'size'=>10
								))?>
						</div>
					</div>			
					<div class="row">
						<div  class="col-lg-4">
							<?php echo $this->Form->input('Persona.apellido', array(
									'label' => __('Apellido '),
									'placeholder' => __('Ingrese Apellido a Buscar'),
									'value'=>$persona_apellido,
									'class'=>'form-control input-sm',
									'size'=>30
								))?>
						</div>
						<div class="col-lg-4">
							<?php echo $this->Form->input('Persona.nombre', array(
									'label' => __('Nombre '),
									'placeholder' => __('Ingrse Nombre a Buscar'),
									'value'=>$persona_nombre,
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
	<div id='listvinculopers'></div>
<div class="row">
<br>
</div>	
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Vinculo">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'vinculopers',
										'action'=>'add',''),
										array('escape'=>false),
					'');		
	?>		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Cancelar')?>
		</button>	
		</center>
	</div>
</div>		
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
