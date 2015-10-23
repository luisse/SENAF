<?php if(!empty($archivos)){?>
	<br>
	<div class="table-responsive">
		<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
		<thead>
			<tr>
						<th><div  class="sort"><?php echo $this->Paginator->sort('Tiparchivo.descrip','Tipo de Archivo');?></div></th>
						<th><div  class="sort"><?php echo $this->Paginator->sort('descrip','Descripción');?></div></th>
						<th><div  class="sort"><?php echo $this->Paginator->sort('usuariocrea','Usuario Crea');?></div></th>
						<th><div  class="sort"><?php echo $this->Paginator->sort('created','Fecha Carga');?></div></th>
						<th><?php __('Acciones');?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ($archivos as $archivo):
			?>
		<tr>
			<td><?php echo $archivo['Tiparchivo']['descrip']; ?>&nbsp;</td>
			<td><?php echo $archivo['Archivo']['descrip']; ?>&nbsp;</td>
			<td><?php echo $archivo['Archivo']['usuariocrea']; ?>&nbsp;</td>
			<td><?php echo $this->Time->format('d/m/Y H:m:s',$archivo['Archivo']['created']); ?>&nbsp;</td>			
			<td class="actions">
			<div class="btn-group">
				<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
						<ul class="dropdown-menu">
						<li>
								<?php 
								echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'archivos',
									'action'=>'edit',$archivo['Archivo']['id']),
									array('onclick'=>'','escape'=>false),
									'');?>
						</li>
						<li>
								<!-- SOLO PUEDEN ELIMINAR ARCHIVOS LOS USUARIOS QUE LOS CARGARON -->
								<?php if($archivo['Archivo']['usuariocrea'] == $this->Session->read('username')):?>
								<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'archivos',
									'action'=>'delete',$archivo['Archivo']['id']),
									array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
								<?php endif;?>
						</li>
						<li>
								<?php echo $this->Html->link('<i class="fa fa-eye fa-fw"></i>&nbsp;'.__('Ver Archivo'),array('controller'=>'archivos',
										'action'=>'verarchivo',$archivo['Archivo']['id']),
										array('onclick'=>"return confirm('¿Desea Ver el Registro Seleccionado?')",'escape'=>false),'');?>						</li>
						 </ul>
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
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Categoria">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar</button>',array('controller'=>'archivos',
										'action'=>'add',''),
										array('escape'=>false),
					'');		
	?>		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<?php
			echo $this->Html->link('<button type="button" class="btn btn-danger btn-lw" title="Cancelar">
																	<span class="glyphicon  glyphicon-off"></span>&nbsp;Cancelar</button>',array('controller'=>'personas',
										'action'=>'index',''),
										array('escape'=>false),
					'');?>		
		</center>
	</div>
</div>