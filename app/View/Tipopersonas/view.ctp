<div class="tipopersonas view">
<h2><?php  __('Tipopersona');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipopersona['Tipopersona']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipopersona['Tipopersona']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipopersona['Tipopersona']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipopersona['Tipopersona']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipopersona', true), array('action' => 'edit', $tipopersona['Tipopersona']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tipopersona', true), array('action' => 'delete', $tipopersona['Tipopersona']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipopersona['Tipopersona']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipopersonas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipopersona', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas', true), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona', true), array('controller' => 'personas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Personas');?></h3>
	<?php if (!empty($tipopersona['Persona'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Apellido'); ?></th>
		<th><?php __('Sexo'); ?></th>
		<th><?php __('Nn'); ?></th>
		<th><?php __('Provincia Id'); ?></th>
		<th><?php __('Localidade Id'); ?></th>
		<th><?php __('Departamento Id'); ?></th>
		<th><?php __('Tipopersona Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tipopersona['Persona'] as $persona):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $persona['id'];?></td>
			<td><?php echo $persona['nombre'];?></td>
			<td><?php echo $persona['apellido'];?></td>
			<td><?php echo $persona['sexo'];?></td>
			<td><?php echo $persona['nn'];?></td>
			<td><?php echo $persona['provincia_id'];?></td>
			<td><?php echo $persona['localidade_id'];?></td>
			<td><?php echo $persona['departamento_id'];?></td>
			<td><?php echo $persona['tipopersona_id'];?></td>
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
