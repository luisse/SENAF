<div class="persxoficinas view">
<h2><?php  __('Persxoficina');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxoficina['Persxoficina']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Persona'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persxoficina['Persona']['id'], array('controller' => 'personas', 'action' => 'view', $persxoficina['Persona']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oficina'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persxoficina['Oficina']['id'], array('controller' => 'oficinas', 'action' => 'view', $persxoficina['Oficina']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Activo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxoficina['Persxoficina']['activo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fechabaja'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxoficina['Persxoficina']['fechabaja']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Persxoficina', true), array('action' => 'edit', $persxoficina['Persxoficina']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Persxoficina', true), array('action' => 'delete', $persxoficina['Persxoficina']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $persxoficina['Persxoficina']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Persxoficinas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persxoficina', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas', true), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona', true), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Oficinas', true), array('controller' => 'oficinas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Oficina', true), array('controller' => 'oficinas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Persxgrupsociales', true), array('controller' => 'persxgrupsociales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persxgrupsociale', true), array('controller' => 'persxgrupsociales', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Persxgrupsociales');?></h3>
	<?php if (!empty($persxoficina['Persxgrupsociale'])):?>
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
		foreach ($persxoficina['Persxgrupsociale'] as $persxgrupsociale):
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
