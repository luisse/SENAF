<?php
App::uses('AppModel', 'Model');
/**
 * Coord Model
 *
 * @property Coord $Provincia
 */
class Coord extends AppModel {

	/*
	* Funcion: permite guardar las coordenas y su relacion con personas
	*/
	public function guardarcoor($coord = null){
		if(!empty($coord)){
			$datasource = $this->getDataSource();
			ClassRegistry::init('Coordsxpersona');
			$Coordsxpersona = new Coordsxpersona();
			$this->create();
			if($this->save($coord)){
				$coordsxpersonas['Coordsxpersona']['coord_id'] = $this->id;
				$coordsxpersonas['Coordsxpersona']['persona_id'] = $coord['Coord']['persona_id'];
				$Coordsxpersona->create();
				if($Coordsxpersona->save($coordsxpersonas)){
					$datasource->commit($this);
					return true;					
				}else{
					$datasource->rollback($this);					
					return false;				
				}				
			}else{
				$datasource->rollback($this);					
				return false;				
			}

		}
	}


	/*
	* Funcion: permite guardar las coordenas y su relacion con personas
	*/	
	public function guardarcoordom($coord = null){
		if(!empty($coord)){
			$datasource = $this->getDataSource();
			ClassRegistry::init('Coordsxdomicilio');
			$Coordsxdomicilio = new Coordsxdomicilio();
			$this->create();
			print_r($coord);
			if($this->save($coord)){
				$coordsxdomicilios['Coordsxdomicilio']['coord_id'] = $this->id; //identificador almacenado actual!
				$coordsxdomicilios['Coordsxdomicilio']['domicilio_id'] = $coord['Coord']['domicilio_id'];
				$Coordsxdomicilio->create();
				if($Coordsxdomicilio->save($coordsxdomicilios)){
					$datasource->commit($this);
					return true;					
				}else{
					$datasource->rollback($this);					
					return false;				
				}				
			}else{
				$datasource->rollback($this);					
				return false;				
			}
		}		
	}
}
?>