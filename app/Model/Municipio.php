<?php
App::uses('AppModel', 'Model');
/**
 * Municipio Model
 *
 * @property Municipio $Provincia
 */
class Municipio extends AppModel {
	/*
	 * Funcion: permite retornar todas las provincias para su procesamiento
	 * */
	function retornarmunicipios($depto_id = null,$tipresult=null){
		if(empty($tipresult)) $tipresult='all';		
		$municipios = $this->find($tipresult,
							array('fields'=>array('Munixdeptos.id','Municipio.descrip'),
							'joins'=>array(array('table'=>'munixdeptos',
															'alias'=>'Munixdeptos',
															'type'=>'LEFT',
															'conditions'=>array('Munixdeptos.municipio_id = Municipio.id'))),
							'conditions'=>array('Munixdeptos.deptoxprovincia_id'=>$depto_id)));
		return $municipios;
	}
}
?>