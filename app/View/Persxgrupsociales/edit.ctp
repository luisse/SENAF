		<?php echo $this->Html->script(array('/js/persxgrupsociales/edit.js','fmensajes.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
		<?php echo $this->Html->css('message', null, array('inline' => false))?>
		<?php echo $this->element('flash_message')?>
		<?php echo $this->Form->create('Persxgrupsociale',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<legend>		<?php echo __('Nueva Persxgrupsociale') ?></legend>
		
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('id',array('label' => __('Persxgrupsociale'),
													'placeholder'=>'Ingrese Persxgrupsociale',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('persona_id',array('label' => __('Persxgrupsociale'),
													'placeholder'=>'Ingrese Persxgrupsociale',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('grupsociale_id',array('label' => __('Persxgrupsociale'),
													'placeholder'=>'Ingrese Persxgrupsociale',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('persxoficina_id',array('label' => __('Persxgrupsociale'),
													'placeholder'=>'Ingrese Persxgrupsociale',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('fecharelev',array('label' => __('Persxgrupsociale'),
													'placeholder'=>'Ingrese Persxgrupsociale',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('usuariocrea',array('label' => __('Persxgrupsociale'),
													'placeholder'=>'Ingrese Persxgrupsociale',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('ipcrea',array('label' => __('Persxgrupsociale'),
													'placeholder'=>'Ingrese Persxgrupsociale',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('usuarioactu',array('label' => __('Persxgrupsociale'),
													'placeholder'=>'Ingrese Persxgrupsociale',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('ipactu',array('label' => __('Persxgrupsociale'),
													'placeholder'=>'Ingrese Persxgrupsociale',
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
