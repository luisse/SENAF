<?php echo $this->Html->script(array('/js/persxoficinas/edit.js','fmensajes.js','bootstrap-datetimepicker','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Persxoficina',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('id')?>				
<fieldset>
	<legend><?php echo __('Actualizar Persona Oficina') ?></legend>		
	<div class="row">
			<div class="col-lg-4">
				<?php echo $this->Form->input('nomape',array('label' => __('Appellido y Nombre'),
													'placeholder'=>'Ingrese Persxoficina',
													'class'=>'form-control input-sm',
													'value'=>$this->request->data['Persona']['apellido'].', '.$this->request->data['Persona']['nombre'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
	</div>
	<div class="row">
			<div class="col-lg-4">
				<?php echo $this->Form->input('oficina_id',array('label' => __('Oficina'),
													'placeholder'=>'Ingrese Persxoficina',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			</div>
	</div>
	<div class="row">
			<div class="col-lg-3">
				<?php echo $this->Form->input('activo',array('label' => __('Activada'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
	</div>
	<div class="row">
			<div class="col-lg-2">
				<label><?php echo __('Fecha de Baja')?></label>
				<div class="form-group">
					<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
						<?php echo $this->Form->input('fechabaja',array('label' => false,
													'placeholder'=>'Ingrese Persxoficina',
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>													
					</div>
				</div>
			</div>
	</div>
</fieldset>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
		</button>	
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
