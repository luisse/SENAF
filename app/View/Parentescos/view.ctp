<div class="parentescos view">
<h2><?php  __('Parentesco');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parentesco['Parentesco']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parentesco['Parentesco']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Parentesco'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($parentesco['ParentParentesco']['id'], array('controller' => 'parentescos', 'action' => 'view', $parentesco['ParentParentesco']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parentesco['Parentesco']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $parentesco['Parentesco']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Parentesco', true), array('action' => 'edit', $parentesco['Parentesco']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Parentesco', true), array('action' => 'delete', $parentesco['Parentesco']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $parentesco['Parentesco']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Parentescos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parentesco', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Parentescos', true), array('controller' => 'parentescos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Parentesco', true), array('controller' => 'parentescos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Perparentescos', true), array('controller' => 'perparentescos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Perparentesco', true), array('controller' => 'perparentescos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Parentescos');?></h3>
	<?php if (!empty($parentesco['ChildParentesco'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Descripcion'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($parentesco['ChildParentesco'] as $childParentesco):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childParentesco['id'];?></td>
			<td><?php echo $childParentesco['descripcion'];?></td>
			<td><?php echo $childParentesco['parent_id'];?></td>
			<td><?php echo $childParentesco['created'];?></td>
			<td><?php echo $childParentesco['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'parentescos', 'action' => 'view', $childParentesco['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'parentescos', 'action' => 'edit', $childParentesco['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'parentescos', 'action' => 'delete', $childParentesco['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childParentesco['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Parentesco', true), array('controller' => 'parentescos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Perparentescos');?></h3>
	<?php if (!empty($parentesco['Perparentesco'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th><?php __('Parentesco Id'); ?></th>
		<th><?php __('Personapar Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($parentesco['Perparentesco'] as $perparentesco):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $perparentesco['id'];?></td>
			<td><?php echo $perparentesco['persona_id'];?></td>
			<td><?php echo $perparentesco['parentesco_id'];?></td>
			<td><?php echo $perparentesco['personapar_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'perparentescos', 'action' => 'view', $perparentesco['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'perparentescos', 'action' => 'edit', $perparentesco['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'perparentescos', 'action' => 'delete', $perparentesco['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $perparentesco['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Perparentesco', true), array('controller' => 'perparentescos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
