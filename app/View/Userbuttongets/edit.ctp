		<?php echo $this->Html->script(array('/js/userbuttongets/edit.js','fmensajes.js','fgenerales.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
		<?php echo $this->Html->css('message', null, array('inline' => false))?>
		<?php echo $this->element('flash_message')?>
		<?php echo $this->Form->create('Userbuttonget',array('action'=>'edit',	
				'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'class' => 'well'));?>
<fieldset>
	<?php echo $this->Form->hidden('Userbuttonget.id')?>
	<legend>		<?php echo __('Actualizar Datos') ?></legend>
		
			<div class="row">
				<div class="col-lg-10">
					<div class="btn-group">
						<a class='btn btn-app'>
							<?php echo $this->request->data['Buttonuser']['buttondescr']; ?>&nbsp;
						</a>
					</div>				
				</div>
			</div>
			<div class="row">
				 	<div class="col-lg-6">
						<label class="checkbox-inline">
								<?php echo $this->Form->checkbox('Userbuttonget.active',array('div'=>false))?>						
						  <?php echo __('Botón Activo')?>
						</label>
					</div>
			</div>
		</fieldset>
<div class="row">	
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar') ?>
		</button>	
		</center>
	</div>
	<div class="col-lg-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __(' Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
