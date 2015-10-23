<?php echo $this->Html->script(array('/js/categorias/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
	
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Contratoclausulas')?>    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('contrato_id');?></th>
					<th><?php echo $this->Paginator->sort('activa');?></th>
					<th><?php echo $this->Paginator->sort('orden');?></th>
					<th><?php echo $this->Paginator->sort('letra');?></th>
					<th><?php echo $this->Paginator->sort('descrip');?></th>
					<th><?php echo $this->Paginator->sort('monto');?></th>
					<th><?php echo $this->Paginator->sort('cantmax');?></th>
					<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($contratoclausulas as $contratoclausula):
		?>
	<tr>
		<td><?php echo $contratoclausula['Contratoclausula']['id']; ?>&nbsp;</td>
		<td><?php echo $contratoclausula['Contratoclausula']['contrato_id']; ?>&nbsp;</td>
		<td><?php echo $contratoclausula['Contratoclausula']['activa']; ?>&nbsp;</td>
		<td><?php echo $contratoclausula['Contratoclausula']['orden']; ?>&nbsp;</td>
		<td><?php echo $contratoclausula['Contratoclausula']['letra']; ?>&nbsp;</td>
		<td><?php echo $contratoclausula['Contratoclausula']['descrip']; ?>&nbsp;</td>
		<td><?php echo $contratoclausula['Contratoclausula']['monto']; ?>&nbsp;</td>
		<td><?php echo $contratoclausula['Contratoclausula']['cantmax']; ?>&nbsp;</td>
		<td class="actions">
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-caret-down"></span></a>
					<ul class="dropdown-menu">
					<li>
							<?php 
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'contratoclausulas',
								'action'=>'edit',$contratoclausula['contratoclausula']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>
					</li>
						<li>
										<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'contratoclausulas',
											'action'=>'delete',$contratoclausula['contratoclausula']['id']),
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
<?php if(!empty($paginador)): ?>
						<center>
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
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'contratoclausulas',
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
	<?php $this->Session->flash() ?>
</div>
