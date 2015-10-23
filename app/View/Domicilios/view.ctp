<?php echo $this->element('modalboxcabecera',array('title'=>'Datos de Domicilio','paneltipo'=>'panel-primary'));?>
		<div id='domicilio'>
			<div class="row">
				<div class="col-lg-3">
					<label for="name"><?php echo __('País',true)?></label>
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Paise']['descrip']?></div>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="name"><?php echo __('Provincia',true)?></label>				
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Provincia']['descrip']?></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<label for="name"><?php echo __('Departamento',true)?></label>				
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Depto']['descrip']?></div>
					</div>
				</div>
				<div class="col-lg-5">
					<label for="name"><?php echo __('Localidad',true)?></label>								
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Localidade']['descrip']?></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<label for="name"><?php echo __('Municipio',true)?></label>				
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Municipio']['descrip']?></div>
					</div>
				</div>
				<div class="col-lg-3">
					<label for="name"><?php echo __('Barrio',true)?></label>
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Barrio']['descrip']?></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<label for="name"><?php echo __('Calle',true)?></label>				
				</div>
				<div class="col-lg-10">
					<div class="well  well-sm"><?php echo $domicilio['Calle']['descrip']?></div>
				</div>				
			</div>
			<div class="row">
				<div class="col-lg-3">
					<label for="name"><?php echo __('Detalle',true)?></label>				
				</div>
				<div class="col-lg-10">
					<div class="well  well-sm"><?php echo $domicilio['Domicilio']['descrip']?></div>
				</div>				
			</div>
			<div class="row">
				<div class="col-lg-1">
					<label for="name"><?php echo __('Manzana',true)?></label>				
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Domicilio']['mza']?></div>
					</div>
				</div>
				<div class="col-lg-1">
					<label for="name"><?php echo __('Block',true)?></label>				
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Domicilio']['block']?></div>
					</div>
				</div>
				<div class="col-lg-1">
					<label for="name"><?php echo __('Piso',true)?></label>
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Domicilio']['piso']?></div>
					</div>
				</div>
				<div class="col-lg-1">
					<label for="name"><?php echo __('Dpto',true)?></label>				
					<div class="form-group">
					<div class="well  well-sm"><?php echo $domicilio['Domicilio']['dpto']?></div>
					</div>
				</div>
				<div class="col-lg-1">
					<label for="name"><?php echo __('Lote',true)?></label>				
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Domicilio']['lote']?></div>
					</div>
				</div>
				<div class="col-lg-1">
					<label for="name"><?php echo __('Nro',true)?></label>				
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Domicilio']['nro']?></div>
					</div>
				</div>
				<div class="col-lg-1">
					<label for="name"><?php echo __('Sector',true)?></label>				
					<div class="form-group">
						<div class="well  well-sm"><?php echo $domicilio['Domicilio']['sector']?></div>
					</div>
				</div>
				
			</div>
		</div>
<?php echo $this->element('modalboxpie');?>