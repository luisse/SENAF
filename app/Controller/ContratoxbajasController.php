<?php
App::uses('AppController', 'Controller');
/**
 * Contratoxbajas Controller
 *
 * @property Contratoxbaja $Contratoxbaja
 * @property PaginatorComponent $Paginator
 */
class ContratoxbajasController extends AppController {

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
		$this->Contratoxbaja->recursive = 0;
		$this->set('contratoxbajas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contratoxbaja->exists($id)) {
			throw new NotFoundException(__('Invalid contratoxbaja'));
		}
		$options = array('conditions' => array('Contratoxbaja.' . $this->Contratoxbaja->primaryKey => $id));
		$this->set('contratoxbaja', $this->Contratoxbaja->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contratoxbaja->create();
			if ($this->Contratoxbaja->save($this->request->data)) {
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
		if (!$this->Contratoxbaja->exists($id)) {
			throw new NotFoundException(__('Invalido contratoxbaja'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contratoxbaja->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Contratoxbaja.' . $this->Contratoxbaja->primaryKey => $id));
			$this->request->data = $this->Contratoxbaja->find('first', $options);
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
		$this->Contratoxbaja->id = $id;
		if (!$this->Contratoxbaja->exists()) {
			throw new NotFoundException(__('Invalid contratoxbaja'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contratoxbaja->delete()) {
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
