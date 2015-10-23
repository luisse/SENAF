<div class="tiparchivos view">
<h2><?php  __('Tiparchivo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tiparchivo['Tiparchivo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Extension'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tiparchivo['Tiparchivo']['extension']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tiparchivo['Tiparchivo']['descrip']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tiparchivo', true), array('action' => 'edit', $tiparchivo['Tiparchivo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tiparchivo', true), array('action' => 'delete', $tiparchivo['Tiparchivo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tiparchivo['Tiparchivo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tiparchivos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tiparchivo', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
