<?php echo $this->Html->script(array('/js/oficinas/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage','jquery.numeric'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Oficina',array('action'=>'add',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<legend>		<?php echo __('Nueva Oficina') ?></legend>
		
			<div class="row">
				<div class="col-lg-4">
				<?php echo $this->Form->input('descrip',array('label' => __('Descripción'),
													'placeholder'=>'Ingrese Oficina',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-2">
				<?php echo $this->Form->input('codofiexpe',array('label' => __('Código de Oficina'),
													'placeholder'=>'Ingrese Código de Oficina',
													'class'=>'form-control input-sm',
													'type'=>'text',
													'maxlength='=>'4',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
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
