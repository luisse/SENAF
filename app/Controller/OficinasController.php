<?php
App::uses('AppController', 'Controller');
/**
 * Oficinas Controller
 *
 * @property Oficina $Oficina
 * @property PaginatorComponent $Paginator
 */
class OficinasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Oficinas de Ministerio'));
	}
	
	
	public function listoficinas(){
		$this->layout='';
		$ls_filtro = "1=1";
		if(!empty($this->request->data)){
			if(!empty($this->request->data['Oficina']['descrip'])){
				if($this->request->data['Oficina']['descrip'] != '')
					$ls_filtro = $ls_filtro." AND  Upper(Oficina.descrip)  like Upper('%".$this->request->data['Oficina']['descrip']."%')";
			}
		}
		$this->Oficina->recursive = 0;
		$this->paginate=array('limit' => 8,
				'page' => 1,
				'order'=>array('Oficina.descrip'=>'desc'),
				'conditions'=>$ls_filtro);
		$this->set('oficinas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Oficina->exists($id)) {
			throw new NotFoundException(__('Invalid oficina'));
		}
		$options = array('conditions' => array('Oficina.' . $this->Oficina->primaryKey => $id));
		$this->set('oficina', $this->Oficina->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Agregar Oficina de Ministerio'));		
		if ($this->request->is('post')) {
			$this->Oficina->create();
			if ($this->Oficina->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout',__('Actualizar Oficina de Ministerio'));		
		if (!$this->Oficina->exists($id)) {
			throw new NotFoundException(__('Invalido oficina'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Oficina->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Oficina.' . $this->Oficina->primaryKey => $id));
			$this->request->data = $this->Oficina->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Oficina->id = $id;
		if (!$this->Oficina->exists()) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		try {
			if ($this->Oficina->delete()) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}				
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
	    parent::beforeFilter();

		try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
					), 'Oficinas/'.$this->params['action']);
				//SI NO TIENE PERMISOS DA ERROR!!!!!!
				//echo 'Resultados: '.$result;
				if(!$result)
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',$this->params['controller'].'-'.$this->params['action']));
			}catch(Exeption $e){
				
			}
	    
	    
	    // For CakePHP 2.0
	    //$this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	    //$this->Auth->allow();
	}
	
	public function beforeRender(){
				try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
					), ucfirst($this->params['controller']).'/'.$this->params['action']);
				//SI NO TIENE PERMISOS DA ERROR!!!!!!
	        	if(!$result)
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror','Users-'.$this->params['action']));
			}catch(Exeption $e){
				
			}
	}	
	
}
