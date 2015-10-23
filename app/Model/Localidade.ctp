<?php
App::uses('AppModel', 'Model');
/**
 * Localidade Model
 *
 * @property Localidade $Provincia
 */
class Localidade extends AppModel {
	/*
	 * Funcion: permite retornar todas las provincias para su procesamiento
	 * */
	function retornarLocalidades($provincia_id = null){
		$localidades = $this->find('all',
							array('fields'=>array('Localidade.id','Localidade.descrip'),
							array(array('table'=>'provxpaises',
															'alias'=>'Provxpaise',
															'type'=>'LEFT',
															'conditions'=>array('Provxpaise.provincia_id'=>'Provincia.id','Provxpaise.paise_id'=>$paise_id)))));
		return $localidades;
	}
}
?>