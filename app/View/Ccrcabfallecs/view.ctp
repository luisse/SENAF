<div class="ccrcabfallecs view">
<h2><?php  __('Ccrcabfallec');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ccrcabfallec['Ccrcabfallec']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fdde'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ccrcabfallec['Ccrcabfallec']['fdde']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fhta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ccrcabfallec['Ccrcabfallec']['fhta']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ccrcabfallec', true), array('action' => 'edit', $ccrcabfallec['Ccrcabfallec']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ccrcabfallec', true), array('action' => 'delete', $ccrcabfallec['Ccrcabfallec']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ccrcabfallec['Ccrcabfallec']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ccrcabfallecs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ccrcabfallec', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ccrfallecidos', true), array('controller' => 'ccrfallecidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ccrfallecido', true), array('controller' => 'ccrfallecidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Ccrfallecidos');?></h3>
	<?php if (!empty($ccrcabfallec['Ccrfallecido'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th><?php __('Ccrcabfallec Id'); ?></th>
		<th><?php __('Ccrcodregfallec Id'); ?></th>
		<th><?php __('Idservicio'); ?></th>
		<th><?php __('Fconfserv'); ?></th>
		<th><?php __('Hconfserv'); ?></th>
		<th><?php __('Fallecido'); ?></th>
		<th><?php __('Dnifall'); ?></th>
		<th><?php __('Domicfall'); ?></th>
		<th><?php __('Localdptofall'); ?></th>
		<th><?php __('Solicitante'); ?></th>
		<th><?php __('Dnisolic'); ?></th>
		<th><?php __('Operador'); ?></th>
		<th><?php __('Empresa'); ?></th>
		<th><?php __('Observ'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($ccrcabfallec['Ccrfallecido'] as $ccrfallecido):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ccrfallecido['id'];?></td>
			<td><?php echo $ccrfallecido['persona_id'];?></td>
			<td><?php echo $ccrfallecido['ccrcabfallec_id'];?></td>
			<td><?php echo $ccrfallecido['ccrcodregfallec_id'];?></td>
			<td><?php echo $ccrfallecido['idservicio'];?></td>
			<td><?php echo $ccrfallecido['fconfserv'];?></td>
			<td><?php echo $ccrfallecido['hconfserv'];?></td>
			<td><?php echo $ccrfallecido['fallecido'];?></td>
			<td><?php echo $ccrfallecido['dnifall'];?></td>
			<td><?php echo $ccrfallecido['domicfall'];?></td>
			<td><?php echo $ccrfallecido['localdptofall'];?></td>
			<td><?php echo $ccrfallecido['solicitante'];?></td>
			<td><?php echo $ccrfallecido['dnisolic'];?></td>
			<td><?php echo $ccrfallecido['operador'];?></td>
			<td><?php echo $ccrfallecido['empresa'];?></td>
			<td><?php echo $ccrfallecido['observ'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'ccrfallecidos', 'action' => 'view', $ccrfallecido['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'ccrfallecidos', 'action' => 'edit', $ccrfallecido['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'ccrfallecidos', 'action' => 'delete', $ccrfallecido['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ccrfallecido['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ccrfallecido', true), array('controller' => 'ccrfallecidos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
