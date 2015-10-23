<div class="grupsocxdomis view">
<h2><?php  __('Grupsocxdomi');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grupsocxdomi['Grupsocxdomi']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Grupsociale'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($grupsocxdomi['Grupsociale']['id'], array('controller' => 'grupsociales', 'action' => 'view', $grupsocxdomi['Grupsociale']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Domicilio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($grupsocxdomi['Domicilio']['id'], array('controller' => 'domicilios', 'action' => 'view', $grupsocxdomi['Domicilio']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Grupsocxdomi', true), array('action' => 'edit', $grupsocxdomi['Grupsocxdomi']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Grupsocxdomi', true), array('action' => 'delete', $grupsocxdomi['Grupsocxdomi']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $grupsocxdomi['Grupsocxdomi']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupsocxdomis', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupsocxdomi', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupsociales', true), array('controller' => 'grupsociales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupsociale', true), array('controller' => 'grupsociales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Domicilios', true), array('controller' => 'domicilios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domicilio', true), array('controller' => 'domicilios', 'action' => 'add')); ?> </li>
	</ul>
</div>
