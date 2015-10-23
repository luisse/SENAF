<br>
<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
					<th><?php echo $this->Paginator->sort('Personaizq.apellido','Persona');?></th>
					<th><?php echo $this->Paginator->sort('Parentesco.descrip','Parentesco');?></th>
					<th><?php echo $this->Paginator->sort('Personadrch.apellido','Persona');?></th>
					<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($vinculopers as $vinculoper):
		?>
	<tr>
		<td><?php echo $vinculoper['Personaizq']['apellido'].', '.$vinculoper['Personaizq']['nombre']; ?>&nbsp;</td>
		<td><?php echo $vinculoper['Parentesco']['descrip']; ?>&nbsp;</td>
		<td><?php echo $vinculoper['Personadrch']['apellido'].', '.$vinculoper['Personadrch']['nombre']; ?>&nbsp;</td>
		<td class="actions">
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-caret-down"></span></a>
					<ul class="dropdown-menu">
					<li>
							<?php 
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'vinculopers',
								'action'=>'edit',$vinculoper['Vinculoper']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>
					</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'vinculopers',
								'action'=>'delete',$vinculoper['Vinculoper']['id']),
								array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>						</li>
					  </ul>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
	<tfoot>
		<tr>
		<td colspan="7" class='row1'>
				<center>
						<?php 
							$paginador = $this->paginator->numbers(array(
								    'before' => '',
								    'separator' => '',
								    'currentClass' => 'active',
								    'tag' => 'li',
									 'currentTag' => 'a',
								    'after' => ''));
						?>				
						<div class="pagination">
							<?php if(!empty($paginador)): ?>
							<nav>
								<ul class="pagination">
  								  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
								  <li><?php echo $paginador;?></li>
								  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
								</ul>
							</nav>
						<?php endif;?>			
						</div>
				</center>
		</td>
		</tr>
	</tfoot>
</table>
</center>
</div>