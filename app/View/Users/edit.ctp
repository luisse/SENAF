<?php	echo $this->Html->script(array('/js/users/edit.js','jquery.toastmessage','validarclave.js'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>		
<?php echo $this->element('flash_message')?>
<?php 
$str_estadosusers[0]='Inhabilitado';
$str_estadosusers[1]='Habilitado';
$str_estadosusers[2]='Creado no aceptado';
?>

<ul class="nav nav-tabs" id='myTab'>
	<li class="active"><a href="#tabs-1"   data-toggle="tab"><i class="fa fa-pencil fa-fw"></i>&nbsp;<?php echo __('Datos Generales') ?></a></li>
	<li><a href="#tabs-2"  data-toggle="tab"><i class="fa fa-camera fa-fw"></i>&nbsp;<?php echo __('Foto del Usuario') ?></a></li>
	<li><a href="#tabs-3"  data-toggle="tab"><i class="fa fa-unlock  fa-fw"></i>&nbsp;<?php echo __('Modificar Contraseña') ?></a></li>	
</ul>
<div class="tab-content">
<div class="tab-pane  active" id="tabs-1">
	<?php echo $this->Form->create('User',array('action'=>'edit',	
			'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'
	));?>
	<fieldset>
		<legend><?php echo __('Editar Usuario')?></legend>
				<?php echo $this->Form->input('User.id',array('type'=>'hidden'))?>
				<?php echo $this->Form->input('User.tipousuario_id',array('type'=>'hidden'))?>
				<div class="row">
					<div class="col-lg-3">			
						<?php echo $this->Form->input('User.username',array('label' => 'Usuario',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
					</div>
				</div>
				<?php if($this->Session->read('tipousr')==1):?>
				<div class="row">
					<div class="col-lg-3">
						<?php echo $this->Form->input('User.state',array('label' => 'Estado Usuario',
														'class'=>'form-control input-sm',
														'options'=>$str_estadosusers,
														'value'=>$this->request->data['User']['state'],
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>					
					</div>
				</div>
				<?php endif;?>
				
		<?php if(!empty($personas)):?>
		<?php echo $this->Form->hidden('Persona.id')?>
				<div class="row">
					<div class="col-lg-12">		
						<div class="alert alert-warning" >
										<?php 
											if($this->Session->read('tipousr') != 2):?>	
											<?php echo $this->Html->link($this->Html->image('edit.png',array('title'=>__('Editar Datos Personales',true))),array('controller'=>'personas',
													'action'=>'edit',$personas['Persona']['id']),
													array('onclick'=>'','escape'=>false),'');
											?>
										<?php endif;?>
										<?php echo __('Datos Personales del Usuario ',true)?>																	
						</div>								
					</div>
				</div>
		<div class="row">	
			<div class="col-lg-2">
				<?php echo $this->Form->input('Persona.documento',array('label' => 'Nro de Documento',
														'placeholder' => 'Número de Documento',
														'size'=>'3',
														'class'=>'form-control input-sm',
														'value'=>$personas['Tipdocxper']['nrodoc'],
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
				<div class="col-lg-2">
					<label><?php echo __('Fecha de Nacimiento')?></label>
					<div class="form-group">
			            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
							<?php echo $this->Form->input('Persona.fnac',array('label'=>false,
																'placeholder' => __('Fecha de Nacimiento'),
																'size'=>'7',
																'type'=>'text',
																'value'=>$this->Time->format('d/m/Y',$personas['Persona']['fnac']),						
																'class'=>'form-control input-sm',
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                </span>													
						</div>
					</div>
				</div>
		</div>
		<div class="row">	
			<div class="col-lg-3">	
					<?php echo $this->Form->input('Persona.apellido',array('label'=>'Apellido',
															'placeholder' => 'Ingrese Apellido',
															'class'=>'form-control input-sm',
															'value'=>$personas['Persona']['apellido'],				
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-5">													
					<?php echo $this->Form->input('Persona.nombre',array('label'=>'Nombre',
															'placeholder' => 'Ingrese Nombre',
															'size'=>'7',
															'value'=>$personas['Persona']['nombre'],				
															'class'=>'form-control input-sm',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-3">			
					<?php echo $this->Form->input('Persona.email',array('label' => __('Correo Electrónico'),
													'class'=>'form-control input-sm',
													'value'=>$personas['Persona']['email'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
				</div>
			</div>
			<div class="row">	
				<div class="col-lg-4">
															
					<?php echo $this->Form->input('Persona.domicilio',array('label'=>'Domiclio',
															'placeholder' => 'Ingrese Domiclio',
															'size'=>'10',
															'class'=>'form-control input-sm',
															//'value'=>$clientes['Cliente']['domicilio'],				
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">
					<?php echo $this->Form->input('Persona.dpto',array('label'=>'Dpto',
																'placeholder' => 'Departamento',
																'size'=>'2',
																'class'=>'form-control input-sm',
																//'value'=>$clientes['Cliente']['dpto'],				
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">
				<?php echo $this->Form->input('Persona.piso',array('label'=>'Piso',
																'placeholder' => 'Piso',
																'size'=>'2',
																'class'=>'form-control input-sm',
																//'value'=>$clientes['Cliente']['piso'],			
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">																																																
				<?php echo $this->Form->input('Persona.block',array('label'=>'Block',
																'placeholder' => 'Block',
																'size'=>'2',
																'class'=>'form-control input-sm',
																//'value'=>$clientes['Cliente']['block'],			
																'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<?php endif;?>
		</fieldset>
	<div class="row">	
		<div class="col-lg-6">
			<?php //if($this->Access->isLoggedin()): ?>
				<center>
				<button type="button" class="btn btn-success btn-lw" id='guardar'>
				  <span class="glyphicon glyphicon glyphicon-save"></span><?php echo __('Guardar')?>
				</button>	
				</center>
			<?php //endif;?>
		</div>
		<div class="col-lg-6">
			<center>
			<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
			  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
			</button>	
			</center>
		</div>
	</div>
	<?php echo $this->Form->end();?>
</div>
<div id="tabs-2" class="tab-pane">
	<?php echo $this->Form->create('User',array('action'=>'editimage',
						'type'=>'file',	
						'inputDefaults' => array(
										'div' => 'form-group',
										'wrapInput' => false,
										'class' => 'form-control'
										),
						'class' => 'well'
	));?>
	<?php echo $this->Form->hidden('User.id',array('value'=>$this->request->data['User']['id']))?>
	<fieldset>
		<div class='row'>
			<div class='col-lg-5'>
					<?php echo $this->Form->input('User.image',array('label'=>__('Foto del Usuario'),
															'placeholder' => __('Seleccione un Archivo'),
															'class'=>'form-control input-sm',
															'type'=>'file',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			
			</div>
			 <div class="col-xs-6 col-md-3">
				<a href="#" class="thumbnail">
					<?php  echo $this->Html->image(array ( 'controller' =>
									'users' , 'action' => 'mostrarfoto' ,
									$this->request->data['User']['id']),
									array ( 'title' =>__('Imagen de Persona')));
							?>
				</a>
			</div>
		</div>
	</fieldset>
	<div class="row">	
		<div class="col-lg-1">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='actualizarfoto'>
			  <span class="glyphicon glyphicon glyphicon-save"></span><?php echo __('Actualizar Foto')?>
			</button>	
			</center>
		</div>
	</div>
	
	<?php echo $this->Form->end();?>
</div>
<div id="tabs-3" class="tab-pane">
	<?php echo $this->Form->create('User',array('action'=>'cambiarcontrasenia',
						'inputDefaults' => array(
										'div' => 'form-group',
										'wrapInput' => false,
										'class' => 'form-control'
										),
						'class' => 'well'
	));?>
	<?php echo $this->Form->hidden('User.id',array('value'=>$this->data['User']['id']))?>
	<fieldset>
		<div class='row'>
			<div class='col-lg-5'>
					<?php echo $this->Form->input('User.passwordc',array('label'=>__('Ingresa la Contraseña'),
															'placeholder' => '',
															'class'=>'form-control input-sm',
															'type'=>'password',
															'val'=>'',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					<span id='mensajecontrola'></span>															
			</div>
		</div>
		<div class='row'>
			 <div  class='col-lg-5'>
					<?php echo $this->Form->input('User.passwordrepit',array('label'=>__('Ingresa nuevamente la Contraseña'),
															'placeholder' => '',
															'class'=>'form-control input-sm',
															'type'=>'password',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>			 
					
			</div>
			<div  class='col-lg-5'>
				<div class="alert alert-success"><?php echo __('Debes repetir la contraseña para evitar errores de tipeo') ?></div>
			</div>
		</div>
	<?php echo $this->Form->end();?>
	<div class="row">	
		<div class="col-lg-1">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='actualizarpswd'>
			  <span class="glyphicon glyphicon glyphicon-save"></span> Guardar
			</button>	
			</center>
		</div>
	</div>
	</fieldset>	
</div>
</div>