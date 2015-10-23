<?php echo $this->element('modalboxcabecera',array('title'=>'Datos Personales','paneltipo'=>'panel-primary'));?>
<?php if(!empty($persona)):?>
		<div class="row">
			  				<?php if(empty($archivo)): ?>
								<a href="#" class="thumbnail">
					  			<?php
					  				echo $this->Html->image('personanoexistente.jpg',
												array ('title' =>__('Sin Imagen para '.$persona['Persona']['apellido'].', '.$persona['Persona']['nombre']),
														'class'=>'img-rounded',
														'width'=>'160px','height'=>'160px'));
					  			?>
								</a>
				  			<?php endif;?>
				  			<?php if(!empty($archivo)): ?>
									<a href="#" class="thumbnail">
											<img width='160px' height='160px' src="<?php echo $archivo['Archivo']['archivo']; ?>"/>
									</a>
				  			<?php endif;?>			      	
							
		
		</div>
		<div class="row">
			<div class="col-lg-3">
				<label for="name"><?php echo __('Fecha de Nacimiento',true)?></label>				
				<div class="form-group">
					<div class="well  well-sm"><?php  echo $this->Time->format('d/m/Y',$persona['Persona']['fnac'])?></div>
				</div>						
			</div>
			<div class="col-lg-5">
				<label for="name"><?php echo __('Apellido y Nombre',true)?></label>				
				<div class="form-group">
					<div class="well  well-sm"><?php echo $persona['Persona']['apellido'].', '.$persona['Persona']['nombre']?></div>
				</div>						
			</div>
		</div>
		<div class="row"> 
			<div class="col-lg-3">
				<label for="name"><?php echo __('Sexo',true)?></label>
				<div class="form-group">
					<div class="well  well-sm"><?php if($persona['Persona']['sexo']=='M')
														echo 'Masculino';
													else
														echo 'Femenino';?></div>

				</div>						
			</div>	
			<div class="col-lg-5">
					<label for="name"><?php echo __('Documentos',true)?></label>				
					<div class="form-group">
						<table>
						<?php foreach($persona['Tipdocxper'] as $tipdocpers):?>
								<tr class="active">
								<td width='100px'>
									<p class="text-primary"><?php echo $tipodocs[$tipdocpers['tipodoc_id']];?></p>
								</td>
								<td>
									<p class="text-muted"><?php echo $tipdocpers['nrodoc']?></p>
								</td>
								</tr>
							<?php endforeach; ?>
						</table>
					</div>
			</div>			
		</div>
		<div class="row">
			<div class="col-lg-3">
				<label for="name"><?php echo __('Estado Civil',true)?></label>				
				<div class="form-group">
					<div class="well  well-sm"><?php echo $persona['Estcivile']['descrip']?></div>
				</div>						
			</div>
		<?php if(!empty($persona['Persona']['ffallec'])):?>	
		<div class="row">
			<div class="col-lg-5">
				<label for="name"><?php echo __('Fallece',true)?></label>
				<div class="form-group">
					<div class="well  well-sm"><?php echo  $this->Time->format('d/m/Y',$persona['Persona']['ffallec'])?></div>
				</div>						
			</div>		
		</div>
		<?php endif;?>	
<?php endif;?>
<?php echo $this->element('modalboxpie');?>