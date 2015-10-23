<div class="contratoclausulas view">
<h2><?php  __('Contratoclausula');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoclausula['Contratoclausula']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contrato Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoclausula['Contratoclausula']['contrato_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Activa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoclausula['Contratoclausula']['activa']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Orden'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoclausula['Contratoclausula']['orden']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Letra'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoclausula['Contratoclausula']['letra']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descrip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoclausula['Contratoclausula']['descrip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Monto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoclausula['Contratoclausula']['monto']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cantmax'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contratoclausula['Contratoclausula']['cantmax']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contratoclausula', true), array('action' => 'edit', $contratoclausula['Contratoclausula']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Contratoclausula', true), array('action' => 'delete', $contratoclausula['Contratoclausula']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contratoclausula['Contratoclausula']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contratoclausulas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contratoclausula', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
