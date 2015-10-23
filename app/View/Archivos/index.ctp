<?php echo $this->Html->script(array('/js/archivos/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'archivos','action'=>'listarchivos')) ?>"
</script>

<div class="panel panel-personas">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Archivos Vinculados a la Persona')?>    </div>
	<br>
	<div class="panel-body">
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
								<img  src="<?php echo $archivoimagen['Archivo']['archivo']; //data:image/png;base64?>"/>
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
	  			<?php //print_r($persona)?>
	  		</div>
	    </div>
	  </div>
	</div>
	<!--  -->
    <div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtro') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<?php echo $this->Form->create('Archivo',array('action'=>'#','id'=>'archivofilter'));?>
					<div class="row">	
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Archivo.tiparchivo_id', array(
									'label' => __('Tipo de Archivo'),
									'class'=>'form-control input-sm',
									'value'=>'0'
									
							))?>
						</div>
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Archivo.descrip', array(
									'label' => __('Descripción'),
									'class'=>'form-control input-sm',
							))?>
						</div>
						<div  class="col-lg-2">
							<br>
							<button type="button" class="btn btn-info btn-lw" id='buscar'>
									<span class="glyphicon glyphicon-search"></span> <?php echo __('Buscar');?>
							</button>
						</div>    
				    </div>
				</div>
				<?php echo $this->Form->end()?>
			</div>
	</div>
	<div id='listarchivos'></div>		
	<!--  -->
</div>
