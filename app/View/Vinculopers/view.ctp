<div class="vinculos view">
<h2><?php  __('Vinculo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $vinculo['Vinculo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Persxparentesco'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($vinculo['Persxparentesco']['id'], array('controller' => 'persxparentescos', 'action' => 'view', $vinculo['Persxparentesco']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Persona'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($vinculo['Persona']['id'], array('controller' => 'personas', 'action' => 'view', $vinculo['Persona']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vinculo', true), array('action' => 'edit', $vinculo['Vinculo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Vinculo', true), array('action' => 'delete', $vinculo['Vinculo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $vinculo['Vinculo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vinculos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vinculo', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Persxparentescos', true), array('controller' => 'persxparentescos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persxparentesco', true), array('controller' => 'persxparentescos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas', true), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona', true), array('controller' => 'personas', 'action' => 'add')); ?> </li>
	</ul>
</div>
