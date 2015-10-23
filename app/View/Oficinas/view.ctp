<div class="oficinas view">
<h2><?php  __('Oficina');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $oficina['Oficina']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $oficina['Oficina']['descrip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codofiexpe'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $oficina['Oficina']['codofiexpe']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Oficina', true), array('action' => 'edit', $oficina['Oficina']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Oficina', true), array('action' => 'delete', $oficina['Oficina']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $oficina['Oficina']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Oficinas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Oficina', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Persxoficinas', true), array('controller' => 'persxoficinas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persxoficina', true), array('controller' => 'persxoficinas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Persxoficinas');?></h3>
	<?php if (!empty($oficina['Persxoficina'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th><?php __('Oficina Id'); ?></th>
		<th><?php __('Activo'); ?></th>
		<th><?php __('Fechabaja'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($oficina['Persxoficina'] as $persxoficina):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $persxoficina['id'];?></td>
			<td><?php echo $persxoficina['persona_id'];?></td>
			<td><?php echo $persxoficina['oficina_id'];?></td>
			<td><?php echo $persxoficina['activo'];?></td>
			<td><?php echo $persxoficina['fechabaja'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'persxoficinas', 'action' => 'view', $persxoficina['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'persxoficinas', 'action' => 'edit', $persxoficina['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'persxoficinas', 'action' => 'delete', $persxoficina['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $persxoficina['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Persxoficina', true), array('controller' => 'persxoficinas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
