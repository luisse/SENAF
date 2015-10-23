<?php
App::uses('AppController', 'Controller');
/**
 * Grupsocxdomis Controller
 *
 * @property Grupsocxdomi $Grupsocxdomi
 * @property PaginatorComponent $Paginator
 */
class GrupsocxdomisController extends AppController {

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
		$this->Grupsocxdomi->recursive = 0;
		$this->set('grupsocxdomis', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Grupsocxdomi->exists($id)) {
			throw new NotFoundException(__('Invalid grupsocxdomi'));
		}
		$options = array('conditions' => array('Grupsocxdomi.' . $this->Grupsocxdomi->primaryKey => $id));
		$this->set('grupsocxdomi', $this->Grupsocxdomi->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Grupsocxdomi->create();
			if ($this->Grupsocxdomi->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$grupsociales = $this->Grupsocxdomi->Grupsociale->find('list');
		$domicilios = $this->Grupsocxdomi->Domicilio->find('list');
		$this->set(compact('grupsociales', 'domicilios'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Grupsocxdomi->exists($id)) {
			throw new NotFoundException(__('Invalido grupsocxdomi'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Grupsocxdomi->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Grupsocxdomi.' . $this->Grupsocxdomi->primaryKey => $id));
			$this->request->data = $this->Grupsocxdomi->find('first', $options);
		}
		$grupsociales = $this->Grupsocxdomi->Grupsociale->find('list');
		$domicilios = $this->Grupsocxdomi->Domicilio->find('list');
		$this->set(compact('grupsociales', 'domicilios'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->layout='';
		$error='';

		
		$this->Grupsocxdomi->id = $id;
		if (!$this->Grupsocxdomi->exists()) {
			throw new NotFoundException(__('Invalid grupsocxdomi'));
		}
		try {
			if (!$this->Grupsocxdomi->delete()) {
				$error='No se pudo eliminar el domicilio del grupo social';
			}
		}catch(Exception $e){
			$error= __('Error: No se puede eliminar el registro. Atributo asignado a registro');
		}
				
		$this->set('error',$error);
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
	
		// For CakePHP 2.0
		$this->Auth->allow('*');
	
		// For CakePHP 2.1 and up
		$this->Auth->allow();
	}
	
}
