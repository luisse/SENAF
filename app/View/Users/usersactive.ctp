<?php	echo $this->Html->script('/js/users/useractive.js',array('block'=>'scriptjs'));?>
<?php echo $this->Form->create('User',array('action'=>'confirmarusuario',	
		'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
			'class' => 'well'
));?>
<?php if(!empty($usersdata)):?>
<fieldset>
	<legend><?php echo __('Confirmar Datos de Usuario')?></legend>
			<?php echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$usersdata['User']['id']))?>
			<div class="row">
				<div class="col-lg-3">			
					<?php echo $this->Form->input('User.username',array('label' => __('Usuario'),
													'class'=>'form-control input-sm',
													'value'=>$usersdata['User']['username'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">			
					<?php echo $this->Form->input('User.email',array('label' => __('Correo Electrónico'),
													'class'=>'form-control input-sm',
													'value'=>$personas['Persona']['email'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
				</div>
			</div>
			<?php if(!empty($personas)):?>
			<?php echo $this->Form->hidden('Persona.id')?>
	<div class="row">	
		<div class="col-lg-3">
			<?php echo $this->Form->input('Persona.documento',array('label' => __('Nro de Documento'),
													'size'=>'3',
													'class'=>'form-control input-sm',
													'value'=>$personas['Persona']['documento'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
			<div class="col-lg-4">
				<label>Fecha de Nacimiento</label>
				<div class="form-group">
		            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
						<?php echo $this->Form->input('Persona.fecnac',array('label'=>false,
															'placeholder' => __('Fecha de Nacimiento'),
															'size'=>'7',
															'type'=>'text',
															'value'=>$this->Time->format('d/m/Y',$personas['Persona']['fechanac']),						
															'class'=>'form-control input-sm',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
		                </span>													
					</div>
				</div>
			</div>
	</div>
	<div class="row">	
		<div class="col-lg-5">	
				<?php echo $this->Form->input('Persona.apellido',array('label'=>__('Apellido'),
														'placeholder' => __('Ingrese Apellido'),
														'size'=>'7',
														'class'=>'form-control input-sm',
														'value'=>$personas['Persona']['apellido'],				
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-5">													
				<?php echo $this->Form->input('Persona.nombre',array('label'=>__('Nombre'),
														'placeholder' => __('Ingrese Nombre'),
														'size'=>'7',
														'value'=>$personas['Persona']['nombre'],				
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
		</div>	
		<div class="row">	
			<div class="col-lg-2">	
			<?php echo $this->Form->input('Persona.telefono',array('label'=>__('Telefono'),
														'placeholder' => __('Ingrese Telefono'),
														'size'=>'2',
														'value'=>$personas['Persona']['telefono'],			
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
		</div>
		<div class="row">	
			<div class="col-lg-4">
														
				<?php echo $this->Form->input('Persona.domicilio',array('label'=>__('Domiclio'),
														'placeholder' => __('Ingrese Domiclio'),
														'size'=>'10',
														'class'=>'form-control input-sm',
														//'value'=>$personas['Persona']['domicilio'],				
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-2">
				<?php echo $this->Form->input('Persona.dpto',array('label'=>__('Dpto'),
															'placeholder' => __('Departamento'),
															'size'=>'2',
															'class'=>'form-control input-sm',
															//'value'=>$personas['Persona']['dpto'],				
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-2">
			<?php echo $this->Form->input('Persona.piso',array('label'=>__('Piso'),
															'placeholder' => __('Piso'),
															'size'=>'2',
															'class'=>'form-control input-sm',
															//'value'=>$personas['Persona']['piso'],			
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
			<div class="col-lg-2">																																																
			<?php echo $this->Form->input('Persona.block',array('label'=>__('Block'),
															'placeholder' => __('Block'),
															'size'=>'2',
															'class'=>'form-control input-sm',
															//'value'=>$personas['Persona']['block'],			
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
		</div>
		<?php endif;?>
	</fieldset>
<div class="row">	
	<div class="col-lg-12">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Confirmar Registración') ?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
<?php endif;?>

<?php if(empty($usersdata)):?>
<fieldset>
	<legend><?php echo __('No se encuentra el usuario en el Sistema. Por Favor Contacte con el Administrador')?></legend>
	<?php echo $this->Html->image('personanoexistente.jpg', array('alt' => 'WTF usuario?'));?>	
</fieldset>
<?php endif;?>