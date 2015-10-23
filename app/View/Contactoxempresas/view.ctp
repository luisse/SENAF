<div class="contactoxempresas view">
<h2><?php  __('Contactoxempresa');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactoxempresa['Contactoxempresa']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contrato Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactoxempresa['Contactoxempresa']['contrato_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Empresa Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactoxempresa['Contactoxempresa']['empresa_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contactoxempresa', true), array('action' => 'edit', $contactoxempresa['Contactoxempresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Contactoxempresa', true), array('action' => 'delete', $contactoxempresa['Contactoxempresa']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contactoxempresa['Contactoxempresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contactoxempresas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contactoxempresa', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
