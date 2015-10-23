<?php echo $this->Html->script(array('/js/persxoficinas/index.js','jquery.toastmessage','jquery.numeric'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'persxoficinas','action'=>'listperxoficinas')) ?>"
</script>
	
<?php echo $this->element('flash_message')?>
<div class="panel panel-personas">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Personas por Oficina')?>    </div>
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
					<?php echo $this->Form->create('Persxoficina',array('action'=>'#','id'=>'persxoficinas'));?>
				<fieldset>
					<div class="row">	
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Persxoficina.oficina_id', array(
									'label' => __('Oficina'),
									'placeholder' => __('Nro de Documento'),
									'class'=>'form-control input-sm',
									'value'=>'0'
								))?>
						</div>
					</div>			
					<div class="row">
						<div  class="col-lg-4">
							<?php echo $this->Form->input('Persxoficina.apellido', array(
									'label' => __('Apellido '),
									'placeholder' => __('Ingrese Apellido a Buscar'),
									'class'=>'form-control input-sm',
									'size'=>30
								))?>
						</div>
						<div class="col-lg-4">
							<?php echo $this->Form->input('Persxoficina.nombre', array(
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
	<br>
	<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
		<?php echo $this->Html->image('carga.gif')?>
	</div>	
	<div id='listpersxoficina'></div>
	

<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Categoria">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'persxoficinas',
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
