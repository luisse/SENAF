<div class="grupopersonas view">
<h2><?php  __('Grupopersona');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grupopersona['Grupopersona']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grupopersona['Grupopersona']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grupopersona['Grupopersona']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grupopersona['Grupopersona']['descripcion']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Grupopersona', true), array('action' => 'edit', $grupopersona['Grupopersona']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Grupopersona', true), array('action' => 'delete', $grupopersona['Grupopersona']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $grupopersona['Grupopersona']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupopersonas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupopersona', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupxpersonas', true), array('controller' => 'grupxpersonas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupxpersona', true), array('controller' => 'grupxpersonas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Grupxpersonas');?></h3>
	<?php if (!empty($grupopersona['Grupxpersona'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th><?php __('Grupopersona Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($grupopersona['Grupxpersona'] as $grupxpersona):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $grupxpersona['id'];?></td>
			<td><?php echo $grupxpersona['persona_id'];?></td>
			<td><?php echo $grupxpersona['grupopersona_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'grupxpersonas', 'action' => 'view', $grupxpersona['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'grupxpersonas', 'action' => 'edit', $grupxpersona['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'grupxpersonas', 'action' => 'delete', $grupxpersona['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $grupxpersona['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Grupxpersona', true), array('controller' => 'grupxpersonas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
