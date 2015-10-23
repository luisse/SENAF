<?php
App::uses('AppController', 'Controller');
/**
 * Contratomobajas Controller
 *
 * @property Contratomobaja $Contratomobaja
 * @property PaginatorComponent $Paginator
 */
class ContratomobajasController extends AppController {

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
		$this->Contratomobaja->recursive = 0;
		$this->set('contratomobajas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contratomobaja->exists($id)) {
			throw new NotFoundException(__('Invalid contratomobaja'));
		}
		$options = array('conditions' => array('Contratomobaja.' . $this->Contratomobaja->primaryKey => $id));
		$this->set('contratomobaja', $this->Contratomobaja->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contratomobaja->create();
			if ($this->Contratomobaja->save($this->request->data)) {
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
		if (!$this->Contratomobaja->exists($id)) {
			throw new NotFoundException(__('Invalido contratomobaja'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contratomobaja->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Contratomobaja.' . $this->Contratomobaja->primaryKey => $id));
			$this->request->data = $this->Contratomobaja->find('first', $options);
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
		$this->Contratomobaja->id = $id;
		if (!$this->Contratomobaja->exists()) {
			throw new NotFoundException(__('Invalid contratomobaja'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contratomobaja->delete()) {
			$this->Session->setFlash(__('El Registro fue eliminado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
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
	
}
