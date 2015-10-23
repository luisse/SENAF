<?php echo $this->Html->script(array('/js/categorias/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
	
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Persxgrupsociales')?>    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
	<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
					<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('persona_id');?></th>
					<th><?php echo $this->Paginator->sort('grupsociale_id');?></th>
					<th><?php echo $this->Paginator->sort('persxoficina_id');?></th>
					<th><?php echo $this->Paginator->sort('fecharelev');?></th>
					<th><?php echo $this->Paginator->sort('usuariocrea');?></th>
					<th><?php echo $this->Paginator->sort('ipcrea');?></th>
					<th><?php echo $this->Paginator->sort('created');?></th>
					<th><?php echo $this->Paginator->sort('usuarioactu');?></th>
					<th><?php echo $this->Paginator->sort('ipactu');?></th>
					<th><?php echo $this->Paginator->sort('modified');?></th>
					<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($persxgrupsociales as $persxgrupsociale):
		?>
	<tr>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['id']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['persona_id']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['grupsociale_id']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['persxoficina_id']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['fecharelev']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['usuariocrea']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['ipcrea']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['created']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['usuarioactu']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['ipactu']; ?>&nbsp;</td>
		<td><?php echo $persxgrupsociale['Persxgrupsociale']['modified']; ?>&nbsp;</td>
		<td class="actions">
		<div class="btn-group">
			<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="fa fa-caret-down"></span></a>
					<ul class="dropdown-menu">
					<li>
							<?php 
							echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'persxgrupsociales',
								'action'=>'edit',$persxgrupsociale['persxgrupsociale']['id']),
								array('onclick'=>'','escape'=>false),
								'');?>
					</li>
						<li>
										<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'persxgrupsociales',
											'action'=>'delete',$persxgrupsociale['persxgrupsociale']['id']),
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
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Categoria">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'persxgrupsociales',
										'action'=>'add',''),
										array('escape'=>false),
					'');		
	?>		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
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
