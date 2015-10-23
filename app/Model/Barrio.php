<?php
App::uses('AppModel', 'Model');
/**
 * Barrio Model
 *
 * @property Barrio $Provincia
 */
class Barrio extends AppModel {
	/*
	 * Funcion: permite retornar todas las provincias para su procesamiento
	 * */
	function retornarbarrios($localidade_id = null){
		$barrios = $this->find('all',
							array('fields'=>array('Barrio.id','Barrio.descrip'),
							'joins'=>array(array('table'=>'barrxlocalidades',
															'alias'=>'Barrxlocalidade',
															'type'=>'LEFT',
															'conditions'=>array('Barrxlocalidade.barrio_id = Barrio.id'))),
							'conditions'=>array('Barrxlocalidade.municipio_id'=>$localidade_id)));
		return $barrios;
	}
}
?>