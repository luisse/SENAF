<?php
App::uses('AppController', 'Controller');
/**
 * Permisos Controller
 *
 * @property Permiso $Permiso
 * @property PaginatorComponent $Paginator
 */
class PermisosController extends AppController {

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
		$this->set('title_for_layout',__('Agregar Permisos para Archivos'));		
		$this->Permiso->recursive = 0;
		$this->set('permisos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Permiso->exists($id)) {
			throw new NotFoundException(__('Invalid permiso'));
		}
		$options = array('conditions' => array('Permiso.' . $this->Permiso->primaryKey => $id));
		$this->set('permiso', $this->Permiso->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Agregar Permisos'));		
		if ($this->request->is('post')) {
			$this->Permiso->create();
			if ($this->Permiso->save($this->request->data)) {
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
		$this->set('title_for_layout',__('Actualizar Permisos'));		
		if (!$this->Permiso->exists($id)) {
			throw new NotFoundException(__('Invalido permiso'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Permiso->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Permiso.' . $this->Permiso->primaryKey => $id));
			$this->request->data = $this->Permiso->find('first', $options);
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
		$this->Permiso->id = $id;
		if (!$this->Permiso->exists()) {
			throw new NotFoundException(__('Invalid permiso'));
		}
		try {
			if ($this->Permiso->delete()) {
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
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
			}catch(Exeption $e){
				
			}
	}	
}
