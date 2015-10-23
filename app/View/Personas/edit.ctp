		<?php echo $this->Html->script(array('/js/personas/edit.js','fmensajes.js','jquery.maskedinput','fgenerales.js','bootstrap-datetimepicker','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
		<?php echo $this->Html->css(array('message','bootstrap-datetimepicker'), null, array('inline' => false))?>
		<?php echo $this->element('flash_message')?>
		<?php echo $this->Form->create('Persona',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<?php echo $this->Form->hidden('id');?>
<fieldset>
	<legend><?php echo __('Actualizar Datos de Persona') ?></legend>		
			<div class="row">
				<div class="col-lg-2">
					<label><?php echo __('Fecha de Nacimiento')?></label>
					<div class="form-group">
			            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
							<?php echo $this->Form->input('Persona.fnac',array('label' => false,
													'placeholder'=>'',
													'type'=>'text',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>						
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>																			
						</div>
					</div>	
				</div>
			</div>	
			<div class="row">
				<?php if(!empty($this->request->data['Tipdocxper'][0])):?>			
				<div class="col-lg-3">
					<?php echo $this->Form->input('Persona.tipodoc_id',array(
															'class'=>'form-control input-sm',
															'label'=>'Tipo. Doc.',
															'options'=>$tipodocs,
															'value'=>$this->request->data['Tipdocxper'][0]['tipodoc_id'],
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2"> 
					<?php echo $this->Form->hidden('Tipdocxper.id')?>
	 				<?php echo $this->Form->input('Tipdocxper.nrodoc',array('label' => __('Número'),
														'placeholder'=>'',
														'class'=>'form-control input-sm',
														'value'=>$this->request->data['Tipdocxper'][0]['nrodoc'],
														'type'=>'text',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-3">
						<br>
						<?php 		echo $this->Html->link('<button type="button" class="btn btn-primary btn-lw" title="Editar Documentos">
																	<span class="glyphicon  glyphicon-edit"></span>&nbsp;Editar Documentos</button>',array('controller'=>'tipdocxpers',
										'action'=>'index',''),
										array('escape'=>false),'');
								?>
				</div>
				<?php endif;?>
			</div>
			<div class="row">
				<div class="col-lg-2">
				<?php echo $this->Form->input('Persona.apellido',array('label' => __('Apellido'),
													'placeholder'=>'Ingrese Persona',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-4">
				<?php echo $this->Form->input('Persona.nombre',array('label' => __('Nombre'),
													'placeholder'=>'Ingrese Nombre',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
				<?php $options = array('F' => 'Femenino', 'M' => 'Masculino'); ?>
				<?php echo $this->Form->input('Persona.sexo',array('label' => __('Sexo'),
													'options'=>$options,
													'placeholder'=>'Ingrese Sexo',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
				<div class="col-lg-2">
				<?php echo $this->Form->input('Persona.estcivile_id',array('label' => __('Estado Civil'),
													'placeholder'=>'Ingrese Persona',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
				<?php echo $this->Form->input('Persona.email',array('label' => __('Correo Electrónico'),
													'placeholder'=>'Ingrese Correo Electronico',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
				</div>
			</div>			
			<div class="row">
				<div class="col-lg-2">
					<label><?php echo __('Fecha de Fallecimiento')?></label>
					<div class="form-group">
			            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">				
							<?php echo $this->Form->input('Persona.ffallec',array('label' => false,
																'placeholder'=>'',
																'type'=>'text',
																'class'=>'form-control input-sm',
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
