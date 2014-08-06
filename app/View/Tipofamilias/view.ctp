<div class="tipofamilias view">
<h2><?php  __('Tipofamilia');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipofamilia['Tipofamilia']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipofamilia['Tipofamilia']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Detalle'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipofamilia['Tipofamilia']['detalle']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipofamilia['Tipofamilia']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipofamilia['Tipofamilia']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipofamilia', true), array('action' => 'edit', $tipofamilia['Tipofamilia']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tipofamilia', true), array('action' => 'delete', $tipofamilia['Tipofamilia']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipofamilia['Tipofamilia']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipofamilias', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipofamilia', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupxfamilias', true), array('controller' => 'grupxfamilias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupxfamilia', true), array('controller' => 'grupxfamilias', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Grupxfamilias');?></h3>
	<?php if (!empty($tipofamilia['Grupxfamilia'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Tipofamilia Id'); ?></th>
		<th><?php __('Grupxpersona Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tipofamilia['Grupxfamilia'] as $grupxfamilia):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $grupxfamilia['id'];?></td>
			<td><?php echo $grupxfamilia['tipofamilia_id'];?></td>
			<td><?php echo $grupxfamilia['grupxpersona_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'grupxfamilias', 'action' => 'view', $grupxfamilia['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'grupxfamilias', 'action' => 'edit', $grupxfamilia['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'grupxfamilias', 'action' => 'delete', $grupxfamilia['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $grupxfamilia['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Grupxfamilia', true), array('controller' => 'grupxfamilias', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
