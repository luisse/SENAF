<table class="table table-striped table-bordered table-hover dataTable table-responsive">
<thead>
	<tr>
			<th><div class='sort'><?php echo $this->Paginator->sort('documento',__('Documento'));?></div></th>
			<th><div class='sort'><?php echo $this->Paginator->sort('fechanac',__('Fecha de Nacimiento'));?></div></th>
			<th><div class='sort'><?php echo $this->Paginator->sort('apellido',__('Apellido'));?></div></th>
			<th><div class='sort'><?php echo $this->Paginator->sort('nombre',__('Nombre'));?></div></th>
			<th><?php echo __('Acciones');?></th>
	</tr>
</thead>
<tbody>
	<?php
	$i = 0;
	foreach ($clientes as $cliente):
	?>
	<tr>
		<td><?php echo $cliente['Cliente']['documento'];
				echo $this->Form->hidden('Cliente.id'.$i,array('value'=>$cliente['Cliente']['id']));
				echo $this->Form->hidden('Cliente.Documento'.$i,array('value'=>$cliente['Cliente']['documento']));
				echo $this->Form->hidden('Cliente.NomApe'.$i,array('value'=>$cliente['Cliente']['apellido'].', '.$cliente['Cliente']['nombre']));
				echo $this->Form->hidden('Cuenta.id'.$i,array('value'=>$cliente['Cuenta']['id']));
		?>&nbsp;</td>
		<td><?php echo $this->Time->format('d/m/Y',$cliente['Cliente']['fechanac']); ?>&nbsp;</td>
		<td><?php echo $cliente['Cliente']['apellido']; ?>&nbsp;</td>
		<td><?php echo $cliente['Cliente']['nombre']; ?>&nbsp;</td>
		<td class="actions">
		<center>
				<button type="button" class="btn btn-primary btn-lw" title="Agregar Cliente" onclick='seleccionarcliente(<?php echo $i?>)'>
					<span class="glyphicon  glyphicon-plus"></span>
				</button>	
		</center>
		</td>
	</tr>
<?php $i++;
		endforeach; ?>
</tbody>
	<tfoot>
		<tr>
		<td colspan="7" class='row1'>
			<center>
			<div class="pagination">
				<?php 
				$paginador = $this->paginator->numbers();
				if(!empty($paginador)): ?>
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
