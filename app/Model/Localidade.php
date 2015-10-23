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
	function retornarlocalidades($municipio_id = null, $tipresult = null){
		if(empty($tipresult)) $tipresult='all';
		$localidades = $this->find($tipresult,
							array('fields'=>array('Localidade.id','Localidade.descrip'),
							'joins'=>array(array('table'=>'localxmunicipios',
															'alias'=>'Localxmunicipio',
															'type'=>'LEFT',
															'conditions'=>array('Localxmunicipio.localidade_id = Localidade.id'))),
							'conditions'=>array('Localxmunicipio.munixdepto_id'=>$municipio_id)));
		return $localidades;
	}
}
?>