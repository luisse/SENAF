            <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i><?php echo __('Usuarios')?><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            	<?php if( $this->Session->read('tipousr') != 2):?>
	                                <?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Ver'),array('controller'=>'users',
									'action'=>'index',''),array('escape' => false))?>
								<?php endif;?>
                            </li>
							<?php if( $this->Session->read('tipousr') != 2):?>							
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Agregar'),array('controller'=>'users',
								'action'=>'addcliente',''),array('escape' => false))?>
                            </li>
							
							<?php endif; ?>
                	</ul>
			</li>
			<li>
					<a href="#"><i class="fa fa-users fa-fw"></i><?php echo __('Personas')?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Tipo Persona'),array('controller'=>'tipopersonas',
								'action'=>'index',''),array('escape' => false))?>
							</li>
					</ul>
					<ul class="nav nav-second-level">
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Grupo Persona'),array('controller'=>'grupopersonas',
								'action'=>'index',''),array('escape' => false))?>
							</li>
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Parentescos'),array('controller'=>'parentescos',
								'action'=>'index',''),array('escape' => false))?>
							</li>							
					</ul>
					
					
            	<!-- /.nav-second-level -->
			</li>
