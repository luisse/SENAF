<div class="afinidades view">
<h2><?php  __('Afinidade');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $afinidade['Afinidade']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $afinidade['Afinidade']['descrip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Definicion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $afinidade['Afinidade']['definicion']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Afinidade', true), array('action' => 'edit', $afinidade['Afinidade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Afinidade', true), array('action' => 'delete', $afinidade['Afinidade']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $afinidade['Afinidade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Afinidades', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Afinidade', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupsociales', true), array('controller' => 'grupsociales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupsociale', true), array('controller' => 'grupsociales', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Grupsociales');?></h3>
	<?php if (!empty($afinidade['Grupsociale'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Afinidade Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($afinidade['Grupsociale'] as $grupsociale):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $grupsociale['id'];?></td>
			<td><?php echo $grupsociale['afinidade_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'grupsociales', 'action' => 'view', $grupsociale['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'grupsociales', 'action' => 'edit', $grupsociale['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'grupsociales', 'action' => 'delete', $grupsociale['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $grupsociale['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Grupsociale', true), array('controller' => 'grupsociales', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
