<?php echo $this->Html->script(array('/js/categorias/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
	
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Tipopersonas')?>    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
					<th><?php echo $this->Paginator->sort('descripcion',__('Descripción'));?></th>
					<th><?php echo $this->Paginator->sort('created',__('Creado'));?></th>
					<th><?php echo $this->Paginator->sort('modified',__('Modificado'));?></th>
					<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;
	foreach ($tipopersonas as $tipopersona):
		$class = "row0";
		if ($i++ % 2 == 0) {
			$class = ' class="row1"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $tipopersona['Tipopersona']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $this->Time->format('d/m/Y',$tipopersona['Tipopersona']['created']); ?>&nbsp;</td>
		<td><?php echo $this->Time->format('d/m/Y',$tipopersona['Tipopersona']['modified']); ?>&nbsp;</td>
		<td class="actions">
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-caret-down"></span></a>
					<ul class="dropdown-menu">
					<li>
							<?php 
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'tipopersonas',
								'action'=>'edit',$tipopersona['Tipopersona']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>								
				
						</li>
						<li>
										<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'tipopersonas',
											'action'=>'delete',$tipopersona['Tipopersona']['id']),
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
			<div class="pagination">
					<?php echo $paginador = $this->paginator->numbers();?>
					<?php if(!empty($paginador)): ?>						<center>
							<ul class="pagination">
							  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?>
</li>
							  <li><?php echo $this->paginator->numbers(array('separator'=>''));?>
</li>
							  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?>
</li>
							</ul>	
						</center>	
					<?php endif;?>			</div>
			</center>
		</td>
		</tr>
	</tfoot>
</table>
</center>
</div>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Categoria">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'tipopersonas',
										'action'=>'add',''),
										array('escape'=>false),
					'');		
	?>		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Cancelar')?>
		</button>	
		</center>
	</div>
</div>		
</div>
