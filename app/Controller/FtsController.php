<?php
App::uses('AppController', 'Controller');
/**
 * Bicicletareparamos Controller
 *
 * @property Bicicletareparamo $Bicicletareparamo
 * @property PaginatorComponent $Paginator
*/
class FtsController extends AppController {
	var $uses=array('Ft','Userbuttonget','Buttonuser');
	public $components = array('Paginator');
	
	public function getpers(){
		$this->layout='';
		$resultsearch = array();
		if(!empty($this->request->data)){
			if($this->request->data['Persona']['buscarpersona'] == 0){
				$ls_conditions_search = "vector @@ plainto_tsquery('".$this->request->data['Persona']['buscar']."')";
				//$ls_conditions_search = $ls_conditions_search." OR domicilio @@ plainto_tsquery ('".$this->request->data['Persona']['buscar']."')";
				
			}else{
				$this->request->data['Persona']['buscar'] = str_replace(' ','&',$this->request->data['Persona']['buscar']); 
				$ls_conditions_search = "vector @@ plainto_tsquery('".$this->request->data['Persona']['buscar']."')";
				//$ls_conditions_search = $ls_conditions_search." OR domicilio @@ to_tsquerys ('".$this->request->data['Persona']['buscar']."')";
			}
			$this->Ft->recursive = 0;
			$this->paginate=array('limit' => 5,
					'page' => 1,
					'conditions'=>$ls_conditions_search);
			$resultsearch = $this->Paginator->paginate();
				
		}

		/*Recuperamos los datos de botones asociados al usuario*/
		$buttonacces = $this->Userbuttonget->find('all',array('conditions'=>array('Userbuttonget.user_id'=>$this->Session->read('user_id'),
																				'Userbuttonget.active'=>1),
																'fields'=>array('Buttonuser.buttondescr','Buttonuser.modelname','Buttonuser.actionname')));
		/*Si no encontramos botones asignamos traemos todos los botones por defecto*/
		if(empty($buttonacces))
			$buttonacces = $this->Buttonuser->find('all',array('conditions'=>array('Buttonuser.group_id'=>$this->Session->read('tipousr'))));		
		$this->set(compact('resultsearch','buttonacces'));
	}
	public function beforeFilter() {
		parent::beforeFilter();
		// For CakePHP 2.0
		$this->Auth->allow('*');
	
		// For CakePHP 2.1 and up
		$this->Auth->allow();
	}
}