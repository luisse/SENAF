<?php echo $this->Html->script(array('/js/ccrfallecidos/cargarsepelioscvs.js','fgenerales','jquery.toastmessage','jquery.numeric','fmensajes.js','dateformat.js','bootstrap-datetimepicker'),array('block'=>'scriptjs'));	?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>

<?php if(empty($ccrfallecidostodos)):?>
<?php echo $this->Form->create('Ccrfallecido',array('action'=>'cargarsepelioscvs',
				'type'=>'file',
				'inputDefaults' => array(
									'div' => 'form-group',
									'wrapInput' => false,
									'class' => 'form-control'
									),
				'class' => 'well'));?>
<legend><?php echo __('Nueva Carga de Sepelios')?></legend>
<div class="row">
	<div class="row">
		<div class="col-lg-2">
			<strong><?php echo __('Fecha Archivo Desde')?> </strong>
			<div class="form-group">
				<div class='input-group date' id='datetimepicker1'
					data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('Ccrcabfallec.fdde',array('label' =>false,
													'placeholder' => false,
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				</div>
			</div>
		</div>
		<div class="col-lg-2">
			<strong><?php echo __('Fecha Archivo Hasta')?> </strong>
			<div class="form-group">
				<div class='input-group date' id='datetimepicker2'
					data-date-format="DD/MM/YYYY">
					<?php echo $this->Form->input('Ccrcabfallec.fhta',array('label' =>false,
														'placeholder' => false,
														'class'=>'form-control input-sm',
														'type'=>'text',
														'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	<div class="col-lg-10">
			<?php echo $this->Form->input('File',array('label' => __('Archivo CSV'),
												'placeholder' => __('Seleccionar Archivo'),
												'class'=>'form-control input-sm',
												'type'=>'file',
												'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Procesar CVS') ?>
		</button>
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>
		</center>
	</div>
</div>
<?php echo $this->Form->end()?>
<?php endif;?>

<?php if(!empty($ccrfallecidostodos)):?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Ccrfallecido',array('action'=>'guardarccrfallecidos'));?>
<?php echo $this->Form->hidden('Ccrcabfallec.fdde')?>
<?php echo $this->Form->hidden('Ccrcabfallec.fhta')?>
<?php echo $this->Form->hidden('Ccrcabfallec.nombarch')?>
<?php echo $this->Form->hidden('Ccrcabfallec.cantreg')?>
<?php echo $this->Form->hidden('Ccrcabfallec.usuariocrea')?>
<?php echo $this->Form->hidden('Ccrcabfallec.ipcrea')?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Resultato de Procesamiento')?>    </div>
	<br>
	<div class="table-responsive">
<div class="panel-body">
<div class='container'>

	<div class="row">
		<?php if(!empty($ccrcabfallecs)):?>
			<?php print_r($ccrcabfallecs);?>
		<div class="col-lg-8">
			<div class="alert  alert-danger" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><label for="name"><?= __('Archivo ya Procesado!!')?></label><br>
					<strong>Archivo Nombre:</strong>&nbsp;<?= $ccrcabfallecs['Ccrcabfallec']['nombarch']?> <br>
					<strong>Fecha Desde:</strong>&nbsp;<?= $this->Time->format('d/m/Y',$ccrcabfallecs['Ccrcabfallec']['fdde']) ?><br>
					<strong>Fecha Hasta:</strong>&nbsp;<?= $this->Time->format('d/m/Y',$ccrcabfallecs['Ccrcabfallec']['fhta'])?><br>
					<strong>Usuario Carga:</strong>&nbsp;<?= $ccrcabfallecs['Ccrcabfallec']['usuariocrea']?>
			</div>
		</div>
		<?php endif;?>
		<?php if(empty($ccrcabfallecs)):?>
		<div class="col-lg-3">
			<div class="alert alert-success" role="alert">
					<label for="name"><?php echo __('Total de Filas Procesadas:')?></strong><?php echo $totalregistros?>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				  <span><?php echo __('Registros con error')?>:&nbsp;</span><?php echo $conerror?>
			</div>
		</div>
		<?php if(empty($fatal_error)):?>
		<div class="col-lg-2">
			<div class="center-block">
				<button type="button" class="btn btn-success btn-lw" id='guardardatos'>
				  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Confirmar Guardado')?>
				</button>
			</div>
		</div>
		<?php endif;?>
		<?php endif;?>
		<div class="col-lg-2">
			<center>
			<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
			  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Volver al Inicio')?>
			</button>
			</center>
		</div>
	</div>
</div>
	<div class="table-responsive">
	<table  class="table table-striped table-bordered table-hover dataTable table-responsive">
	<thead>
		<tr>
			<th><center><h4><strong><i class="fa fa-user fa-fw"></i><?php echo __('Datos Fallecido')?></strong></h4></center></th>
			<th><center><h4><strong><i class="fa fa-info-circle fa-fw"></i><?php echo __('Datos Solicitante y Sepelio')?></strong></h4></center></th>
			<th><?php echo __('Fila Estado')?></th>
			<th><?php __('Registro Activo');?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i=0;
	foreach ($ccrfallecidostodos as $ccrfallecido):
	$ccrfallecidodb=array();
		?>
	<tr>
		<!-- TODOS LOS DATOS SE DEBEN GUARDAR SIEMPRE -->
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.idservnume',array('value'=>$ccrfallecido['Ccrfallecido']['idservnume']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.idservletra',array('value'=>$ccrfallecido['Ccrfallecido']['idservletra']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.fconfserv',array('value'=>$ccrfallecido['Ccrfallecido']['fconfserv']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.hconfserv',array('value'=>$ccrfallecido['Ccrfallecido']['hconfserv']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.fallecido',array('value'=>$ccrfallecido['Ccrfallecido']['fallecido']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.dnifall',array('value'=>$ccrfallecido['Ccrfallecido']['dnifall']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.domicfall',array('value'=>$ccrfallecido['Ccrfallecido']['domicfall']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.localdptofall',array('value'=>$ccrfallecido['Ccrfallecido']['localdptofall']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.solicitante',array('value'=>$ccrfallecido['Ccrfallecido']['solicitante']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.dnisolic',array('value'=>$ccrfallecido['Ccrfallecido']['dnisolic']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.operador',array('value'=>$ccrfallecido['Ccrfallecido']['operador']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.empresa',array('value'=>$ccrfallecido['Ccrfallecido']['empresa']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.observ',array('value'=>$ccrfallecido['Ccrfallecido']['observ']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.ipcrea',array('value'=>$ccrfallecido['Ccrfallecido']['ipcrea']))?>
		<?php echo $this->Form->hidden('Ccrfallecido.'.$i.'.usuariocrea',array('value'=>$ccrfallecido['Ccrfallecido']['usuariocrea']))?>
		<!-- FIN ALL -->
		<td>
			<table cellspacing="1" border="0">
				<tr>
					<td class="key"><strong><?php echo __('Servicio Id:');?></strong></td>
					<td>&nbsp;
						<?php
							$ls_class='label-success';
							if($ccrfallecido['Ccrfallecido']['error_idservletra'] == 1)
								$ls_class='label-danger';
						?>

						<span class="label <?php echo $ls_class ?>">
							<?php echo $ccrfallecido['Ccrfallecido']['idservnume'].' - '.$ccrfallecido['Ccrfallecido']['idservletra'];?>
						</span>
					</td>
					<td><strong><?php echo __('Fecha Servicio:');?></strong></td>
					<td>&nbsp;

						<?php if($ccrfallecido['Ccrfallecido']['fecerror'] == 1 ):?>
							<span class="label label-danger">
						<?php endif;?>
						<?php echo  $ccrfallecido['Ccrfallecido']['fconfserv'].' - '.$ccrfallecido['Ccrfallecido']['hconfserv'];?></td>
						<?php if($ccrfallecido['Ccrfallecido']['fecerror'] == 1 ):?>
							</span>
						<?php endif;?>
				</tr>
				<tr>
					<td><strong><?php echo __('D.NI:');?></strong></td>
					<td><?php echo $ccrfallecido['Ccrfallecido']['dnifall']; ?></td>
					<td><strong><?php echo __('Nom. Ape:');?></strong></td>
					<td><?php echo $ccrfallecido['Ccrfallecido']['fallecido']; ?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Domicilio:');?></strong></td>
					<td colspan="3"><?php echo $ccrfallecido['Ccrfallecido']['domicfall']; ?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Localidad:');?></strong></td>
					<td  colspan="3"><?php echo $ccrfallecido['Ccrfallecido']['localdptofall']; ?></td>
				</tr>
			</table>
		</td>
		<td>
			<table  cellspacing="1" border="0">
				<tr>
					<td><strong><?php echo __('D.N.I:');?></strong></td>
					<td><?php echo $ccrfallecido['Ccrfallecido']['dnisolic']; ?>&nbsp;</td>
					<td><strong><?php echo __('Nombre Apellido:');?></strong></td>
					<td><?php echo $ccrfallecido['Ccrfallecido']['solicitante']; ?>&nbsp;</td>
				<tr>
				<tr>
					<td><strong><?php echo __('Operador:');?></strong></td>
					<td  colspan="3"><?php echo $ccrfallecido['Ccrfallecido']['operador']; ?>&nbsp;</div></td>

				</tr>
				<tr>
					<td><strong><?php echo __('Empresa:');?></strong></td>
					<td colspan="3"><?php echo $ccrfallecido['Ccrfallecido']['empresa']; ?>&nbsp;</td>
				</tr>
				<tr>
					<td><strong><?php echo __('Observaciones:');?></strong></td>
					<td colspan="3"><?php echo wordwrap($ccrfallecido['Ccrfallecido']['observ'],50, "<br />\n", false); ?>&nbsp;</td>
				</tr>
			</table>
		</td>
		<td>
		<?php
				if($ccrfallecido['Ccrfallecido']['distinct']==0)
					echo __('<h4><span class="label label-success"><i class="fa fa-check fa-fw"></i>'.__('Guardar').'</span></h4>');
				else
					echo __('<h4><span class="label label-danger"><i class="fa fa-thumbs-o-down fa-fw"></i>'.__('Distintos').'</span></h4>'); ?>&nbsp;
		</td>
		<td>
			<?php if($ccrfallecido['Ccrfallecido']['distinct'] == 1):?>
			<?php echo $this->Form->input('Ccrfallecido.'.$i.'.guardar',array('type'=>'checkbox','checked','label'=>false))?>
			<?php endif;?>
		</td>
	</tr>
			<!-- SOLO SE ACTUALIZA EL VALOR SI ES NECESARIO -->
	<?php
		if(!empty($ccrfallecido['Ccrfallecido']['db'])){
			$ccrfallecidodb = $ccrfallecido['Ccrfallecido']['db'];
			echo $this->Form->hidden('Ccrfallecido.'.$i.'.id',array('value'=>$ccrfallecidodb['Ccrfallecido']['id']));
		}
		if($ccrfallecido['Ccrfallecido']['distinct'] == 1):
	?>
	<tr class='danger'>
		<td>
			<table cellspacing="1" border="0">
				<tr>
					<td class="key"><strong><?php echo __('Servicio Id:');?></strong></td>
					<td>&nbsp;<span class="label label-success"><?php echo $ccrfallecidodb['Ccrfallecido']['idservnume'].' - '.$ccrfallecidodb['Ccrfallecido']['idservletra'];?></span></td>
					<td><strong><?php echo __('Fecha Fallece:');?></strong></td>
					<td>&nbsp;<?php echo  $this->Time->format('d/m/Y',$ccrfallecidodb['Ccrfallecido']['fconfserv']).
							$this->Time->format('H:i',$ccrfallecidodb['Ccrfallecido']['hconfserv']); ?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('D.NI:');?></strong></td>
					<td><?php echo $ccrfallecidodb['Ccrfallecido']['dnifall']; ?></td>
					<td><strong><?php echo __('Nom. Ape:');?></strong></td>
					<td><?php echo $ccrfallecidodb['Ccrfallecido']['fallecido']; ?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Domicilio:');?></strong></td>
					<td colspan="3"><?php echo $ccrfallecidodb['Ccrfallecido']['domicfall']; ?></td>
				</tr>
				<tr>
					<td><strong><?php echo __('Localidad:');?></strong></td>
					<td  colspan="3"><?php echo $ccrfallecidodb['Ccrfallecido']['localdptofall']; ?></td>
				</tr>
			</table>
		</td>
		<td>
			<table  cellspacing="1" border="0">
				<tr>
					<td><strong><?php echo __('D.N.I:');?></strong></td>
					<td><?php echo $ccrfallecidodb['Ccrfallecido']['dnisolic']; ?>&nbsp;</td>
					<td><strong><?php echo __('Nombre Apellido:');?></strong></td>
					<td><?php echo $ccrfallecidodb['Ccrfallecido']['solicitante']; ?>&nbsp;</td>
				<tr>
				<tr>
					<td><strong><?php echo __('Operador:');?></strong></td>
					<td  colspan="3"><?php echo $ccrfallecidodb['Ccrfallecido']['operador']; ?>&nbsp;</div></td>

				</tr>
				<tr>
					<td><strong><?php echo __('Empresa:');?></strong></td>
					<td colspan="3"><?php echo $ccrfallecidodb['Ccrfallecido']['empresa']; ?>&nbsp;</td>
				</tr>
				<tr>
					<td><strong><?php echo __('Observaciones:');?></strong></td>
					<td colspan="3"><?php echo wordwrap($ccrfallecidodb['Ccrfallecido']['observ'],50, "<br />\n", false); ?>&nbsp;</td>
				</tr>
			</table>
		</td>
		<td></td>
		<td>
		<?php echo $this->Form->input('Ccrfallecido.'.$i.'.guardar',array('type'=>'checkbox','label'=>false))?>
		</td>
	</tr>
	<?php endif;?>
<?php
$i++;
endforeach; ?>
</tbody>
</table>
</center>
</div>
<div class="row">
</div>
</div>
<?php echo $this->Form->end();?>
<?php endif;?>

<?php if(!empty($error)):?>
	<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
		<strong><?php echo __('Advertencia!')?></strong>&nbsp;<?php echo $error;?></div>
	</div>

<?php endif;?>
