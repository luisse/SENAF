<?php
App::uses('AppController', 'Controller');
/**
 * Tipocontratos Controller
 *
 * @property Tipocontrato $Tipocontrato
 * @property PaginatorComponent $Paginator
 */
class TipocontratosController extends AppController {

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
		$this->Tipocontrato->recursive = 0;
		$this->set('tipocontratos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tipocontrato->exists($id)) {
			throw new NotFoundException(__('Invalid tipocontrato'));
		}
		$options = array('conditions' => array('Tipocontrato.' . $this->Tipocontrato->primaryKey => $id));
		$this->set('tipocontrato', $this->Tipocontrato->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tipocontrato->create();
			if ($this->Tipocontrato->save($this->request->data)) {
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
		if (!$this->Tipocontrato->exists($id)) {
			throw new NotFoundException(__('Invalido tipocontrato'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tipocontrato->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tipocontrato.' . $this->Tipocontrato->primaryKey => $id));
			$this->request->data = $this->Tipocontrato->find('first', $options);
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
		$this->Tipocontrato->id = $id;
		if (!$this->Tipocontrato->exists()) {
			throw new NotFoundException(__('Invalid tipocontrato'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tipocontrato->delete()) {
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
