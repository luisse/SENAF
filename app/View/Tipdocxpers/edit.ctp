		<?php echo $this->Html->script(array('/js/tipodocxpers/edit.js','fmensajes.js','fgenerales.js','jquery.toastmessage','jquery.numeric'),array('block'=>'scriptjs')); ?>
		<?php echo $this->Html->css('message', null, array('inline' => false))?>
		<?php echo $this->element('flash_message')?>
		<?php echo $this->Form->create('Tipdocxper',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('id');?>				
<?php echo $this->Form->hidden('persona_id');?>
<?php echo $this->Form->hidden('Tipdocxper.nrodocant',array('value'=>$this->request->data['Tipdocxper']['nrodoc']));?>
<fieldset>
	<legend>		<?php echo __('Actualizar Documento') ?></legend>
			<div class="row">
				<div class="col-lg-5">
				<?php echo $this->Form->input('Tipdocxper.tipodoc_id',array('label' =>__('Tipo de Documento'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('Tipdocxper.nrodoc',array('label' => __('Número'),
													'placeholder'=>'Ingrese Sintetico',
													'class'=>'form-control input-sm',
													'type'=>'text',
													'maxlength'=>8,
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
