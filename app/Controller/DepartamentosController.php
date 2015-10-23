<?php
App::uses('AppController', 'Controller');
class DepartamentosController extends AppController{
	var $name = 'Departamentos';
	
	/*Funcion: permite retornar el xml con las provincias asociadas al país*/
	function retornalxmldepartamentos($localidade_id){
		$this->layout = '';
		$this->set('departamento',$this->Departamento->find('all',array('conditions'=>
					array('Departamento.provincia_id'=>$localidade_id),
					'order'=>array('nombre'=>'asc'))));
	}
}
?>