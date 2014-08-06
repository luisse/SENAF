<?php		echo $this->Html->script('fmensajes.js');
		 echo $this->element('botones_alta_mod',
	array('js_funcionalidad' => 'Tipousuario_abm.js',
			'label_modelo' =>'Tipousuario',
			'label_detalle'=>'Nuevo Tipousuario',
			'label_caja'=>'Detalles del Tipousuario',
			'controlador'=>'tipousuarios'))?><?php echo $this->Form->create('Tipousuario',array('action'=>'add'));?>
<table class="admintable" cellspacing="1" width='100%' border='0'>
				<tr>
					<td class="key"><label for="name"><?php echo __('descripcion',true)?></label></td>
					<td><?php echo $this->Form->input('descripcion',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
				<tr>
					<td class="key"><label for="name"><?php echo __('estado',true)?></label></td>
					<td><?php echo $this->Form->input('estado',array('label'=>false,'class'=>'inputboxl','size'=>'5'))?></td>
					<td></td>
					<td></td>		
				</tr>
</table>

<?php echo $this->Form->end();?>
<?php echo $this->element('fin_botones_alta_mod');?sh>
