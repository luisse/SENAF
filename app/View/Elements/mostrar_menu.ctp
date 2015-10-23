            <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i><?php echo __('Usuarios')?><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            	<?php //if( $this->Session->read('tipousr') != 2):?>
	                                <?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Ver'),array('controller'=>'users',
									'action'=>'index',''),array('escape' => false))?>
								<?php // endif;?>
                            </li>
							<?php if( $this->Session->read('tipousr') != 2 /*&&
										$this->Access->check('User.addusuario')*/):?>							
                            <li>
                                <?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Agregar'),array('controller'=>'users',
								'action'=>'addusuario',''),array('escape' => false))?>
                            </li>
							
							<?php endif; ?>
                	</ul>
			</li>
			<li>
					<a href="#"><i class="fa fa-cogs fa-fw"></i><?php echo __('Configuraciones')?><span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
							<?php if($acl->check(array(
								'model' => 'Group',       # The name of the Model to check agains
								'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
								), 'Parentescos/index')):?>
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Parentescos'),array('controller'=>'parentescos',
								'action'=>'index',''),array('escape' => false))?>
							</li>
							<?php endif;?>
							<?php if($acl->check(array(
								'model' => 'Group',       # The name of the Model to check agains
								'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
								), 'Tipodocs/index')):?>
								<li>	                                
									<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Tipo de Documento'),array('controller'=>'tipodocs',
									'action'=>'index',''),array('escape' => false))?>
								</li>
							<?php endif;?>
							<?php if($acl->check(array(
								'model' => 'Group',       # The name of the Model to check agains
								'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
								), 'Estciviles/index')):?>
														
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Estado Civil'),array('controller'=>'estciviles',
								'action'=>'index',''),array('escape' => false))?>
							</li>	
							<?php endif;?>
							<?php if($acl->check(array(
								'model' => 'Group',       # The name of the Model to check agains
								'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
								), 'Oficinas/index')):?>
							
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Oficinas'),array('controller'=>'oficinas',
								'action'=>'index',''),array('escape' => false))?>
							</li>	
							<?php endif;?>
							<?php if($acl->check(array(
								'model' => 'Group',       # The name of the Model to check agains
								'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
								), 'Afinidades/index')):?>
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Afinidades'),array('controller'=>'afinidades',
								'action'=>'index',''),array('escape' => false))?>
							</li>
							<?php endif;?>
							<?php /**if($acl->check(array(
								'model' => 'Group',       # The name of the Model to check agains
								'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
								), 'Tiparchivos/index')):**/?>
							
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Tipo de Archivos'),array('controller'=>'tiparchivos',
								'action'=>'index',''),array('escape' => false))?>
							</li>
							<?php //endif;?>
							<?php if($acl->check(array(
								'model' => 'Group',       # The name of the Model to check agains
								'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
								), 'Tiparchivos/index')):?>
																												
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Permisos'),array('controller'=>'permisos',
								'action'=>'index',''),array('escape' => false))?>
							</li>																					
							<?php endif;?>
							<?php if($acl->check(array(
								'model' => 'Group',       # The name of the Model to check agains
								'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
								), 'Userbuttongets/index')):?>
																												
							<li>	                                
								<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Botones Dinamicos'),array('controller'=>'userbuttongets',
								'action'=>'index',''),array('escape' => false))?>
							</li>																					
							<?php endif;?>						
													
					</ul>
					
					
            	<!-- /.nav-second-level -->
			</li>
			<li>
				<a href="#"><i class="fa fa-users fa-fw"></i><?php echo __('Personas')?><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>	                                
						<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Personas'),array('controller'=>'personas',
						'action'=>'index',''),array('escape' => false))?>
					</li>
				<li>
                	<?php echo $this->Html->link('<i class="fa fa-plus fa-fw"></i>&nbsp;'.__('Agregar'),array('controller'=>'personas',
					'action'=>'add',''),array('escape' => false))?>
                 </li>
				<li>
                	<?php echo $this->Html->link('<i class="fa fa-users fa-fw"></i>&nbsp;'.__('Personas Oficina'),array('controller'=>'persxoficinas',
					'action'=>'index',''),array('escape' => false))?>
                 </li>
                 																									<li>
                	<?php echo $this->Html->link('<i class="fa fa-search fa-fw"></i>&nbsp;'.__('Seguimiento de Persona'),array('controller'=>'personas',
					'action'=>'sissegpersona',''),array('escape' => false))?>
                 </li>	
                 <li>
                 <li>
                	<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Vinculos Persona'),array('controller'=>'vinculopers',
					'action'=>'index',''),array('escape' => false))?>
                 </li>
                 <li>
                	<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Entorno Social'),array('controller'=>'personas',
					'action'=>'personaexiste',''),array('escape' => false))?>
                 </li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-ambulance fa-fw"></i><?php echo __('Fallecidos')?><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
                 <li>
                	<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Fallecidos'),array('controller'=>'ccrfallecidos',
					'action'=>'index',''),array('escape' => false))?>
                 </li>
                 <li>
                	<?php echo $this->Html->link('<i class="fa fa-th-list fa-fw"></i>&nbsp;'.__('Cargar Sepelios'),array('controller'=>'ccrfallecidos',
					'action'=>'cargarsepelioscvs',''),array('escape' => false))?>
                 </li>
								
				</ul>
			</li>			