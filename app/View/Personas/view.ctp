<div class="personas view">
<h2><?php  __('Persona');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Apellido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['apellido']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sexo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['sexo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fnac'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['fnac']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ffallec'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['ffallec']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estcivile'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persona['Estcivile']['id'], array('controller' => 'estciviles', 'action' => 'view', $persona['Estcivile']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nn'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['nn']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuariocrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['usuariocrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipcrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['ipcrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuarioactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['usuarioactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['ipactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persona['Persona']['modified']; ?>
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
		<li><?php echo $this->Html->link(__('List Estciviles', true), array('controller' => 'estciviles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Estcivile', true), array('controller' => 'estciviles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipdocxpers', true), array('controller' => 'tipdocxpers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipdocxper', true), array('controller' => 'tipdocxpers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Tipdocxpers');?></h3>
	<?php if (!empty($persona['Tipdocxper'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Tipodoc Id'); ?></th>
		<th><?php __('Persona Id'); ?></th>
		<th><?php __('Nrodoc'); ?></th>
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
		foreach ($persona['Tipdocxper'] as $tipdocxper):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $tipdocxper['id'];?></td>
			<td><?php echo $tipdocxper['tipodoc_id'];?></td>
			<td><?php echo $tipdocxper['persona_id'];?></td>
			<td><?php echo $tipdocxper['nrodoc'];?></td>
			<td><?php echo $tipdocxper['usuariocrea'];?></td>
			<td><?php echo $tipdocxper['ipcrea'];?></td>
			<td><?php echo $tipdocxper['created'];?></td>
			<td><?php echo $tipdocxper['usuarioactu'];?></td>
			<td><?php echo $tipdocxper['ipactu'];?></td>
			<td><?php echo $tipdocxper['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'tipdocxpers', 'action' => 'view', $tipdocxper['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'tipdocxpers', 'action' => 'edit', $tipdocxper['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'tipdocxpers', 'action' => 'delete', $tipdocxper['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipdocxper['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tipdocxper', true), array('controller' => 'tipdocxpers', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
