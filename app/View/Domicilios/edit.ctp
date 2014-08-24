		<?php echo ->script(array('/js/domicilios/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
		<?php echo ->css('message', null, array('inline' => false))?>
		<?php echo ('flash_message')?>
		<?php echo ->create('Domicilio',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<legend>		<?php echo __('Nueva Domicilio') ?></legend>
		
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('id',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('paise_id',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('provincia_id',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('depto_id',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('municipio_id',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('localidade_id',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('barrio_id',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('calle_id',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('descrip',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('mza',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('block',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('piso',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('dpto',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('lote',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('nro',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('usuariocrea',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('ipcrea',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('usuarioactu',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('ipactu',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('lat',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
					<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('lng',array('label' => __('Domicilio'),
													'placeholder'=>'Ingrese Domicilio',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
		</fieldset>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
		</button>	
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
