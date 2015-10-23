<div class="estciviles view">
<h2><?php  __('Estcivile');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estcivile['Estcivile']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estcivile['Estcivile']['descrip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codindec'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estcivile['Estcivile']['codindec']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Estcivile', true), array('action' => 'edit', $estcivile['Estcivile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Estcivile', true), array('action' => 'delete', $estcivile['Estcivile']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $estcivile['Estcivile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Estciviles', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estcivile', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas', true), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona', true), array('controller' => 'personas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Personas');?></h3>
	<?php if (!empty($estcivile['Persona'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Apellido'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Sexo'); ?></th>
		<th><?php __('Fnac'); ?></th>
		<th><?php __('Ffallec'); ?></th>
		<th><?php __('Estcivile Id'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Nn'); ?></th>
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
		foreach ($estcivile['Persona'] as $persona):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $persona['id'];?></td>
			<td><?php echo $persona['apellido'];?></td>
			<td><?php echo $persona['nombre'];?></td>
			<td><?php echo $persona['sexo'];?></td>
			<td><?php echo $persona['fnac'];?></td>
			<td><?php echo $persona['ffallec'];?></td>
			<td><?php echo $persona['estcivile_id'];?></td>
			<td><?php echo $persona['email'];?></td>
			<td><?php echo $persona['nn'];?></td>
			<td><?php echo $persona['usuariocrea'];?></td>
			<td><?php echo $persona['ipcrea'];?></td>
			<td><?php echo $persona['created'];?></td>
			<td><?php echo $persona['usuarioactu'];?></td>
			<td><?php echo $persona['ipactu'];?></td>
			<td><?php echo $persona['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'personas', 'action' => 'view', $persona['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'personas', 'action' => 'edit', $persona['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'personas', 'action' => 'delete', $persona['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $persona['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Persona', true), array('controller' => 'personas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
