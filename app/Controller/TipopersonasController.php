<?php
App::uses('AppController', 'Controller');
/**
 * Tipopersonas Controller
 *
 * @property Tipopersona $Tipopersona
 * @property PaginatorComponent $Paginator
 */
class TipopersonasController extends AppController {

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
		$this->set('title_for_layout','Tipo de Persona');
		$this->Tipopersona->recursive = 0;
		$this->set('tipopersonas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tipopersona->exists($id)) {
			throw new NotFoundException(__('Invalid tipopersona'));
		}
		$options = array('conditions' => array('Tipopersona.' . $this->Tipopersona->primaryKey => $id));
		$this->set('tipopersona', $this->Tipopersona->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Agregar Tipo de Personas');	
		if ($this->request->is('post')) {
			$this->Tipopersona->create();
			if ($this->Tipopersona->save($this->request->data)) {
				$this->Session->setFlash(__('El tipopersona a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El tipopersona no se pudo grabar. Por favor, intente de nuevo.'));
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
		$this->set('title_for_layout','Editar Tipo de Personas');		
		if (!$this->Tipopersona->exists($id)) {
			throw new NotFoundException(__('Invalid tipopersona'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tipopersona->save($this->request->data)) {
				$this->Session->setFlash(__('El tipopersona a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El tipopersona no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tipopersona.' . $this->Tipopersona->primaryKey => $id));
			$this->request->data = $this->Tipopersona->find('first', $options);
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
		$this->Tipopersona->id = $id;
		if (!$this->Tipopersona->exists()) {
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}
		try {
			if ($this->Tipopersona->delete()) {
				$this->Session->setFlash(__('El tipopersona a sido borrado.'));
			} else {
				$this->Session->setFlash(__('El tipopersona no se pudo borrar. Por favor, intente de nuevo.'));
			}
		}catch(Exception $e){
				$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}				
		return $this->redirect(array('action' => 'index'));
	}
	
	public function beforeFilter() {
	    parent::beforeFilter();
	
	    // For CakePHP 2.0
	    $this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	    $this->Auth->allow();
	}

	public function beforeRender(){
			/***SEGURIDAD CON ACL INACTIVA SI NO HAY TABLAS CARGADAS try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => 1 # The foreign key the Model is bind to
					), 'Users/'.$this->params['action']);
				//SI NO TIENE PERMISOS DA ERROR!!!!!!
	        	if(!$result)
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror','Users-'.$this->params['action']));
			}catch(Exeption $e){
				
			}***/	
	}
	
}
