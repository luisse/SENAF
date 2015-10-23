<div class="permisos view">
<h2><?php  __('Permiso');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $permiso['Permiso']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $permiso['Permiso']['descrip']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Permiso', true), array('action' => 'edit', $permiso['Permiso']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Permiso', true), array('action' => 'delete', $permiso['Permiso']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $permiso['Permiso']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Permisos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Permiso', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archxpersonas', true), array('controller' => 'archxpersonas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archxpersona', true), array('controller' => 'archxpersonas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Archxpersonas');?></h3>
	<?php if (!empty($permiso['Archxpersona'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th><?php __('Archivo Id'); ?></th>
		<th><?php __('Permiso Id'); ?></th>
		<th><?php __('Observ'); ?></th>
		<th><?php __('Usuariocrea'); ?></th>
		<th><?php __('Ipcrea'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Usuarioactu'); ?></th>
		<th><?php __('Ipactu'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($permiso['Archxpersona'] as $archxpersona):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $archxpersona['id'];?></td>
			<td><?php echo $archxpersona['persona_id'];?></td>
			<td><?php echo $archxpersona['archivo_id'];?></td>
			<td><?php echo $archxpersona['permiso_id'];?></td>
			<td><?php echo $archxpersona['observ'];?></td>
			<td><?php echo $archxpersona['usuariocrea'];?></td>
			<td><?php echo $archxpersona['ipcrea'];?></td>
			<td><?php echo $archxpersona['created'];?></td>
			<td><?php echo $archxpersona['usuarioactu'];?></td>
			<td><?php echo $archxpersona['ipactu'];?></td>
			<td><?php echo $archxpersona['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'archxpersonas', 'action' => 'view', $archxpersona['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'archxpersonas', 'action' => 'edit', $archxpersona['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'archxpersonas', 'action' => 'delete', $archxpersona['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $archxpersona['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Archxpersona', true), array('controller' => 'archxpersonas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
