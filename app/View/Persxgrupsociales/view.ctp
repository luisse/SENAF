<div class="persxgrupsociales view">
<h2><?php  __('Persxgrupsociale');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxgrupsociale['Persxgrupsociale']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Persona'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persxgrupsociale['Persona']['id'], array('controller' => 'personas', 'action' => 'view', $persxgrupsociale['Persona']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Grupsociale'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persxgrupsociale['Grupsociale']['id'], array('controller' => 'grupsociales', 'action' => 'view', $persxgrupsociale['Grupsociale']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Persxoficina'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($persxgrupsociale['Persxoficina']['id'], array('controller' => 'persxoficinas', 'action' => 'view', $persxgrupsociale['Persxoficina']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecharelev'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxgrupsociale['Persxgrupsociale']['fecharelev']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuariocrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxgrupsociale['Persxgrupsociale']['usuariocrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipcrea'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxgrupsociale['Persxgrupsociale']['ipcrea']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxgrupsociale['Persxgrupsociale']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuarioactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxgrupsociale['Persxgrupsociale']['usuarioactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ipactu'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxgrupsociale['Persxgrupsociale']['ipactu']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $persxgrupsociale['Persxgrupsociale']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Persxgrupsociale', true), array('action' => 'edit', $persxgrupsociale['Persxgrupsociale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Persxgrupsociale', true), array('action' => 'delete', $persxgrupsociale['Persxgrupsociale']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $persxgrupsociale['Persxgrupsociale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Persxgrupsociales', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persxgrupsociale', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Personas', true), array('controller' => 'personas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persona', true), array('controller' => 'personas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grupsociales', true), array('controller' => 'grupsociales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grupsociale', true), array('controller' => 'grupsociales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Persxoficinas', true), array('controller' => 'persxoficinas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Persxoficina', true), array('controller' => 'persxoficinas', 'action' => 'add')); ?> </li>
	</ul>
</div>
