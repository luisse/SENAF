<?php echo $this->Html->script(array('/js/domicilios/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
	
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Domicilios')?>    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('paise_id');?></th>
					<th><?php echo $this->Paginator->sort('provincia_id');?></th>
					<th><?php echo $this->Paginator->sort('depto_id');?></th>
					<th><?php echo $this->Paginator->sort('municipio_id');?></th>
					<th><?php echo $this->Paginator->sort('localidade_id');?></th>
					<th><?php echo $this->Paginator->sort('barrio_id');?></th>
					<th><?php echo $this->Paginator->sort('calle_id');?></th>
					<th><?php echo $this->Paginator->sort('descrip');?></th>
					<th><?php echo $this->Paginator->sort('mza');?></th>
					<th><?php echo $this->Paginator->sort('block');?></th>
					<th><?php echo $this->Paginator->sort('piso');?></th>
					<th><?php echo $this->Paginator->sort('dpto');?></th>
					<th><?php echo $this->Paginator->sort('lote');?></th>
					<th><?php echo $this->Paginator->sort('nro');?></th>
					<th><?php echo $this->Paginator->sort('usuariocrea');?></th>
					<th><?php echo $this->Paginator->sort('ipcrea');?></th>
					<th><?php echo $this->Paginator->sort('created');?></th>
					<th><?php echo $this->Paginator->sort('usuarioactu');?></th>
					<th><?php echo $this->Paginator->sort('ipactu');?></th>
					<th><?php echo $this->Paginator->sort('modified');?></th>
					<th><?php echo $this->Paginator->sort('lat');?></th>
					<th><?php echo $this->Paginator->sort('lng');?></th>
					<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($domicilios as $domicilio):
		?>
	<tr>
		<td><?php echo $domicilio['Domicilio']['id']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['paise_id']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['provincia_id']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['depto_id']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['municipio_id']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['localidade_id']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['barrio_id']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['calle_id']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['descrip']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['mza']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['block']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['piso']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['dpto']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['lote']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['nro']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['usuariocrea']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['ipcrea']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['created']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['usuarioactu']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['ipactu']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['modified']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['lat']; ?>&nbsp;</td>
		<td><?php echo $domicilio['Domicilio']['lng']; ?>&nbsp;</td>
		<td class="actions">
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-caret-down"></span></a>
					<ul class="dropdown-menu">
					<li>
							<?php 
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'domicilios',
								'action'=>'edit',$domicilio['Domicilio']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>
					</li>
						<li>
										<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'domicilios',
											'action'=>'delete',$domicilio['Domicilio']['id']),
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
<div class="row">	
	<div class="col-lg-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Categoria">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'domicilios',
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
