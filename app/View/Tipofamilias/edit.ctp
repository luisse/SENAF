<?php echo $this->Html->script(array('/js/tipofamilias/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Html->create('Tipofamilia',array('action'=>'add',	
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<fieldset>
<?php echo $this->Form->hidden('id'); ?>
	<legend><?php echo __('Actualizar Tipo de Familia') ?></legend>
		
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('descripcion',array('label' => __('Descripción'),
													'placeholder'=>'Ingrese Descripción',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>  
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('detalle',array('label' => __('Detalle'),
													'placeholder'=>'Ingrese Detalle',
													'class'=>'form-control input-sm',
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
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
