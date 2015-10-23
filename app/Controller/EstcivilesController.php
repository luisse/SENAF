<?php
App::uses('AppController', 'Controller');
/**
 * Estciviles Controller
 *
 * @property Estcivile $Estcivile
 * @property PaginatorComponent $Paginator
 */
class EstcivilesController extends AppController {

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
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('descrip'=>'desc'));				
		$this->Estcivile->recursive = 0;
		$this->set('estciviles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Estcivile->exists($id)) {
			throw new NotFoundException(__('Invalid estcivile'));
		}
		$options = array('conditions' => array('Estcivile.' . $this->Estcivile->primaryKey => $id));
		$this->set('estcivile', $this->Estcivile->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Estcivile->create();
			if ($this->Estcivile->save($this->request->data)) {
				$this->Session->setFlash(__('El registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por favor, intente de nuevo.'));
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
		if (!$this->Estcivile->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Estcivile->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro se Actualizo Correctamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Actualizar el Registro. Por favor, intente de Nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Estcivile.' . $this->Estcivile->primaryKey => $id));
			$this->request->data = $this->Estcivile->find('first', $options);
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
		$this->Estcivile->id = $id;
		if (!$this->Estcivile->exists()) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		try {
			if ($this->Estcivile->delete()) {
				$this->Session->setFlash(__('El Registro fue Borrado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor, intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}
				
		return $this->redirect(array('action' => 'index'));
	}
	public function beforeFilter() {
	    parent::beforeFilter();
	
	    // For CakePHP 2.0
	   // $this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	   // $this->Auth->allow();
	}
	
	public function beforeRender(){
			try{
			$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
			), ucfirst($this->params['controller']).'/'.$this->params['action']);
			if(!$result)
				$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
		}catch(Exeption $e){
	
		}
	}
}
