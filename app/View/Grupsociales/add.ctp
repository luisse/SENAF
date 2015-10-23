<?php echo $this->Html->script(array('/js/grupsociales/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Grupsociale',array('action'=>'add',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('Grupsociale.persona_id',array('value'=>$persona_id)); ?>				
<fieldset>
	<legend><?php echo __('Paso 1: Crear Nuevo Grupo Social') ?></legend>
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('afinidade_id',array('label' => __('Afinidad'),
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
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
