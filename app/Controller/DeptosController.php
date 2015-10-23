<?php 
App::uses('AppController', 'Controller');

class DeptosController extends AppController{
	var $name='Deptos';

	/*Funcion: permite retornar el xml con las provincias asociadas al país*/
	function retornalxmldeptos($provincia_id){
		$this->layout = '';
		$deptos = $this->Depto->retornardeptos($provincia_id);
		$this->set(compact('deptos'));
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