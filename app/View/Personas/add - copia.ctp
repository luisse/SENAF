<?php echo $this->Html->script(array('/js/personas/add.js','jquery.maskedinput','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','jquery.numeric'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css('bootstrap-datetimepicker', null, array('inline' => false))?>

<?php echo $this->Form->create('Persona',array('action'=>'add',	
		'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
		'class' => 'well'
			));?>
<fieldset>
	<legend><?php echo __('Alta de Persona')?></legend>
	<div class="row">
		<div class="col-lg-1">
					<?php
						$optionsnn = array('1' => 'Si', '0' => 'No');					
						echo $this->Form->input('Persona.nn',array('label'=>__('Es NN'),
														'options'=>$optionsnn,
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>		
		<div class="col-lg-3">
			<label><?php echo __('Fecha de Nacimiento')?></label>
			<div class="form-group">
	            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('Persona.fnac',array('label'=>false,
														'placeholder' => __('Fecha de Nacimiento'),
														'size'=>'7',
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
		<div class="col-lg-2">	
			<?php echo $this->Form->input('Persona.apellido',array('label'=>__('Apellido'),
													'placeholder' => __('Ingrese Apellido'),
													'size'=>'7',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-4">													
			<?php echo $this->Form->input('Persona.nombre',array('label'=>__('Nombre'),
													'placeholder' => __('Ingrese Nombre'),
													'size'=>'7',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>	
	<div class="row">	
		<div class="col-lg-2">	
		<?php 
		$options = array('F' => 'Femenino', 'M' => 'Masculino');
		echo $this->Form->input('Persona.sexo',array('label'=>__('Sexo'),
													'options'=>$options,
													'value'=>1,
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">	
		<?php echo $this->Form->input('Persona.estcivile_id',array('label'=>__('Estado Civil'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">	
		<div class="col-lg-3">
			<?php echo $this->Form->input('Persona.email',array('label'=>'E-Mail',
													'placeholder' => 'E-Mail',
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>	
	<ul class="nav nav-tabs" id='myTab'>
		<li class="active"><a href="#tabs-1"   data-toggle="tab"><?php echo __('Documento') ?></a></li>
		<li><a href="#tabs-2"  data-toggle="tab"><?php echo __('Domicilio') ?></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabs-1">
			<div class="panel panel-default">
				<div id='documento'>
						<table id="bicicletareparamorepuesto" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">		
							<thead>
								<tr>
									<th><?php echo __('Tipo De Documento');?></th>
									<th><?php echo __('Número de Documento');?></th>
									<th><?php __('Acciones');?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									for($i=0;$i<=5;$i++):
								?>
								<tr id='bicicletareparamorepuesto_<?php echo $i?>'>
									<td>
										<div class="col-lg-5">
										<?php echo $this->Form->input('Tipdocxper.'.$i.'.tipodoc_id',array(
													'class'=>'form-control input-sm',
													'label'=>false,
													'options'=>$tipodocs,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
										</div>
									</td>
									<td>
										<div class="col-lg-5">
										<?php echo $this->Form->input('Tipdocxper.'.$i.'.nrodoc',array(
													'class'=>'form-control input-sm docs',
													'label'=>false,
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
										</div>
									</td>
									<td></td>
								</tr>
							<?php endfor ?>
							</tbody>
						</table>
				</div>
			</div>
		</div>
		<div id="tabs-2" class="tab-pane">
			<div class="panel panel-default">
				<div id='domicilio'>
						<table id="bicicletareparamorepuesto" class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info">		
							<thead>
								<tr>
									<th><?php echo __('Domicilio');?></th>
									<th><?php __('Acciones');?></th>
								</tr>
							</thead>
							<tbody>
								<?php
									for($i=0;$i<=0;$i++):
								?>
								<tr id='bicicletareparamorepuesto_<?php echo $i?>'>
									<td>
										<div class="row">
											<div class="col-lg-3">
											<?php echo $this->Form->input('Domicilio.'.$i.'.paise_id',array('label' => __('País'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-10">
											<?php echo $this->Form->input('Domicilio.'.$i.'.provincia_id',array('label' => __('Provincia'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
										</div>
										<div class="row">
										<div class="col-lg-3">
											<?php echo $this->Form->input('Domicilio.'.$i.'.depto_id',array('label' => __('Dpto'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-3">
											<?php echo $this->Form->input('Domicilio.'.$i.'.localidade_id',array('label' => __('Localidad'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
										</div>
										<div class="row">
										<div class="col-lg-3">
											<?php echo $this->Form->input('Domicilio.'.$i.'.municipio_id',array('label' => __('Municipio'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-3">
											<?php echo $this->Form->input('Domicilio.'.$i.'.barrio_id',array('label' => __('Barrio'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-10">
											<?php echo $this->Form->input('Domicilio.'.$i.'.calle_id',array('label' => __('Calle'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-10">
											<?php echo $this->Form->input('Domicilio.'.$i.'.descrip',array('label' => __('Detalle'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-1">
											<?php echo $this->Form->input('Domicilio.'.$i.'.mza',array('label' => __('Mza'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-1">
											<?php echo $this->Form->input('Domicilio.'.$i.'.block',array('label' => __('Block'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-1">
											<?php echo $this->Form->input('Domicilio.'.$i.'.piso',array('label' => __('Piso'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-1">
											<?php echo $this->Form->input('Domicilio.'.$i.'.dpto',array('label' => __('Dpto'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-1">
											<?php echo $this->Form->input('Domicilio.'.$i.'.lote',array('label' => __('Lote'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
											<div class="col-lg-1">
											<?php echo $this->Form->input('Domicilio.'.$i.'.nro',array('label' => __('Nro'),
																				'placeholder'=>'Ingrese Domicilio',
																				'class'=>'form-control input-sm',
																				'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
											</div>
										</div>
									</td>
									<td></td>
								</tr>
							<?php endfor ?>								
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
</fieldset>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __('Guardar')?>
		</button>	
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>

<?php echo $this->Form->end();?>

