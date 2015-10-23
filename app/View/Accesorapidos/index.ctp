<?php echo $this->Html->script(array('/js/accesorapidos/index.js','jquery.maskedinput'),array('block'=>'scriptjs'));?>
<script>
var peopleseach="<?php echo $this->Html->url(array('controller'=>'fts','action'=>'getpers')) ?>"
</script>
<!--     BLOQUE DE BOTONES -->

<div class="row">
	<div class="col-lg-3 col-xs-6">
     	<!-- small box -->
        <div class="small-box bg-aqua">
        	<div class="inner">
            	<h3>
                	<?php echo '' ?> <sup style="font-size: 20px"><?php echo __('Informes')?></sup>
                 </h3>
                 <p>
                 	<?php echo __('En espera') ?>
                 </p>
              </div>
              <div class="icon">
              	<i class="ion ion-android-stopwatch"></i>
              </div>
              <a class="small-box-footer" href="#" id="espera">
              	Ver Detalles <i class="fa fa-arrow-circle-right"></i>
              </a>
        </div>
	</div>
	<div class="col-lg-3 col-xs-6">
     	<!-- small box -->
        <div class="small-box bg-green">
        	<div class="inner">
            	<h3>
                	<?php echo '' ?> <sup style="font-size: 20px"><?php echo __('Reportes')?></sup>
                 </h3>
                 <p>
                 	<?php echo __('Reportes') ?>
                 </p>
              </div>
              <div class="icon">
              	<i class="ion ion-looping"></i>
              </div>
              <a class="small-box-footer" href="#" id='entaller'>
              	Ver Detalles <i class="fa fa-arrow-circle-right"></i>
              </a>
        </div>
	</div>	
	<div class="col-lg-3 col-xs-6">
     	<!-- small box -->
        <div class="small-box bg-red">
        	<div class="inner">
            	<h3>
                	<?php echo '' ?> <sup style="font-size: 20px"><?php echo __('Encuesta')?></sup>
                 </h3>
                 <p>
                 	<?php echo __('Encuestas') ?>
                 </p>
              </div>

              <div class="icon">
              	<i class="ion ion-person"></i>
              </div>
              <a class="small-box-footer" href="#" id='confirmar'>
              	Ver Detalles <i class="fa fa-arrow-circle-right"></i>
              </a>
        </div>
	</div>
	<div class="col-lg-3 col-xs-6">
     	<!-- small box -->
        <div class="small-box bg-teal">
        	<div class="inner">
            	<h3>
                	<?php echo ''?> <sup style="font-size: 20px"><?php echo __('Mensajes')?></sup>
                 </h3>
                 <p>
                 	<?php echo __('De Controles') ?>
                 </p>
              </div>
              <div class="icon">
              	<i class="ion ion-android-mail"></i>
              </div>
              <a class="small-box-footer" href="#" id='mantenimiento'>
					Ver Detalles <i class="fa fa-arrow-circle-right"></i>
              </a>
        </div>
	</div>			
</div>
	
<div class="row">
	<div class='col-lg-9' id='viewinformation' style='display:none'>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div id='cespera' style='display:none'><i class="fa fa-stop fa-fw" id='bicicletaingreso'></i><label> <?php echo __('Informes') ?></label></div>
				<div id='centaller' style='display:none'><i class="fa fa-cog  fa-fw" id='bicicletaingreso'></i><label> <?php echo __('Encuestas') ?></label></div>
				<div id='cconfirma' style='display:none'><i class="fa fa-exclamation-triangle fa-fw" id='bicicletaingreso'></i><label><?php echo __('Confirmación') ?></label></div>
				<div id='mensajesmant' style='display:none'><i class="fa fa-envelope fa-fw"> </i><label> <?php echo __('Mensajes de Mantenimiento') ?></label></div>
			</div>
			<div id='informacion'></div>
		</div>
	</div>		
</div>
<!-- SEACH PEOPLE GLOBAL INTERFACE -->
<div class="center-block">
<div class="row">

		<?php echo $this->Form->create('#',array('action'=>'#',
			'inputDefaults' => array(
							'div' => 'form-group',
							'wrapInput' => false,
							'class' => 'form-control'
							),
				'id'=>'buscarpersona',
				'class' => 'well'
			));?>

			<fieldset>
				<div class="row">
					<div class="col-lg-6">
					    <div class="input-group">
									<?php echo $this->Form->input('Persona.buscar', array(
										'label' => false,
										'type'=>'text',
										'placeholder' => __('Ingrese Datos para Busqueda'),
										'class'=>'form-control'
									))?>
					         <span class="input-group-btn">
					        <button class="btn btn-default" type="button" id='buscar'><i class="glyphicon glyphicon-search"></i></button>
					      </span>
					    </div>
					 </div>
				 </div>
				 <div class ='row'>
				 	<div class="col-lg-6">
						<label class="checkbox-inline">
								<?php echo $this->Form->checkbox('Persona.buscarpersona',array('div'=>false,'checked'))?>						
						  <?php echo __('Solo Resultado Exactos')?>
						</label>
					</div>
				 </div>
				 <div class='row' >
				 <br>
				 	<center>
				 	<div id='cargandodatos' style='display:none'>
				 		<?php echo $this->Html->image('carga.gif')?>
				 	</div>
				 	</center>
				 </div>
				 <div class='row'>
				 	<div id='resultsearch'></div>
				 </div>
			</fieldset>	
						 
			<?php echo $this->Form->end()?>
		
</div>
</div>
<?php echo $this->element('modalbox')?>