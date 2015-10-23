<td>
	<button type="button" class="btn btn-success btn-xs" onclick="buscarpersonamodal(<?php echo $row?>)" id='buscarproductos' title='Buscar Persona'>
		<span class="glyphicon  glyphicon-search"></span>
	</button>	
</td>
<td><?php echo $this->Form->input('Persxgruposociale.'.$row.'.persona_id',array('label' => false	,
															'class'=>'form-control input-sm id',
															'type'=>'text',
															'length'=>'5',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
<td><?php echo $this->Form->input('Persxgruposociale.'.$row.'.documento',array('label' => false	,
															'class'=>'form-control input-sm detail',
															'type'=>'text',
															'maxlength'=>'50',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
																	
<td><?php echo $this->Form->input('Persxgruposociale.'.$row.'.nombreapellido',array('label' => false	,
																	'class'=>'form-control input-sm detail',
																	'type'=>'text',
																	'maxlength'=>'50',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
<td>
	<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?php echo $row ?>)">
		<span class="glyphicon  glyphicon-remove-circle"></span>
	</button>						
</td>			
