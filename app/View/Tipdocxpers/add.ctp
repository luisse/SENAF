		<?php echo $this->Html->script(array('/js/tipodocxpers/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage','jquery.numeric'),array('block'=>'scriptjs')); ?>
		<?php echo $this->Html->css('message', null, array('inline' => false))?>
		<?php echo $this->element('flash_message')?>
		<?php echo $this->Form->create('Tipdocxper',array('action'=>'add',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<legend>		<?php echo __('Nuevo Documento') ?></legend>
			<div class="row">
				<div class="alert alert-info" role="alert">
					<strong><?php echo __('Asociar Documento a:')?></strong>&nbsp;<?php echo $persona['Persona']['apellido'].', '.$persona['Persona']['nombre'];?></div>
				<div class="table-responsive">
			</div>
			<div class="row">
				<div class="col-lg-5">
				<?php echo $this->Form->hidden('persona_id',array('value'=>$this->Session->read('persona_id')))?>
				<?php echo $this->Form->input('tipodoc_id',array('label' => __('Tipo de Documento'),
													'placeholder'=>'Ingrese tipo de Documento',
													'class'=>'form-control input-sm',
													//'options'=>$tipodocs,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-3">
				<?php echo $this->Form->input('nrodoc',array('label' => __('Número'),
													'placeholder'=>'Ingrese Documento',
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
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>