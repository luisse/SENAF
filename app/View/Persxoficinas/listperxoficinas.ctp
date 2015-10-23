<?php if(!empty($persxoficinas)){?>
<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
					<th><?php echo $this->Paginator->sort('Oficina.descrip','Oficina');?></th>
					<th><?php echo $this->Paginator->sort('Persona.apellido','Persona');?></th>
					<th><?php echo __('Estado');?></th>
					<th><?php echo $this->Paginator->sort('fechabaja','Fecha de Baja');?></th>
					<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($persxoficinas as $persxoficina):
		?>
	<tr>
		<td><?php echo $persxoficina['Oficina']['descrip']; ?>&nbsp;</td>
		<td><?php echo $persxoficina['Persona']['apellido'].', '.$persxoficina['Persona']['nombre']; ?>&nbsp;</td>
		<td><?php if($persxoficina['Persxoficina']['activo'] == 1):?>
				<h4><span class="label label-success"><?php echo __('Activo')?></span></h4>
			<?php endif;?>
			<?php if($persxoficina['Persxoficina']['activo'] == 0):?>
				<h4><span class="label label-danger"><?php echo __('Desactivo')?></span></h4>
			<?php endif;?>			
		
		</td>
		
		<td align='right'><?php if(!empty($persxoficina['Persxoficina']['fechabaja']))echo $this->Time->format('d/m/Y',$persxoficina['Persxoficina']['fechabaja']); ?>&nbsp;</td>
		<td class="actions">
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-caret-down"></span></a>
					<ul class="dropdown-menu">
					<li>
							<?php 
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'persxoficinas',
								'action'=>'edit',$persxoficina['Persxoficina']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>
					</li>
						<li>
										<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'persxoficinas',
											'action'=>'delete',$persxoficina['Persxoficina']['id']),
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
<?php }else{?>
	<br>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>	
		<strong><?php echo __('Advertencia!')?></strong>&nbsp;<?php echo "No se recuperaron datos para los filtros seleccionados";?></div>
	</div>
<?php }?>