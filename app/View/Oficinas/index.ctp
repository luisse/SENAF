<?php echo $this->Html->script(array('/js/oficinas/index.js','jquery.toastmessage'),array('block'=>'scriptjs'));?>
<?php echo $this->Html->css('message', null, array('inline' => false))?>
<?php echo $this->element('flash_message')?>
<script>
	var link="<?php echo $this->Html->url(array('controller'=>'oficinas','action'=>'listoficinas')) ?>"
</script>
<div class="panel panel-transacciones">
	<div class="panel-heading">
		<i class="fa fa-list fa-lg"></i>&nbsp;<?php echo __('Oficinas')?>    </div>
	<br>
	<div class="panel-body">
    	<div class="table-responsive">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tabs-1"><?php echo __('Filtro Oficina') ?></a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tabs-1">
					<!-- <form id="filteralumno" accept-charset="utf-8" method="post" action="#">  -->
					<?php echo $this->Form->create('Oficina',array('action'=>'#','id'=>'oficinas'));?>
				<fieldset>
					<div class="row">	
						<div class="col-lg-3">			
							<?php echo $this->Form->input('Oficina.descrip', array(
									'label' => __('Oficina '),
									'type'=>'text',
									'placeholder' => __('Oficina Descripcion'),
									'class'=>'form-control input-sm',
									'size'=>10
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
				</fieldset>
				<?php echo $this->Form->end()?>
			</div>
		</div>			
		<div id='listoficinas'></div>		
	</div>
</div>
<div id='message' style='hidden'>
	<?php $this->Session->flash() ?>
</div>
