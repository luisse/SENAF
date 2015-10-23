<?php
App::uses('AppModel', 'Model');
/**
 * Provincia Model
 *
 * @property Provincia $Provincia
 */
class Provincia extends AppModel {
	/*
	 * Funcion: permite retornar todas las provincias para su procesamiento
	 * */
	function retornarprovincias($paise_id = null, $tipresult = null){
		if(empty($tipresult)) $tipresult='all';
		$provincias = $this->find($tipresult,
							array('fields'=>array('Provincia.id','Provincia.descrip'),
							'joins'=>array(array('table'=>'provxpaises',
															'alias'=>'Provxpaise',
															'type'=>'LEFT',
															'conditions'=>array('Provxpaise.provincia_id = Provincia.id'))),
							'conditions'=>array('Provxpaise.paise_id'=>$paise_id)));
		return $provincias;
	}
}
?>