<?php echo $this->Html->script(array('/js/categorias/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
	
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Personas')?>    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('nombre');?></th>
					<th><?php echo $this->Paginator->sort('apellido');?></th>
					<th><?php echo $this->Paginator->sort('sexo');?></th>
					<th><?php echo $this->Paginator->sort('nn');?></th>
					<th><?php echo $this->Paginator->sort('provincia_id');?></th>
					<th><?php echo $this->Paginator->sort('localidade_id');?></th>
					<th><?php echo $this->Paginator->sort('departamento_id');?></th>
					<th><?php echo $this->Paginator->sort('tipopersona_id');?></th>
					<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;
	foreach ($personas as $persona):
		$class = "row0";
		if ($i++ % 2 == 0) {
			$class = ' class="row1"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $persona['Persona']['id']; ?>&nbsp;</td>
		<td><?php echo $persona['Persona']['nombre']; ?>&nbsp;</td>
		<td><?php echo $persona['Persona']['apellido']; ?>&nbsp;</td>
		<td><?php echo $persona['Persona']['sexo']; ?>&nbsp;</td>
		<td><?php echo $persona['Persona']['nn']; ?>&nbsp;</td>
		<td><?php echo $persona['Persona']['provincia_id']; ?>&nbsp;</td>
		<td><?php echo $persona['Persona']['localidade_id']; ?>&nbsp;</td>
		<td><?php echo $persona['Persona']['departamento_id']; ?>&nbsp;</td>
		<td><?php echo $persona['Persona']['tipopersona_id']; ?>&nbsp;</td>
		<td class="actions">
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-caret-down"></span></a>
					<ul class="dropdown-menu">
					<li>
							<?php 
							echo ->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'personas',
								'action'=>'edit',$persona['persona']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>								
				
						</li>
						<li>
										<?php echo ->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'personas',
											'action'=>'delete',$persona['persona']['id']),
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
					<?php echo $paginador = ->numbers();<?php echo if(!empty()): ?>						<center>
							<ul class="pagination">
							  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?>
</li>
							  <li><?php echo $this->paginator->numbers(array('separator'=>''));?>
</li>
							  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?>
</li>
							</ul>	
						</center>	
					endif;?>			</div>
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
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'categorias',
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
<div id='message' style='hidden'>
	<?php ->flash() ?>
</div>
