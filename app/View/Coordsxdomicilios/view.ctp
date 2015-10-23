<div class="coordsxdomicilios view">
<h2><?php  __('Coordsxdomicilio');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coordsxdomicilio['Coordsxdomicilio']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Coord'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($coordsxdomicilio['Coord']['id'], array('controller' => 'coords', 'action' => 'view', $coordsxdomicilio['Coord']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Domicilio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($coordsxdomicilio['Domicilio']['id'], array('controller' => 'domicilios', 'action' => 'view', $coordsxdomicilio['Domicilio']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Coordsxdomicilio', true), array('action' => 'edit', $coordsxdomicilio['Coordsxdomicilio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Coordsxdomicilio', true), array('action' => 'delete', $coordsxdomicilio['Coordsxdomicilio']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coordsxdomicilio['Coordsxdomicilio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Coordsxdomicilios', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coordsxdomicilio', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Coords', true), array('controller' => 'coords', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coord', true), array('controller' => 'coords', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Domicilios', true), array('controller' => 'domicilios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domicilio', true), array('controller' => 'domicilios', 'action' => 'add')); ?> </li>
	</ul>
</div>
