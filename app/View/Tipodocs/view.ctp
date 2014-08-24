<div class="tipodocs view">
<h2><?php  __('Tipodoc');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipodoc['Tipodoc']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipodoc['Tipodoc']['descrip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descred'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipodoc['Tipodoc']['descred']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipodoc', true), array('action' => 'edit', $tipodoc['Tipodoc']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tipodoc', true), array('action' => 'delete', $tipodoc['Tipodoc']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipodoc['Tipodoc']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipodocs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipodoc', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
