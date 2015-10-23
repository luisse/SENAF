<style>
    #map-canvas {
      height: 100%;
      margin: 10px;
      padding: 200px;
      z-index:100;
    }
</style>
<?php if(!empty($personas)): ?>
<script>
	<?php if(!empty($personas)):?>
		var arraycoord=[<?php foreach($personas as $persona):?>
					<?php 
						$latitud = 0;
						$longitud= 0;
						if($persona['Coord']['latitud']!= 0 && $persona['Coord']['latitud'] != null) 
							$latitud = $persona['Coord']['latitud']; 
						if($persona['Coord']['longitud']!= 0 && $persona['Coord']['longitud'] != null) 
							$longitud = $persona['Coord']['longitud'];?>
						{clat:'<?php echo $latitud?>',clng:'<?php echo $longitud?>',desc:'<?php echo $persona['Coord']['descrip']?>',fecha:'<?php echo $this->Time->format('d/m/Y',$persona['Coord']['fecha'])?>'},
				<?php endforeach;?>];
	<?php endif; ?>
</script>
<!-- '<div id="content"><div id="siteNotice"></div><h3 id="firstHeading" class="firstHeading"><?php echo __('Información Personal') ?></h3><div id="bodyContent"><p><b><?php echo __('Apellido y Nombre:')?> </b><?php echo $persona['Persona']['apellido'].', '.$persona['Persona']['nombre']?><br>							<p><b><?php echo __('Descripción:')?></b><?php echo $persona['Coord']['descrip']?><br></div></div>', -->
<?php endif;?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"> </script>
<?php echo $this->Html->script(array('/js/personas/getlocalize.js','dateformat.js','fgenerales','bootstrap-datetimepicker'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css(array('bootstrap-datetimepicker','message'), null, array('inline' => false))?>
<?php echo $this->Form->create('Persona',array('action'=>'getlocalize',	
					'inputDefaults' => array(
						'div' => 'form-group',
						'wrapInput' => false,
						'class' => 'form-control'
						),
				'class' => 'well'
			));?>
<?php if(!empty($personas[0]['Persona']['id'])):?>
<?php echo $this->Form->hidden('Coord.persona_id',array('label'=>false,'type'=>'hidden','value'=>$personas[0]['Persona']['id']))?>
<?php endif;?>
	<?php if(!empty($personas[0]['Persona']['id'])):?>
	<legend><?php echo __('Localización de Persona: '.$personas[0]['Persona']['apellido'].', '.$personas[0]['Persona']['nombre'])?></legend>
	<?php endif;?>
	<div class="row">	
		<div class="col-lg-2">
			<?php echo $this->Form->input('Coord.latitude',array('label' => __('Latitud'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-2">
			<?php echo $this->Form->input('Coord.longitude',array('label' => __('Longitud'),
													'class'=>'form-control input-sm',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
		</div>
		<div class="col-lg-3">
				<label><?php echo __('Fecha de Captura')?></label>
				<div class="form-group">
					<div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
						<?php echo $this->Form->input('Coord.fecha',array('label'=>false,
															'placeholder' => __('Fecha de Captura'),
															'type'=>'text',
															'class'=>'form-control input-sm',
															'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
		</div>
		<div class='col-lg-4'>
			<?php echo $this->Form->input('Coord.descrip',array('label' => __('Detalle del Punto GPS'),
													'class'=>'form-control input-sm',
													'type'=>'text',
													'error'=>array('attributes' =>array('class'=>'alert alert-danger'))))?>
			
		</div>
		<div class='col-lg-2'>
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='dibujarArea'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Area')?>
		</button>	
		</center>
		
		</div>
	</div>	
	<div class="row">
		<div class="table-responsive">
			<div class='col-lg-12'>
				<div id="map-canvas"></div>
			</div>
		</div>
	</div>
<div class="row">	
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-success btn-lw" id='guardar'>
		  <span class="glyphicon glyphicon glyphicon-save"></span>&nbsp;<?php echo __('Guardar Punto GPS')?>
		</button>	
		</center>
	</div>
	<div class="col-xs-6 col-sm-6">
		<center>
		<button type="button" class="btn btn-danger btn-lw" id='cancelar'>
		  <span class="glyphicon glyphicon glyphicon-off"></span>&nbsp;<?php echo __('Cancelar')?>
		</button>	
		</center>
	</div>
</div>
<?php echo $this->Form->end();?>
<?php echo $this->element('modalbox')?>

