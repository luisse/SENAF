<div class="grupsociales view">
<h2><?php  __('Grupsociale');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grupsociale['Grupsociale']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Afinidade'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($grupsociale['Afinidade']['id'], array('controller' => 'afinidades', 'action' => 'view', $grupsociale['Afinidade']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Grupsociale', true), array('action' => 'edit', $grupsociale['Grupsociale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Grupsociale', true), array('action' => 'delete', $grupsociale['Grupsociale']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $grupsociale['Grupsociale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupsociales', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupsociale', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Afinidades', true), array('controller' => 'afinidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Afinidade', true), array('controller' => 'afinidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupsocxdomis', true), array('controller' => 'grupsocxdomis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupsocxdomi', true), array('controller' => 'grupsocxdomis', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Persxgrupsociales', true), array('controller' => 'persxgrupsociales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persxgrupsociale', true), array('controller' => 'persxgrupsociales', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Grupsocxdomis');?></h3>
	<?php if (!empty($grupsociale['Grupsocxdomi'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Grupsociale Id'); ?></th>
		<th><?php __('Domicilio Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($grupsociale['Grupsocxdomi'] as $grupsocxdomi):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $grupsocxdomi['id'];?></td>
			<td><?php echo $grupsocxdomi['grupsociale_id'];?></td>
			<td><?php echo $grupsocxdomi['domicilio_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'grupsocxdomis', 'action' => 'view', $grupsocxdomi['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'grupsocxdomis', 'action' => 'edit', $grupsocxdomi['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'grupsocxdomis', 'action' => 'delete', $grupsocxdomi['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $grupsocxdomi['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Grupsocxdomi', true), array('controller' => 'grupsocxdomis', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Persxgrupsociales');?></h3>
	<?php if (!empty($grupsociale['Persxgrupsociale'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th><?php __('Grupsociale Id'); ?></th>
		<th><?php __('Persxoficina Id'); ?></th>
		<th><?php __('Fecharelev'); ?></th>
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
		foreach ($grupsociale['Persxgrupsociale'] as $persxgrupsociale):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $persxgrupsociale['id'];?></td>
			<td><?php echo $persxgrupsociale['persona_id'];?></td>
			<td><?php echo $persxgrupsociale['grupsociale_id'];?></td>
			<td><?php echo $persxgrupsociale['persxoficina_id'];?></td>
			<td><?php echo $persxgrupsociale['fecharelev'];?></td>
			<td><?php echo $persxgrupsociale['usuariocrea'];?></td>
			<td><?php echo $persxgrupsociale['ipcrea'];?></td>
			<td><?php echo $persxgrupsociale['created'];?></td>
			<td><?php echo $persxgrupsociale['usuarioactu'];?></td>
			<td><?php echo $persxgrupsociale['ipactu'];?></td>
			<td><?php echo $persxgrupsociale['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'persxgrupsociales', 'action' => 'view', $persxgrupsociale['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'persxgrupsociales', 'action' => 'edit', $persxgrupsociale['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'persxgrupsociales', 'action' => 'delete', $persxgrupsociale['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $persxgrupsociale['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Persxgrupsociale', true), array('controller' => 'persxgrupsociales', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
