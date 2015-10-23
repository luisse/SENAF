<?php echo $this->Html->script(array('/js/users/addusuario.js','jquery.maskedinput','bootstrap-datetimepicker','fmensajes.js','dateformat.js','fgenerales.js','jquery.numeric','jquery.toastmessage'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>

<?php echo $this->Form->create('User',array('action'=>'addusuario',	
		'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
		'class' => 'well'
			));?>
<fieldset>
	<legend><?php echo __('Alta de Usuario')?></legend>
	<div class="row">	
		<div class="col-lg-2">
			<?php echo $this->Form->input('Persona.nrodoc',array('label' => __('Nro de Documento'),
													'placeholder' => __('Número de Documento'),
													'size'=>'3',
													'type'=>'text',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
			<label><?php echo __('Fecha de Nacimiento')?></label>
			<div class="form-group">
	            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('Persona.fnac',array('label'=>false,
														'placeholder' => __('Fecha de Nacimiento'),
														'size'=>'7',
														'type'=>'text',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
	                </span>													
				</div>
			</div>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-2">	
			<?php echo $this->Form->input('Persona.apellido',array('label'=>__('Apellido'),
													'placeholder' => __('Ingrese Apellido'),
													'size'=>'7',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-4">													
			<?php echo $this->Form->input('Persona.nombre',array('label'=>__('Nombre'),
													'placeholder' => __('Ingrese Nombre'),
													'size'=>'7',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>	
	<div class="row">	
		<div class="col-lg-2">	
		<?php 
		$options = array('F' => 'Femenino', 'M' => 'Masculino');
		echo $this->Form->input('Persona.sexo',array('label'=>__('Sexo'),
													'options'=>$options,
													'value'=>1,
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">	
		<?php echo $this->Form->input('Persona.estcivile_id',array('label'=>__('Estado Civil'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>	
	<div class="row">	
		<div class="col-lg-3">
					<?php echo $this->Form->input('User.username',array('label'=>__('Usuario'),
													'placeholder' => __('Ingrese Usuario'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
				<?php echo $this->Form->input('User.password',array('label'=>__('Contraseña'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
					<?php echo $this->Form->input('User.password_repit',array('label'=>__('Repetir Contraseña'),
													'class'=>'form-control input-sm',
													'type'=>'password',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
			<?php echo $this->Form->input('Persona.email',array('label'=>'E-Mail',
													'placeholder' => 'E-Mail',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
</fieldset>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __('Guardar')?>
		</button>	
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<div id='ocultar'>
	<?php echo $this->Form->input('Persona.id',array('type'=>'text','value'=>''));?>
	<?php echo $this->Form->input('Persona.fechaactual',array('type'=>'text','value'=>''));?>
</div>
<?php echo $this->Form->end();?>

