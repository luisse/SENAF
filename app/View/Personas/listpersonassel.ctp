
<br/>
<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
			<th><div class="sort"><?php echo $this->Paginator->sort('fnac',__('Fecha de Nacimiento'));?></div></th>
			<th><div class="sort"><?php echo $this->Paginator->sort('Tipdoc.descred',__('Tipo y Nro Doc.'));?></div></th>
			<th><div class="sort"><?php echo $this->Paginator->sort('apellido',__('Apellido'));?></div></th>
			<th><div class="sort"><?php echo $this->Paginator->sort('nombre',__('Nombre'));?></div></th>
			<th><div class="sort"><?php echo $this->Paginator->sort('sexo',__('Sexo'));?></div></th>
			<th><?php __('Acciones');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i=0;
	foreach ($personas as $persona):
		?>
	<tr>
		<td>
		<?php 
			$nrodoc = 0;
			$tipdoc = 0;
			if(!empty($persona['Tipdocxper'][0])) 
				$nrodoc = $persona['Tipdocxper'][0]['nrodoc'];
			if(!empty($persona['Tipdocxper'][0]))
				$tipdoc = $persona['Tipdocxper'][0]['tipodoc_id'];
			echo $this->Form->hidden('Persona.id'.$i,array('value'=>$persona['Persona']['id']));
			echo $this->Form->hidden('Persona.Documento'.$i,array('value'=>$nrodoc));
			echo $this->Form->hidden('Persona.NomApe'.$i,array('value'=>$persona['Persona']['apellido'].', '.$persona['Persona']['nombre']));
			echo $this->Form->hidden('Persona.Apellido'.$i,array('value'=>$persona['Persona']['apellido']));
			echo $this->Form->hidden('Persona.Nombre'.$i,array('value'=>$persona['Persona']['nombre']));
		?>
		<?php echo $this->Time->format('d/m/Y',$persona['Persona']['fnac']); ?>&nbsp;
		</td>	
		<td>
			<table>
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
		</td>
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
				<button type="button" class="btn btn-primary btn-lw" title="Agregar Persona" onclick='seleccionarpersona(<?php echo $i?>)'>
					<span class="glyphicon  glyphicon-plus"></span>
				</button>				
		</td>
	</tr>
<?php 
	$i++;
	endforeach;
?>
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
