<div class="personas view">
<h2><?php  __('Persona');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Apellido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['apellido']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sexo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['sexo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nn'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['nn']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Provincia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persona['Provincia']['id'], array('controller' => 'provincias', 'action' => 'view', $persona['Provincia']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Localidade'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persona['Localidade']['id'], array('controller' => 'localidades', 'action' => 'view', $persona['Localidade']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Departamento'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persona['Departamento']['id'], array('controller' => 'departamentos', 'action' => 'view', $persona['Departamento']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipopersona'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persona['Tipopersona']['id'], array('controller' => 'tipopersonas', 'action' => 'view', $persona['Tipopersona']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Persona', true), array('action' => 'edit', $persona['Persona']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Persona', true), array('action' => 'delete', $persona['Persona']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $persona['Persona']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Provincias', true), array('controller' => 'provincias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provincia', true), array('controller' => 'provincias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localidades', true), array('controller' => 'localidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Localidade', true), array('controller' => 'localidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departamentos', true), array('controller' => 'departamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Departamento', true), array('controller' => 'departamentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipopersonas', true), array('controller' => 'tipopersonas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipopersona', true), array('controller' => 'tipopersonas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupxpersonas', true), array('controller' => 'grupxpersonas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupxpersona', true), array('controller' => 'grupxpersonas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Perparentescos', true), array('controller' => 'perparentescos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Perparentesco', true), array('controller' => 'perparentescos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Userpersonas', true), array('controller' => 'userpersonas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userpersona', true), array('controller' => 'userpersonas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Grupxpersonas');?></h3>
	<?php if (!empty($persona['Grupxpersona'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th><?php __('Grupopersona Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($persona['Grupxpersona'] as $grupxpersona):
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
<div class="related">
	<h3><?php __('Related Perparentescos');?></h3>
	<?php if (!empty($persona['Perparentesco'])):?>
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
		foreach ($persona['Perparentesco'] as $perparentesco):
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
<div class="related">
	<h3><?php __('Related Userpersonas');?></h3>
	<?php if (!empty($persona['Userpersona'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($persona['Userpersona'] as $userpersona):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $userpersona['id'];?></td>
			<td><?php echo $userpersona['user_id'];?></td>
			<td><?php echo $userpersona['persona_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'userpersonas', 'action' => 'view', $userpersona['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'userpersonas', 'action' => 'edit', $userpersona['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'userpersonas', 'action' => 'delete', $userpersona['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userpersona['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Userpersona', true), array('controller' => 'userpersonas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
