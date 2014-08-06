<?php echo $this->Html->script(array('/js/categorias/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Parentescos')?>    </div>
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
	$i=0;
	foreach ($parentescos as $parentesco):
	?>
	<tr>
		<?php if(empty($parentesco['Parentesco']['parent_id'])):?>	
			<td><?php $refcollapse = 'collapseOne'.$i?>
			<div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $refcollapse ?>">
			          <?php echo $parentesco['Parentesco']['descripcion']; ?>&nbsp;
			        </a>
			      </h4>
			    </div>
			    <div id="<?php echo $refcollapse ?>" class="panel-collapse collapse">
			      <div class="panel-body">
			      	
			      	<?php
			      		$parentescosx=array();
			      		if(!empty($subparentescos[$i]))
			      			$parentescosx = $subparentescos[$i];
			      		foreach($parentescosx as $parentescochild):
			      		
			      	?>
			      		<div class='row'>
			        		<div class="col-lg-5">
			        			<?php echo $parentescochild['Parentesco']['descripcion']?>
			        		</div>
			        		<div class="col-lg-3">
								<div class="btn-group">
								  <a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
								  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
									<span class="fa fa-caret-down"></span></a>
								  <ul class="dropdown-menu">
									<li>
											<?php 
										echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'parentescos',
											'action'=>'edit',$parentescochild['Parentesco']['id']),
											array('onclick'=>'','escape'=>false),
											'');?>
									</li>
									<li>
											<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'parentescos',
														'action'=>'delete',$parentescochild['Parentesco']['id']),
														array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>
									</li>
								  </ul>
								 </div>
			        		</div>
						</div>
			        <?php endforeach; ?>
			      </div>
			    </div>
			  </div>&nbsp;
			 </td>
			<td><?php echo $this->Time->format('d/m/Y',$parentesco['Parentesco']['created']); ?>&nbsp;</td>
			<td><?php echo $this->Time->format('d/m/Y',$parentesco['Parentesco']['modified']); ?>&nbsp;</td>
			<td class="actions">
			<div class="btn-group">
				<a class="btn btn-primary" href="#"><i class="fa fa-plus-circle fa-fw"></i> </a>
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="fa fa-caret-down"></span></a>
						<ul class="dropdown-menu">
							<li>
								<?php 
								echo $this->Html->link('<i class="fa fa-edit fa-fw"></i>&nbsp;'.__('Modificar'),array('controller'=>'parentescos',
									'action'=>'edit',$parentesco['Parentesco']['id']),
									array('onclick'=>'','escape'=>false),
									'');?>								
					
							</li>
							<li>
											<?php echo $this->Html->link('<i class="fa fa-trash-o fa-fw"></i>&nbsp;'.__('Borrar'),array('controller'=>'parentescos',
												'action'=>'delete',$parentesco['Parentesco']['id']),
												array('onclick'=>"return confirm('¿Desea Borrar el Registro Seleccionado?')",'escape'=>false),'');?>						
							</li>
							<li>
									<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Agregar Sub-Parentesco'),array('controller'=>'parentescos',
												'action'=>'addsub',$parentesco['Parentesco']['id']),
												array('onclick'=>"",'escape'=>false),'');?>
							</li>													
						  </ul>
				</div>
			
			</td>
		<?php endif;?>
	</tr>
<?php
	$i++; 
	endforeach; ?>
</tbody>
	<tfoot>
		<tr>
		<td colspan="7" class='row1'>
			<center>
			<div class="pagination">
					<?php echo $paginador = $this->paginator->numbers();?>
							<?php if(!empty($paginador)): ?>
							<ul class="pagination">
							  <li><?php echo $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
							  <li><?php echo $this->paginator->numbers(array('separator'=>''));?></li>
							  <li><?php echo $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
							</ul>		
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
			echo $this->Html->link('<button type="button" class="btn btn-success btn-lw" title="Agregar Parentesco">
																	<span class="glyphicon  glyphicon-plus"></span>Agregar Parentesco</button>',array('controller'=>'parentescos',
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