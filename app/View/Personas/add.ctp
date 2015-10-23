<?php echo $this->Html->script(array('/js/personas/add.js','jquery.maskedinput','bootstrap-datetimepicker','fmensajes.js','fgenerales.js','dateformat.js','jquery.numeric','bootstrap-typeahead.js','jquery.toastmessage','Photobooth'),array('block'=>'scriptjs'));		?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Persona',array('action'=>'add',
		'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
		'class' => 'well'
			));?>
<fieldset>
	<legend>
		<?php /*if($this->Session->check('grupsociale_id'))
					echo __('Paso 3: Alta de Personas');
			else*/
					echo __('Alta de Nueva Persona');			
		?>
		</legend>
	<div class="row">
		<div class="col-lg-1">
					<?php
						$optionsnn = array('1' => 'Si', '0' => 'No');
						echo $this->Form->input('Persona.nn',array('label'=>__('Es NN'),
														'options'=>$optionsnn,
														'value'=>'0',
														'class'=>'form-control input-sm',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
			<label><?php echo __('Fecha de Nacimiento')?></label>
			<div class="form-group">
	            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('Persona.fnac',array('label'=>false,
														'placeholder' => __('Fecha de Nacimiento'),
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
		<div class="col-lg-3">
			<?php echo $this->Form->input('Persona.tipodoc_id',array(
													'class'=>'form-control input-sm',
													'label'=>'Tipo. Doc.',
													'options'=>$tipodocs,
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
			<?php echo $this->Form->input('Persona.nrodoc',array(
												'class'=>'form-control input-sm docs',
												'label'=>'Número',
												'type'=>'text',
												'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
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
													'value'=>'1',
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
	<div class="row">
		<div class="col-lg-5">
			<?php echo $this->Form->input('Persona.detalle',array('label'=>'Detalles',
													'class'=>'form-control input-sm',
													'type'=>'textarea',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
  			<div class="row">
  				<h4><?php echo __('Cargar Imagen Desde Archivo')?></h4>
  			</div>
		</div>
		<div class="col-lg-3">
			<?php echo $this->Form->file('Persona.image',array('label' => false))?>
		</div>
	</div>
	
	<div class="row">	
		<div class="col-lg-3">
		<center>
			<button type="button" class="btn btn-info btn-lw" id='sacarfoto' title='Tomar Foto'>
			  <span class="glyphicon glyphicon-camera"></span>&nbsp;<?php echo __('Tomar Foto')?>
			</button>	
		</center>
		</div>
	</div>
		<div class="row">
		<br>
		</div>
	<div class="row">	
		<div class="col-lg-3">
				<?php echo $this->Form->input('Persona.foto',array('type'=>'hidden'))?>
				<div id="example" style="background-color:orange;height:250px;width:250px;"></div>
		</div>
		<div class="col-lg-1">
		</div>
		<div class="col-lg-3">
				<div id="getfoto" style="background-color:orange;height:250px;width:250px;"></div>
		</div>
	</div>	
</fieldset>
<div class="row">
<br>
</div>
<div class="row">
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __('Guardar')?>
		</button>
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
		</button>
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
<?php if(!empty($persxgrupsociales)):?>
<fieldset>
	<legend><?php echo __('Personas Asignadas')?></legend>
<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
			<th><div class="sort"><?php echo __('Fecha de Nacimiento');?></div></th>
			<th><div class="sort"><?php echo __('Apellido');?></div></th>
			<th><div class="sort"><?php echo __('Nombre');?></div></th>
			<th><div class="sort"><?php echo __('Sexo');?></div></th>
			<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($persxgrupsociales as $persxgrupsociale):
		?>
	<tr>
		<td><?php echo $this->Time->format('d/m/Y',$persxgrupsociale['Persona']['fnac']); ?>&nbsp;</td>	
		<td><?php echo $persxgrupsociale['Persona']['apellido']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persona']['nombre']; ?>&nbsp;</td>
		<td><?php if($persxgrupsociale['Persona']['sexo']=='F'):?>
				<h4><span class="label label-danger"><?php echo __('Femenino')?></span></h4>
			<?php endif;?>
			<?php if($persxgrupsociale['Persona']['sexo']=='M'):?>
				<h4><span class="label label-success"><?php echo __('Masculino')?></span></h4>
			<?php endif;?>			
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
</fieldset>
<?php endif;?>

