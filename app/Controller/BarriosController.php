<?php 
App::uses('AppController', 'Controller');

class BarriosController extends AppController{
	var $name='Localidades';

	/*Funcion: permite retornar el xml con las localidadesº asociadas al país*/
	function retornalxmlbarrios($localidade_id){
		$this->layout = '';
		$this->layout = '';
		$barrios = $this->Barrio->retornarbarrios($localidade_id);
		$this->set(compact('barrios'));
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