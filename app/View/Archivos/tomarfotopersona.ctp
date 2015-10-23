<?php echo $this->Html->script(array('/js/archivos/tomarfotopersona.js','jquery.toastmessage','Photobooth'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'archivos','action'=>'listarchivos')) ?>"
</script>
<div class="panel panel-personas">
	<div class="panel-heading">
		<i class="fa fa-camera-retro fa-lg"></i>&nbsp;<?php echo __('Captura de Foto Personal')?>    </div>
	<br>
<div class="table-responsive">
<div class="panel-body">
<?php echo $this->Form->create('Archivo',array('action'=>'tomarfotopersona',
		'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
		'class' => 'well'
			));?>
<?php echo $this->Form->input('Archivo.archivo',array('type'=>'hidden'))?>
<?php echo $this->Form->input('Persona.id',array('type'=>'hidden'))?>

	<div class="panel panel-default">
	  <div class="panel-body">
	  	<div class="row">
	  		<div class="col-lg-2">
	  			<?php if(empty($archivoimagen)): ?>
	  			<?php
	  				echo $this->Html->image('user_not.jpeg',
								array ( 'title' =>__('Imagen de '.$persona['Persona']['apellido'].', '.$persona['Persona']['nombre']),'class'=>'img-rounded','width'=>'80px','height'=>'80px'));
	  			?>
	  			<?php endif;?>
	  			<?php if(!empty($archivoimagen)): ?>
						<a href="#" class="thumbnail">
								<img  src="<?php echo $archivoimagen['Archivo']['archivo'];//data:image/png;base64 ?> "/>
						</a>
	  			<?php endif;?>	  			
	  		</div>
	  		<div class="col-lg-10">
	  			<div class="row">
	  				<h3><?php echo __('Nombre y Apellido')?></h3>
	  			</div>
	  			<div class="row">
	  				<h4><?php echo $persona['Persona']['apellido'].', '.$persona['Persona']['nombre']?></h4>
	  			</div>
	  		</div>
	    </div>
	  </div>
	</div>
	<div class="row">
		<div class="col-lg-4">
  			<div class="row">
  				<h4><?php echo __('Cargar Imagen Desde Archivo')?></h4>
  			</div>
		</div>
		<div class="col-lg-3">
			<?php echo $this->Form->file('Archivo.image',array('label' => false))?>
		</div>
	</div>
	<div class="row">
		<br>
	</div>	
	<div class="row">	
		<div class="col-lg-3">
		<center>
			<button type="button" class="btn btn-info btn-lw" id='sacarfoto' title='Tomar Foto'>
			  <span class="glyphicon glyphicon-camera"></span>&nbsp;<?php echo __('Tomar Foto')?>
			</button>	
		</center>
		</div>
	</div>
	<div class="row">
		<br>
	</div>
	<div class="row">	
			<div class="col-lg-3">
					<?php echo $this->Form->input('Archivo.foto',array('type'=>'hidden'))?>
					<div id="example" style="background-color:orange;height:250px;width:250px;"></div>
			</div>
			<div class="col-lg-1">
			</div>
			<div class="col-lg-3">
					<div id="gallery" style="background-color:orange;height:250px;width:250px;"></div>
			</div>
	</div>
	<div class="row">
		<br>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6">
			<center>
			<button type="button" class="btn btn-success btn-lw" id='guardar'>
			  <span class="glyphicon glyphicon glyphicon-save"></span> <?php echo __('Guardar')?>
			</button>
			</center>
		</div>
		<div class="col-xs-6 col-sm-6">
			<center>
			<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
			  <span class="glyphicon glyphicon glyphicon-off"></span><?php echo __(' Cancelar')?>
			</button>
			</center>
		</div>
	</div>
</div>
</div>
<?php echo $this->Form->end();?>
