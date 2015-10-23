<?php 
App::uses('AppController', 'Controller');

class ProvinciasController extends AppController{
	var $name='Provincias';

	/*Funcion: permite retornar el xml con las provincias asociadas al país*/
	function retornalxmlprovincias($paise_id){
		$this->layout = '';
		$provincias = $this->Provincia->retornarprovincias($paise_id);
		$this->set(compact('provincias'));
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