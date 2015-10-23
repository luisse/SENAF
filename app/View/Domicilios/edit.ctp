<?php echo $this->Html->script(array('/js/domicilios/edit.js','fmensajes.js','fgenerales.js','jquery.numeric','jquery.toastmessage','bootstrap-typeahead.js'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Domicilio',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('Domicilio.id');?>
<fieldset>
	<legend><?php echo __('Alta de Nuevo Domicilio') ?></legend>
		<div id='domicilio'>
			<div class="row">
				<div class="col-lg-3">
				<?php echo $this->Form->input('Domicilio.paise_id',array('label' => __('País'),
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-10">
				<?php echo $this->Form->input('Domicilio.provincia_id',array('label' => __('Provincia'),
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
				<?php echo $this->Form->input('Domicilio.depto_id',array('label' => __('Departamento'),
																				'class'=>'form-control input-sm',
																				'selected'=>$this->request->data['Depto']['id'],
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-3">
				<?php echo $this->Form->input('Domicilio.municipio_id',array('label' => __('Municipio'),
																				'class'=>'form-control input-sm',
																				'selected'=>$this->request->data['Municipio']['id'],
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
				<?php echo $this->Form->input('Domicilio.localidade_id',array('label' => __('Localidad'),
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>			
				<div class="col-lg-3">
				<?php echo $this->Form->input('Domicilio.barrio_id',array('label' => __('Barrio'),
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10">
					<?php echo $this->Form->input('Domicilio.callenombre',array('label' => __('Calle'),
																				'placeholder'=>'Ingrese Calle',
																				'class'=>'form-control input-sm',
																				'type'=>'text',
																				'value'=>$calles['Calle']['descrip'],
																				'autocomplete'=>'off',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10">
				<?php echo $this->Form->input('Domicilio.descrip',array('label' => __('Detalle'),
																				'placeholder'=>'Ingrese Detalle',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-1">
				<?php echo $this->Form->input('Domicilio.mza',array('label' => __('Mza'),
																				'placeholder'=>'Mza',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-1">
				<?php echo $this->Form->input('Domicilio.block',array('label' => __('Block'),
																				'placeholder'=>'Block',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-1">
				<?php echo $this->Form->input('Domicilio.piso',array('label' => __('Piso'),
																				'placeholder'=>'Piso',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-1">
				<?php echo $this->Form->input('Domicilio.dpto',array('label' => __('Dpto'),
																				'placeholder'=>'Dpto',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-1">
				<?php echo $this->Form->input('Domicilio.lote',array('label' => __('Lote'),
																				'placeholder'=>'Lote',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-1">
				<?php echo $this->Form->input('Domicilio.nro',array('label' => __('Nro'),
																				'placeholder'=>'Nro',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-1">
				<?php echo $this->Form->input('Domicilio.sector',array('label' => __('Sector'),
																				'placeholder'=>'Sector',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
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
