<div class="contratomobajas view">
<h2><?php  __('Contratomobaja');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratomobaja['Contratomobaja']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratomobaja['Contratomobaja']['descrip']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contratomobaja', true), array('action' => 'edit', $contratomobaja['Contratomobaja']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Contratomobaja', true), array('action' => 'delete', $contratomobaja['Contratomobaja']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contratomobaja['Contratomobaja']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contratomobajas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contratomobaja', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
