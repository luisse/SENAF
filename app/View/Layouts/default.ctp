<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<?php echo $this->Html->css('bootstrap.css'); ?>
	<?php echo $this->Html->css('../font-awesome/css/font-awesome.css'); ?>
	<?php echo $this->Html->css('plugins/morris/morris-0.4.3.min'); ?>
	<?php echo $this->Html->css('sb-admin.css'); ?>
	<?php echo $this->Html->css('ionicons.css'); ?>
	<?php echo $this->fetch('css'); ?>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
</head>
<body>
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo __('Sistema Gestion de Niñez, Adolescensia y Familia');?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i><?php echo __('Usuario') ?>&nbsp;<?php echo $this->Session->read('username');?></a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i>&nbsp;<?php echo __('Configuraciones') ?></a>
                        </li>
                        <li class="divider"></li>
                        <li><?php echo $this->Html->link('<i class="fa fa-sign-out fa-fw"></i>&nbsp;'.__('Salir'),array('controller'=>'users',
										'action'=>'logout',''),array('escape'=>false),'')?>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
        <!-- /.navbar-static-top -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <?php echo $this->Html->link('<i class="fa fa-home fa-fw"></i>&nbsp;'.__('Inicio'),array('controller'=>'accesorapidos',
						'action'=>'index',''),array('escape' => false)) ?>
                    </li>
					<?php echo $this->element('mostrar_menu',array('MODEL'=>$this->Session->read('LLAMADO_DESDE')))?>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                </div>
                <!-- /.col-lg-12 -->
            </div>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<?php echo $this->fetch('content'); ?>
					</div>
					<!-- /.col-lg-8 (nested) -->
				</div>
								<!-- /.row -->
         </div>
		<!-- /.panel-body -->
   </div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
	<?php echo $this->Html->script(array('jquery','bootstrap.min.js','plugins/metisMenu/jquery.metisMenu.js','plugins/morris/raphael-2.1.0.min.js','plugins/morris/morris.js','sb-admin.js','moment.js','moment-spanish'));?>
	<?php echo $this->fetch('scriptjs'); ?>
	<script src="//google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
</body>
</html>
