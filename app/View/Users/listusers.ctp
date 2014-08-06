<br/>
<div class="table-responsive">
<table id="dataTables-example" class="table table-striped table-bordered table-hover dataTable table-responsive table-condensed">
	<thead>
		<tr>
			<th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class="sort"><?php echo $this->Paginator->sort('Usuario');?></div></th>
			<th  tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1"  aria-label="Rendering engine: activate to sort column ascending"><div class="sort"><?php echo $this->Paginator->sort('EMail');?></div></th>
			<th><?php echo __('Acciones');?></th>
		</tr>
	</thead>
<tbody>
	<?php
	
	$i = 0;
	foreach ($users as $user):
	?>
	
	<tr>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td><?php echo $user['User']['email']; ?>&nbsp;</td>
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
										'action'=>'valdelete',$user['User']['id']),
										array('onclick'=>"return confirm('¿Desea Borrar su usuario de acceso?')",'escape'=>false),'');?>
						</li>
						<li class="divider"></li>
						<li>	
					<?php
						//if($user['User']['group_id'] == 2)
							echo $this->Html->link('<i class="fa fa-plus-circle fa-fw"></i>&nbsp;'.__('Bicicletas'),array('controller'=>'bicicletas',
										'action'=>'index',$user['User']['id']),
										array('onclick'=>"return confirm('¿Desea Administras las Bicicletas del Cliente seleccionado?')",'escape'=>false),'');?>
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
				<ul class="pagination">
				  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
				  <li><?php echo $this->paginator->numbers(array('separator'=>''));?></li>
				  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
				</ul>	
			</center>				
		</td>
		</tr>
	</tfoot>
</table>
</div>