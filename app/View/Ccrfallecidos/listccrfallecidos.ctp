<?php
if(!empty($ccrfallecidos)){
	//print_r($ccrfallecidos);
?>
</br>
<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
			<th><center><h4><strong><i class="fa fa-user fa-fw"></i><?= __('Datos Fallecido')?></strong></h4></center></th>
			<th><center><h4><strong><i class="fa fa-info-circle fa-fw"></i><?= __('Datos Solicitante y Sepelio')?></strong></h4></center></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($ccrfallecidos as $fallecidosccr):
		?>
	<tr>
		<td>
			<table>
				<tr>
					<td><div class="sort"><?= $this->Paginator->sort('idservnume',__('Servicio Id:'));?></div></td>
					<td>&nbsp;<span class="label label-success"><?= $fallecidosccr['Ccrfallecido']['idservnume'].' - '.$fallecidosccr['Ccrfallecido']['idservletra'];?></span></td>
					<td><div class="sort">&nbsp;<?= $this->Paginator->sort('fhconfserv',__('Fecha Hora Servicio:'));?></div></td>
					<td><div class="sort">&nbsp;<?= $this->Time->format('d/m/Y',$fallecidosccr['Ccrfallecido']['fconfserv']).' - '.$fallecidosccr['Ccrfallecido']['hconfserv']; ?></div></td>
				</tr>
				<tr>
					<td><div class="sort"><?= $this->Paginator->sort('dnifall',__('D.NI:'));?></div></td>
					<td><?= $fallecidosccr['Ccrfallecido']['dnifall']; ?></td>
					<td><div class="sort"><?= $this->Paginator->sort('fallecido',__('Nom. Ape:'));?></div></td>
					<td><?= $fallecidosccr['Ccrfallecido']['fallecido']; ?></td>
				</tr>
				<tr>
					<td><div class="sort"><?= $this->Paginator->sort('domicfall',__('Domicilio:'));?></td>
					<td colspan="3"><?= $fallecidosccr['Ccrfallecido']['domicfall']; ?></td>
				</tr>
				<tr>
					<td><div class="sort"><?= $this->Paginator->sort('localdptofall',__('Localidad:'));?></div></td>
					<td  colspan="3"><?= $fallecidosccr['Ccrfallecido']['localdptofall']; ?></td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td><div class='sort'><?= $this->Paginator->sort('dnisolic',__('D.N.I:'));?></div></td>
					<td><?= $fallecidosccr['Ccrfallecido']['dnisolic']; ?>&nbsp;</td>
					<td><div class='sort'><?= $this->Paginator->sort('solicitante',__('Nombre Apellido:'));?></div></td>
					<td><?= $fallecidosccr['Ccrfallecido']['solicitante']; ?>&nbsp;</td>
				<tr>
				<tr>
					<td><div class='sort'><?= $this->Paginator->sort('operador',__('Operador:'));?></div></td>
					<td  colspan="3"><?= $fallecidosccr['Ccrfallecido']['operador']; ?>&nbsp;</td>

				</tr>
				<tr>
					<td><div class='sort'><?= $this->Paginator->sort('operador',__('Empresa:'));?></div></td>
					<td colspan="3"><?= $fallecidosccr['Ccrfallecido']['empresa']; ?>&nbsp;</td>
				</tr>
				<tr>
					<td><div class='sort'><?= $this->Paginator->sort('observ',__('Observaciones:'));?></div></td>
					<td colspan="3"><?= wordwrap(trim($fallecidosccr['Ccrfallecido']['observ']),50, "<br />\n", false); ?>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
		<tfoot>
			<tr>
			<td colspan="4">
					<div class="container" id='central'>
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
	  								  <li><?= $this->paginator->prev('<< ', null, null, array('class'=>'paginator'));?></li>
									  <li><?= $paginador;?></li>
									  <li><?= $this->paginator->next('>>', null, null, array('class'=>'paginator'));?></li>
									</ul>
								</nav>
							<?php endif;?>
							</div>
					</div>
			</td>
			</tr>
		</tfoot>
	</table>
</div>
<?php }else{?>
	<br>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		<strong><?= __('Advertencia!')?></strong>&nbsp;<?= "No se recuperaron datos para los filtros seleccionados";?></div>
	</div>
<?php }?>
