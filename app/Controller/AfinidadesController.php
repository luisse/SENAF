<?php
App::uses('AppController', 'Controller');
/**
 * Afinidades Controller
 *
 * @property Afinidade $Afinidade
 * @property PaginatorComponent $Paginator
 */
class AfinidadesController extends AppController {

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
		$this->Afinidade->recursive = 0;
		$this->set('afinidades', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Afinidade->exists($id)) {
			throw new NotFoundException(__('Identificar Invalido'));
		}
		$options = array('conditions' => array('Afinidade.' . $this->Afinidade->primaryKey => $id));
		$this->set('afinidade', $this->Afinidade->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Afinidade->create();
			if ($this->Afinidade->save($this->request->data)) {
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
		if (!$this->Afinidade->exists($id)) {
			throw new NotFoundException(__('Invalido afinidade'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Afinidade->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Afinidade.' . $this->Afinidade->primaryKey => $id));
			$this->request->data = $this->Afinidade->find('first', $options);
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
		$this->Afinidade->id = $id;
		if (!$this->Afinidade->exists()) {
			throw new NotFoundException(__('Invalid afinidade'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Afinidade->delete()) {
			$this->Session->setFlash(__('El Registro fue eliminado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
	    parent::beforeFilter();
			try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
					), ucfirst($this->params['controller']).'/'.$this->params['action']);
				//SI NO TIENE PERMISOS DA ERROR!!!!!!
	        	if(!$result)
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
			}catch(Exeption $e){
				
			}
	    	    
	    // For CakePHP 2.0
	   // $this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	   // $this->Auth->allow();
	}
	

}
