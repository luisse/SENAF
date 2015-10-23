<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title_for_layout; ?></title>	
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
    <!-- Core CSS - Include with every page -->
	<?php echo $this->Html->css('bootstrap.css'); ?>
	<?php echo $this->Html->css('../font-awesome/css/font-awesome.css'); ?>
    <!-- Page-Level Plugin CSS - Dashboard -->
	<?php echo $this->Html->css('sb-admin.css'); ?>
	
</head>
<body>
	<?php echo $this->element('mensajealerta',array('title'=>__('Seguridad y Acceso'),'buttondesc'=>' Cerrar'))?>	
    <div class="container">
		<div class="page-header">
			<div class="row">
				<div class='col-md-2'>
					<?php //echo $this->Html->image('SENAYF100PX.png', array('alt' => 'SENAyF'));?>
				</div>
				<div class='col-md-8'>
					<h2>Secretaría de Estado de Niñez, Adolescencia y Familia</h2>
				</div>
				<div class='col-md-1'>
					<?php echo $this->Html->image('GobTucNoTuc.png', array('alt' => 'SENAyF'))
						//echo $this->Html->image('tucumangob.png', array('alt' => 'Gobierno de Tucumán'));?>
				</div>				
			</div>
		</div>
		<div class="row">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
    <footer class="footer">
      <div class="container">
			<div class="row">
				<div class='col-md-2'>
								<?php //echo $this->Html->image('Ministerio.png', array('alt' => 'SENAyF'));?>
				</div>
				<div class='col-md-8'>
					<center>
					<p class="text-muted">Sistema Informatico de Gestión - Secretaria de Estado de Niñez, Adolescencia y Familia.</p>
					</center>
				</div>
				<div class='col-md-1'>
					<?php //echo $this->Html->image('GobTucNoTuc.png', array('alt' => 'SENAyF'));?>
				</div>				
			</div>		
      </div>
    </footer>	
	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<?php echo $this->Html->script(array('jquery','bootstrap.min.js','jquery-ui.min','fmensajes','plugins/metisMenu/jquery.metisMenu.js','sb-admin.js'));?>
	<?php echo $this->Html->script('login_init');?>
	<?php echo $this->fetch('scriptjs'); ?>
	<script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
	

</body>
</html>
