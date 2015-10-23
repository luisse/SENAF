<div class="contratoxbajas view">
<h2><?php  __('Contratoxbaja');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoxbaja['Contratoxbaja']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contrato Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoxbaja['Contratoxbaja']['contrato_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contratomobaja Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoxbaja['Contratoxbaja']['contratomobaja_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contratoxbaja', true), array('action' => 'edit', $contratoxbaja['Contratoxbaja']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Contratoxbaja', true), array('action' => 'delete', $contratoxbaja['Contratoxbaja']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contratoxbaja['Contratoxbaja']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contratoxbajas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contratoxbaja', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
