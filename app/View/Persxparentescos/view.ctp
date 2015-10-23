<div class="persxparentescos view">
<h2><?php  __('Persxparentesco');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxparentesco['Persxparentesco']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Persona'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persxparentesco['Persona']['id'], array('controller' => 'personas', 'action' => 'view', $persxparentesco['Persona']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parentesco'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persxparentesco['Parentesco']['id'], array('controller' => 'parentescos', 'action' => 'view', $persxparentesco['Parentesco']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Persxoficina'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persxparentesco['Persxoficina']['id'], array('controller' => 'persxoficinas', 'action' => 'view', $persxparentesco['Persxoficina']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecharelev'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxparentesco['Persxparentesco']['fecharelev']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuariocrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxparentesco['Persxparentesco']['usuariocrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipcrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxparentesco['Persxparentesco']['ipcrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxparentesco['Persxparentesco']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuarioactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxparentesco['Persxparentesco']['usuarioactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxparentesco['Persxparentesco']['ipactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxparentesco['Persxparentesco']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Persxparentesco', true), array('action' => 'edit', $persxparentesco['Persxparentesco']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Persxparentesco', true), array('action' => 'delete', $persxparentesco['Persxparentesco']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $persxparentesco['Persxparentesco']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Persxparentescos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persxparentesco', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas', true), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona', true), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Parentescos', true), array('controller' => 'parentescos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parentesco', true), array('controller' => 'parentescos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Persxoficinas', true), array('controller' => 'persxoficinas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persxoficina', true), array('controller' => 'persxoficinas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vinculos', true), array('controller' => 'vinculos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vinculo', true), array('controller' => 'vinculos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Vinculos');?></h3>
	<?php if (!empty($persxparentesco['Vinculo'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Persxparentesco Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($persxparentesco['Vinculo'] as $vinculo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $vinculo['id'];?></td>
			<td><?php echo $vinculo['persxparentesco_id'];?></td>
			<td><?php echo $vinculo['persona_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'vinculos', 'action' => 'view', $vinculo['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'vinculos', 'action' => 'edit', $vinculo['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'vinculos', 'action' => 'delete', $vinculo['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $vinculo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vinculo', true), array('controller' => 'vinculos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
