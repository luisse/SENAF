<div class="archxpersonas view">
<h2><?php  __('Archxpersona');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archxpersona['Archxpersona']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Persona'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($archxpersona['Persona']['id'], array('controller' => 'personas', 'action' => 'view', $archxpersona['Persona']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Archivo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($archxpersona['Archivo']['id'], array('controller' => 'archivos', 'action' => 'view', $archxpersona['Archivo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Permiso'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($archxpersona['Permiso']['id'], array('controller' => 'permisos', 'action' => 'view', $archxpersona['Permiso']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Observ'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archxpersona['Archxpersona']['observ']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuariocrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archxpersona['Archxpersona']['usuariocrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipcrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archxpersona['Archxpersona']['ipcrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archxpersona['Archxpersona']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuarioactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archxpersona['Archxpersona']['usuarioactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archxpersona['Archxpersona']['ipactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $archxpersona['Archxpersona']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Archxpersona', true), array('action' => 'edit', $archxpersona['Archxpersona']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Archxpersona', true), array('action' => 'delete', $archxpersona['Archxpersona']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $archxpersona['Archxpersona']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Archxpersonas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archxpersona', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas', true), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona', true), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Archivos', true), array('controller' => 'archivos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Archivo', true), array('controller' => 'archivos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Permisos', true), array('controller' => 'permisos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Permiso', true), array('controller' => 'permisos', 'action' => 'add')); ?> </li>
	</ul>
</div>
