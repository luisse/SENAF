		<?php echo $this->Html->script(array('/js/vinculopers/edit.js','fmensajes.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
		<?php echo $this->Html->css('message', null, array('inline' => false))?>
		<?php echo $this->element('flash_message')?>
		<?php echo $this->Form->create('Vinculoper',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<legend>		<?php echo __('Actualizar Vinculo') ?></legend>
	
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->hidden('id')?>
				<?php echo $this->Form->hidden('id')?>				
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('personaizquierda',array('label' => __('Persona'),
													'placeholder'=>'Ingrese Vinculo',
													'class'=>'form-control input-sm',
													'value'=>$this->request->data['Personaizq']['apellido'].', '.$this->request->data['Personaizq']['nombre'],
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('Vinculoper.parentesco_id',array('label' => __('Vinculo'),
													'placeholder'=>'Ingrese Vinculo',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('personaderecha',array('label' => __('Persona'),
													'placeholder'=>'Ingrese Vinculo',
													'class'=>'form-control input-sm',
													'value'=>$this->request->data['Personadrch']['apellido'].', '.$this->request->data['Personadrch']['nombre'],
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
