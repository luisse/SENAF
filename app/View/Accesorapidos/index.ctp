<?php echo $this->Html->script(array('/js/accesorapidos/index.js','jquery.maskedinput'),array('block'=>'scriptjs'));?>
<?php

//determinamos si mostramos el ícono de shimano service center
$tallercito = $this->Session->read('tallercito');
?>
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
                	<?php echo '' ?> <sup style="font-size: 20px"><?php echo __('Encuentas')?></sup>
                 </h3>
                 <p>
                 	<?php echo __('Encuentas') ?>
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
<?php echo $this->element('modalbox')?>