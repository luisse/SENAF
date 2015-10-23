<div class="tipoempresas view">
<h2><?php  __('Tipoempresa');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoempresa['Tipoempresa']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoempresa['Tipoempresa']['descrip']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipoempresa', true), array('action' => 'edit', $tipoempresa['Tipoempresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tipoempresa', true), array('action' => 'delete', $tipoempresa['Tipoempresa']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipoempresa['Tipoempresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipoempresas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipoempresa', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
