
<?php if(!empty($personas)){?>
	<br/>
	<div class="table-responsive">
		<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
		<thead>
			<tr>
				<th><div class="sort"><?php echo $this->Paginator->sort('id',__('Id'));?></div></th>
				<th><div class="sort"><?php echo $this->Paginator->sort('fnac',__('Fecha de Nacimiento'));?></div></th>
				<th><div class="sort"><?php echo $this->Paginator->sort('Tipdocxper.nrodoc',__('Documento'));?></div></th>
				<th><div class="sort"><?php echo $this->Paginator->sort('apellido',__('Apellido'));?></div></th>
				<th><div class="sort"><?php echo $this->Paginator->sort('nombre',__('Nombre'));?></div></th>
				<th><div class="sort"><?php echo $this->Paginator->sort('sexo',__('Sexo'));?></div></th>
				<th><?php __('Acciones');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($personas as $persona):
			?>
		<tr>
			<td><?php echo $persona['Persona']['id']; ?></td>
			<td><?php echo $this->Time->format('d/m/Y',$persona['Persona']['fnac']); ?>&nbsp;</td>	
			<td><table class="table table-condensed">
				<?php foreach($persona['Tipdocxper'] as $tipdocpers):?>
					<tr class="active">
					<td width='100px'>
						<p class="text-primary"><?php echo $tipodocs[$tipdocpers['tipodoc_id']];?></p>
					</td>
					<td>
						<p class="text-muted"><?php echo $tipdocpers['nrodoc']?></p>
					</td>
					</tr>
				<?php endforeach; ?>
				</table>
			<td><?php echo $persona['Persona']['apellido']; ?>&nbsp;</td>
			<td><?php echo $persona['Persona']['nombre']; ?>&nbsp;</td>
			<td><?php if($persona['Persona']['sexo']=='F'):?>
					<h4><span class="label label-danger"><?php echo __('Femenino')?></span></h4>
				<?php endif;?>
				<?php if($persona['Persona']['sexo']=='M'):?>
					<h4><span class="label label-success"><?php echo __('Masculino')?></span></h4>
				<?php endif;?>			
			
			</td>
			<td class="actions">
			<div class="btn-group">
				<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
						<ul class="dropdown-menu">
						<li>
								<?php 
								echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'personas',
									'action'=>'edit',$persona['Persona']['id']),
									array('onclick'=>'','escape'=>false),
									'');?>
						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'personas',
									'action'=>'delete',$persona['Persona']['id']),
									array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-map-marker fa-fw"></i>&nbsp;'.__('Marca GPS'),array('controller'=>'personas',
									'action'=>'getlocalize',$persona['Persona']['id']),
									array('onclick'=>"",'escape'=>false),'');?>
						</li>					
						<li>
								<?php echo $this->Html->link('<i class="fa fa-file fa-fw"></i>&nbsp;'.__('Archivos'),array('controller'=>'archivos',
									'action'=>'index',$persona['Persona']['id']),
									array('onclick'=>"",'escape'=>false),'');?>
						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-camera fa-fw"></i>&nbsp;'.__('Tomar Foto'),array('controller'=>'archivos',
									'action'=>'tomarfotopersona',$persona['Persona']['id']),
									array('onclick'=>"",'escape'=>false),'');?>
						</li>					
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