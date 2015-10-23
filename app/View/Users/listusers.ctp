<?php if(!empty($users)){?>
	<br/>
	<div class="table-responsive">
	<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable table-responsive table-condensed">
		<thead>
			<tr>
				<th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class="sort"><?php echo $this->Paginator->sort('username','Usuario');?></div></th>
				<th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class="sort"><?php echo $this->Paginator->sort('Persona.email','EMail');?></div></th>
				<th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class="sort"><?php echo $this->Paginator->sort('Tipdocxper.nrodoc','Nro. Doc.');?></div></th>			
				<th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class="sort"><?php echo $this->Paginator->sort('Persona.apellido','Apellido');?></div></th>			
				<th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class="sort"><?php echo $this->Paginator->sort('Persona.nombre','Nombre');?></div></th>			
				<th><?php echo __('Acciones');?></th>
			</tr>
		</thead>
	<tbody>
		<?php
		
		$i = 0;
		$usernameant="";
		foreach ($users as $user):
		?>
		<?php if($usernameant<>$user['User']['username']){
			$usernameant = $user['User']['username']
		?>
			<tr>
				<td><?php echo $user['User']['username']; ?>&nbsp;</td>
				<td><?php echo $user['Persona']['email']; ?>&nbsp;</td>
				<td><?php echo $user['Tipdocxper']['nrodoc']; ?>&nbsp;</td>
				<td><?php echo $user['Persona']['apellido']; ?>&nbsp;</td>
				<td><?php echo $user['Persona']['nombre']; ?>&nbsp;</td>		
		
				<td class="actions">
							<div class="btn-group">
							  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
							  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
								<span class="fa fa-caret-down"></span></a>
							  <ul class="dropdown-menu">
								<li>
										<?php 
										echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'users',
											'action'=>'edit',$user['User']['id']),
											array('onclick'=>'','escape'=>false),'');								
										?>
								</li>
								<li>
										<?php
										echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'users',
												'action'=>'valdelete',$user['Persona']['id']),
												array('onclick'=>"return confirm('¿Desea Borrar su usuario de acceso?')",'escape'=>false),'');?>
								</li>
								<li class="divider"></li>
							  </ul>
							 </div>		
				</td>
			</tr>
	<?php }?>
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
	</div>
<?php }else{?>
	<br>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>	
		<strong><?php echo __('Advertencia!')?></strong>&nbsp;<?php echo "No se recuperaron datos para los filtros seleccionados";?></div>
	</div>
<?php }?>	