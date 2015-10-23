<div class="tipocontratos view">
<h2><?php  __('Tipocontrato');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipocontrato['Tipocontrato']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipocontrato['Tipocontrato']['descrip']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipocontrato', true), array('action' => 'edit', $tipocontrato['Tipocontrato']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tipocontrato', true), array('action' => 'delete', $tipocontrato['Tipocontrato']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipocontrato['Tipocontrato']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipocontratos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipocontrato', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
