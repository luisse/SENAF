<?php echo $this->Html->script(array('/js/personas/personaexiste.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('timeline','message'), null, array('inline' => false))?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'personas','action'=>'seguimientopersonas')) ?>"
</script>

<div class="panel panel-personas">
	<div class="panel-heading">
		<i class="fa fa-users fa-lg"></i>&nbsp;<?php echo __('Visualización de Entorno Social de Personas')?>    </div>
	<br>
	<div class="panel-body">
		<div class="table-responsive">
				<ul class="nav nav-tabs">
				  <li class="active"><a href="#tabs-1"><?php echo __('Filtro Personas') ?></a></li>
				</ul>
				<div class="tab-content">
				  <div class="tab-pane active" id="tabs-1">
						<?php echo $this->Form->create('User',array('action'=>'#','id'=>'personafilter'));?>
						<?php echo $this->Form->input('typeuser',array('type'=>'hidden','value'=>'1')); ?>
						<?php echo $this->Form->hidden('Persona.id');?>    
					<fieldset>
						<div class="row">	
							<div class="col-lg-2">			
								<?php echo $this->Form->input('Persona.nrodoc', array(
										'label' => __('Documento *'),
										'type'=>'text',
										'placeholder' => __('Nro de Documento'),
										'class'=>'form-control input-sm',
										'size'=>10
									))?>
							</div>
						</div>
						<div class="row">
							<div  class="col-lg-2">
								<br>
								<button type="button" class="btn btn-success btn-lw" id='personasel'>
										<span class="glyphicon glyphicon-search"></span> <?php echo __('Personas');?>
								</button>
							</div>   							
							<div  class="col-lg-3">
								<?php echo $this->Form->input('Persona.apellido', array(
										'label' => __('Apellido '),
										'placeholder' => __('Ingrese Apellido a Buscar'),
										'class'=>'form-control input-sm',
										'size'=>30
									))?>
							</div>
							<div class="col-lg-3">
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
										<span class="glyphicon glyphicon-check"></span> <?php echo __('Agregar');?>
								</button>
							</div>    
						</div>
					</div>
					</fieldset>
					<?php echo $this->Form->end()?>
				</div>
		</div>	
		<div class="row">
			<div class="col-lg-6">
			<?php echo $this->Form->create('User',array('action'=>'#','id'=>'personaexiste'));?>
			<br>
			<table id='personas' class="table">
				<thead>
					<tr>
						<th><?php echo __('Personas Asignadas a Control')?></th>
					</tr>
				</thead>
				<tbody>		
				</tbody>
			</table>
			<?php echo $this->Form->end()?>
			</div>
			<div  class="col-lg-2" id='ejecutarconsulta'>
				<br>
				<button type="button" class="btn btn-success btn-lw" id='ejecexiste'>
					<span class="glyphicon glyphicon-thumbs-up"></span> <?php echo __('Ejecutar Consulta');?>
				</button>
			</div>    
		</div>	
		<div id='cargandodatos' style='display:none;top: 50%;left: 50%;text-align:center'>
			<?php echo $this->Html->image('carga.gif')?>
		</div>		
		<div id='seguimiento'></div>
	</div>	
</div>
<?php echo $this->element('modalbox')?>
