<div class="empresas view">
<h2><?php  __('Empresa');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $empresa['Empresa']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipoempresa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($empresa['Tipoempresa']['id'], array('controller' => 'tipoempresas', 'action' => 'view', $empresa['Tipoempresa']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Denominacion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $empresa['Empresa']['denominacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cuit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $empresa['Empresa']['cuit']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Empresa', true), array('action' => 'edit', $empresa['Empresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Empresa', true), array('action' => 'delete', $empresa['Empresa']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $empresa['Empresa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Empresas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipoempresas', true), array('controller' => 'tipoempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipoempresa', true), array('controller' => 'tipoempresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contactoxempresas', true), array('controller' => 'contactoxempresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contactoxempresa', true), array('controller' => 'contactoxempresas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Contactoxempresas');?></h3>
	<?php if (!empty($empresa['Contactoxempresa'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Contrato Id'); ?></th>
		<th><?php __('Empresa Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($empresa['Contactoxempresa'] as $contactoxempresa):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $contactoxempresa['id'];?></td>
			<td><?php echo $contactoxempresa['contrato_id'];?></td>
			<td><?php echo $contactoxempresa['empresa_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'contactoxempresas', 'action' => 'view', $contactoxempresa['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'contactoxempresas', 'action' => 'edit', $contactoxempresa['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'contactoxempresas', 'action' => 'delete', $contactoxempresa['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contactoxempresa['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contactoxempresa', true), array('controller' => 'contactoxempresas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
