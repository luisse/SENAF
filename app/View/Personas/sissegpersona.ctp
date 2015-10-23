<?php echo $this->Html->script(array('/js/personas/sisegpersona.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('timeline','message'), null, array('inline' => false))?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'personas','action'=>'mostrarseguimiento')) ?>"
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
	}else{
		$perdoc=$this->Session->read('perdoc');
		if(!empty($perdoc)){
			$persona_nrodoc = $this->Session->read('perdoc');
			$persona_nombre = $this->Session->read('pernombre');
			$persona_apellido = $this->Session->read('perapellido');
		}
	}
	
?>

<div class="panel panel-personas">
	<div class="panel-heading">
		<i class="fa fa-users fa-lg"></i>&nbsp;<?php echo __('Visualización Estado de Personas en Sistema')?>    </div>
	<br>
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
						<div class="row">	
							<div class="col-lg-2">			
								<?php echo $this->Form->input('Persona.nrodoc', array(
										'label' => __('Documento '),
										'type'=>'text',
										'placeholder' => __('Nro de Documento'),
										'class'=>'form-control input-sm',
										'size'=>10,
										'value'=>$persona_nrodoc
									))?>
							</div>
							<div  class="col-lg-2">
								<br>
								<button type="button" class="btn btn-success btn-lw" id='personasel'>
										<span class="glyphicon glyphicon-search"></span> <?php echo __('Personas');?>
								</button>
							</div>    
							
						</div>			
						<div class="row">
							<div  class="col-lg-3">
								<?php echo $this->Form->input('Persona.apellido', array(
										'label' => __('Apellido '),
										'placeholder' => __('Ingrese Apellido a Buscar'),
										'class'=>'form-control input-sm',
										'size'=>30,
										'value'=>$persona_apellido
									))?>
							</div>
							<div class="col-lg-3">
								<?php echo $this->Form->input('Persona.nombre', array(
										'label' => __('Nombre '),
										'placeholder' => __('Ingrse Nombre a Buscar'),
										'class'=>'form-control input-sm',
										'size'=>30,
										'value'=>$persona_nombre
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
					<?php echo $this->Form->end()?>
				</div>
		</div>	
		<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
			<?php echo $this->Html->image('carga.gif')?>
		</div>					
		<div id='seguimiento'></div>
	</div>	
</div>
<?php echo $this->element('modalbox')?>
