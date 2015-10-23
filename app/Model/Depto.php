<?php
App::uses('AppModel', 'Model');
/**
 * Deptos Model
 *
 * @property Deptos $Provincia
 */
class Depto extends AppModel {
	/*
	 * Funcion: permite retornar todas las provincias para su procesamiento
	 * */
	function retornardeptos($provincia_id = null, $tipresult = null){
		if(empty($tipresult)) $tipresult='all';		
		$deptos = $this->find($tipresult,
							array('fields'=>array('Deptoxprovincia.id','Depto.descrip'),
							'joins'=>array(array('table'=>'deptoxprovincias',
															'alias'=>'Deptoxprovincia',
															'type'=>'LEFT',
															'conditions'=>array('Deptoxprovincia.depto_id = Depto.id'))),
							'conditions'=>array('Deptoxprovincia.provxpaise_id'=>$provincia_id)));
		return $deptos;
	}
}
?>