<?php 
App::uses('AppController', 'Controller');

class LocalidadesController extends AppController{
	var $name='Localidades';

	/*Funcion: permite retornar el xml con las localidadesº asociadas al país*/
	function retornalxmllocalidades($municipio_id){
		$this->layout = '';
		$this->layout = '';
		$localidades = $this->Localidade->retornarlocalidades($municipio_id);
		$this->set(compact('localidades'));
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