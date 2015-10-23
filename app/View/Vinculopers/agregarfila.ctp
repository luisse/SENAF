							<td width='40px'>
								<button type="button" class="btn btn-success btn-xs" onclick="buscarpersonamodal(<?php echo $row?>)" id='buscarpersonas' title='Buscar Personas'>
									<span class="glyphicon  glyphicon-search"></span>
								</button>	
							</td>					
							<td>
							<?php echo $this->Form->hidden('Vinculoper.'.$row.'.personaizq_id')?>
							<?php echo $this->Form->input('Vinculoper.'.$row.'.documentoizq',array('label' => false	,
																	'class'=>'form-control input-sm detail documento',
																	'type'=>'text',
																	'maxlength'=>'13',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
																	
							<td><?php echo $this->Form->input('Vinculoper.'.$row.'.nombreapellidoizq',array('label' => false	,
																	'class'=>'form-control input-sm detail nomape',
																	'type'=>'text',
																	'maxlength'=>'50',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
							<td><?php echo $this->Form->input('Vinculoper.'.$row.'.parentesco_id',array('label' => false	,
																	'class'=>'form-control input-sm',
																	'length'=>'5',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
							<td>
								<button type="button" class="btn btn-success btn-xs" onclick="buscarpersonamodal(<?php echo $row?>)" id='buscarpersonas' title='Buscar Personas'>
										<span class="glyphicon  glyphicon-search"></span>
								</button>
							</td>	
							<td>
							<?php echo $this->Form->hidden('Vinculoper.'.$row.'.personadcha_id')?>
							<?php echo $this->Form->input('Vinculoper.'.$row.'.documentodcha',array('label' => false	,
																	'class'=>'form-control input-sm detail documento',
																	'type'=>'text',
																	'maxlength'=>'13',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>																	
							<td><?php echo $this->Form->input('Vinculoper.'.$row.'.nombreapellidocha',array('label' => false	,
																	'class'=>'form-control input-sm detail nomape',
																	'type'=>'text',
																	'maxlength'=>'50',
																	'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?></td>
							<td>
								<button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila(<?php echo $row ?>)">
									<span class="glyphicon  glyphicon-remove-circle"></span>
								</button>						
							</td>			
