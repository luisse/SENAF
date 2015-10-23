<?php 
App::uses('AppController', 'Controller');

class MunicipiosController extends AppController{
	var $name='Municipios';

	/*Funcion: permite retornar el xml con las provincias asociadas al país*/
	function retornalxmldeptos($depto_id){
		$this->layout = '';
		$municipios = $this->Municipio->retornarmunicipios($depto_id);
		$this->set(compact('municipios'));
	}
	public function beforeFilter() {
	    parent::beforeFilter();
	
	    // For CakePHP 2.0
	    $this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	    $this->Auth->allow();
	}

}
?>	