<?php echo $this->Html->script(array('/js/vinculopers/add.js','fmensajes.js','fgenerales.js','jquery.toastmessage','jquery.numeric'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Vinculoper',array('action'=>'add',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<legend>		<?php echo __('Agregar Vinculos de Personas') ?></legend>
<!-- TABLA DE DETALLE -->
		<div class="table-responsive">
			<ul class="nav nav-tabs" id='myTab'>
			  <li class="active"><a href="#tabs-1"   data-toggle="tab"><?php echo __('Personas a Asignar') ?></a></li>
			</ul>
			<div class="tab-content">
			<div class="tab-pane active"  id="tabs-1">
				</br>
				<button type="button" class="btn btn-primary btn-lw" title="Agregar Fila" id='agregarfila'>
					<span class="glyphicon  glyphicon-plus"></span>&nbsp;<?php echo __('Agregar Fila')?>
				</button>								
				</br>
				</br>
				<table cellspacing="1" width='80%'  class="table table-striped table-bordered table-hover dataTable no-footer" aria-describedby="dataTables-example_info" id = "vinculopers">
				<thead>
					<tr>
							<th></th>
							<th  width='90px'><?php echo __('Documento');?></th>
							<th><?php echo __('Apellido y Nombre');?></th>
							<th><?php echo __('Parentesco');?></th>
							<th></th>							
							<th  width='90px'><?php echo __('Documento');?></th>
							<th><?php echo __('Apellido y Nombre');?></th>
							<th><?php echo __('Funcion');?></th>
					</tr>
				</thead>
				<tbody>
					<?php for($i = 0;$i <= 5;$i++):?>
					<?php echo "<tr id='vinculoper_".$i."'>"?>
							<td width='40px'>
								<button type="button" class="btn btn-success btn-xs" onclick="buscarpersonamodal(<?php echo $i?>,'izq')" id='buscarpersonas' title='Buscar Personas'>
									<span class="glyphicon  glyphicon-search"></span>
								</button>	
							</td>					
							<td>
							<?php echo $this->Form->hidden('Vinculoper.'.$i.'.personaizq_id')?>
							<?php echo $this->Form->input('Vinculoper.'.$i.'.documentoizq',array('label' => false	,
																	'class'=>'form-control input-sm detail documento',
																	'type'=>'text',
																	'maxlength'=>'13',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
																	
							<td><?php echo $this->Form->input('Vinculoper.'.$i.'.nombreapellidoizq',array('label' => false	,
																	'class'=>'form-control input-sm detail nomape',
																	'type'=>'text',
																	'maxlength'=>'50',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
							<td><?php echo $this->Form->input('Vinculoper.'.$i.'.parentesco_id',array('label' => false	,
																	'class'=>'form-control input-sm',
																	'length'=>'5',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
							<td>
								<button type="button" class="btn btn-success btn-xs" onclick="buscarpersonamodal(<?php echo $i?>,'dcha')" id='buscarpersonas' title='Buscar Personas'>
										<span class="glyphicon  glyphicon-search"></span>
								</button>
							</td>	
							<td>
							<?php echo $this->Form->hidden('Vinculoper.'.$i.'.personadcha_id')?>
							<?php echo $this->Form->input('Vinculoper.'.$i.'.documentodcha',array('label' => false	,
																	'class'=>'form-control input-sm detail documento',
																	'type'=>'text',
																	'maxlength'=>'13',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>																	
							<td><?php echo $this->Form->input('Vinculoper.'.$i.'.nombreapellidodcha',array('label' => false	,
																	'class'=>'form-control input-sm detail nomape',
																	'type'=>'text',
																	'maxlength'=>'50',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
							<td>
								<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?php echo $i ?>)">
									<span class="glyphicon  glyphicon-remove-circle"></span>
								</button>						
							</td>			
					</tr>
					<?php endfor;?>
				</tbody>
				</table>
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
<?php echo $this->element('modalbox')?>