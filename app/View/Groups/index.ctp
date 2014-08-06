<!--     BLOQUE DE BOTONES -->
<div id="toolbar-box">
   			<div class="t">

				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
				<div class="toolbar" id="toolbar">
<table class="toolbar"><tr>
<?php if($tipousr == 1):?>
<td class="button" id="toolbar-new">
	<?php echo $this->Html->link('<span class="icon-32-new" title="Nuevo Tipousuarios"></span>Nuevo',array('controller'=>'tipousuarios',
						'action'=>'add',''),array('escape' => false)) ?>
</td>
<?php endif;?>
<td class="button" id="toolbar-cancel">
<?php echo $this->Html->link('<span class="icon-32-cancel" title="Cancelar"></span>Cancelar',array('controller'=>'tipousuarios',
						'action'=>'index',''),array('escape' => false))?></td>
</tr>
</table>
</div>
<div class="header icon-48-addedit">
<?php echo __('Tipousuarios') ?>: <small><small><?php echo __('Administración de Tipousuarios')?></small></small></div>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
</div>
<div class="clr"></div>

<!-- FIN BLOQUE BOTONES -->

<center>
<table cellspacing="1" width='80%'  class="adminlist">
<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('descripcion');?></th>
			<th><?php echo $this->Paginator->sort('estado');?></th>
			<th><?php __('Acciones');?></th>
	</tr>
</thead>
<tbody>
	<?php
	$i = 0;
	foreach ($tipousuarios as $tipousuario):
		$class = "row0";
		if ($i++ % 2 == 0) {
			$class = ' class="row1"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $tipousuario['Tipousuario']['id']; ?>&nbsp;</td>
		<td><?php echo $tipousuario['Tipousuario']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $tipousuario['Tipousuario']['estado']; ?>&nbsp;</td>
		<td class="actions">
		<center>
		<div>
		<?php 
						echo $this->Html->link($this->Html->image('edit.png',array('title'=>__('Editar',true))),array('controller'=>'tipousuarios',
							'action'=>'edit',$tipousuario['tipousuario']['id']),
							array('onclick'=>'','escape'=>false),
							'');
					?>
					&nbsp;
					<?php
						echo $this->Html->link($this->Html->image('delete.gif',array('title'=>__('Borrar Cedente',true))),array('controller'=>'tipousuarios',
										'action'=>'borrar',$tipousuario['tipousuario']['id']),
										array('onclick'=>"return confirm('¿Desea borrar el Cedente seleccionado?')",'escape'=>false),
					'');?>		</div>
		</center>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
	<tfoot>
		<tr>
		<td colspan="7" class='row1'>
			<div class="pagination">
			<?php echo $paginator->prev('<< '.__('Anterior', true), null, null, array('class'=>'disabled'));?>
<?php echo $paginator->numbers();?>
<?php echo $paginator->next(__('Siguiente', true).' >>', null, null, array('class'=>'disabled'));?>
			</div>
		</td>
		</tr>
	</tfoot>
</table>
</center>