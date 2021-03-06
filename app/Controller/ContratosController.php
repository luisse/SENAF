<?php
App::uses('AppController', 'Controller');
/**
 * Contratos Controller
 *
 * @property Contrato $Contrato
 * @property PaginatorComponent $Paginator
 */
class ContratosController extends AppController {

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
		$this->Contrato->recursive = 0;
		$this->set('contratos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contrato->exists($id)) {
			throw new NotFoundException(__('Invalid contrato'));
		}
		$options = array('conditions' => array('Contrato.' . $this->Contrato->primaryKey => $id));
		$this->set('contrato', $this->Contrato->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contrato->create();
			if ($this->Contrato->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$tipocontraros = $this->Contrato->Tipocontraro->find('list');
		$this->set(compact('tipocontraros'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Contrato->exists($id)) {
			throw new NotFoundException(__('Invalido contrato'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contrato->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Contrato.' . $this->Contrato->primaryKey => $id));
			$this->request->data = $this->Contrato->find('first', $options);
		}
		$tipocontraros = $this->Contrato->Tipocontraro->find('list');
		$this->set(compact('tipocontraros'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Contrato->id = $id;
		if (!$this->Contrato->exists()) {
			throw new NotFoundException(__('Invalid contrato'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contrato->delete()) {
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
