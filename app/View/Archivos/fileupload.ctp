<?php echo $this->Html->script(array('/js/archivos/fileupload.js','fileuploader.js','jquery.toastmessage'),array('block'=>'scriptjs')); ?>
<?php echo $this->Html->css(array('fileuploader','message'), null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<?php echo $this->Form->create('Archivo',array('action'=>'add','type'=>'file',	
	'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
				'class' => 'well'));?>
<fieldset>
	<legend>		<?php echo __('Alta de Archivo') ?></legend>
			<div class="row">
				<div class="col-lg-5">
					<div id="file-uploader-demo1">
					    <noscript>
					        <p>Habilita Java Script para subir los archivos.</p>
					    </noscript>
					</div>
				</div>
			</div>
	<div class="qq-upload-extra-drop-area">Eliminar las filas aqui</div>			
</fieldset>	

