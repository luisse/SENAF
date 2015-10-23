<div class="archivos view">
<h2><?php  __('Archivo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archivo['Archivo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tiparchivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($archivo['Tiparchivo']['id'], array('controller' => 'tiparchivos', 'action' => 'view', $archivo['Tiparchivo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Archivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archivo['Archivo']['archivo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archivo['Archivo']['descrip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuariocrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archivo['Archivo']['usuariocrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipcrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archivo['Archivo']['ipcrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archivo['Archivo']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuarioactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archivo['Archivo']['usuarioactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archivo['Archivo']['ipactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archivo['Archivo']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Archivo', true), array('action' => 'edit', $archivo['Archivo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Archivo', true), array('action' => 'delete', $archivo['Archivo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $archivo['Archivo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Archivos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archivo', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tiparchivos', true), array('controller' => 'tiparchivos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tiparchivo', true), array('controller' => 'tiparchivos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archxpersonas', true), array('controller' => 'archxpersonas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archxpersona', true), array('controller' => 'archxpersonas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Archxpersonas');?></h3>
	<?php if (!empty($archivo['Archxpersona'])):?>
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
		foreach ($archivo['Archxpersona'] as $archxpersona):
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
