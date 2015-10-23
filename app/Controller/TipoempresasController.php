<?php
App::uses('AppController', 'Controller');
/**
 * Tipoempresas Controller
 *
 * @property Tipoempresa $Tipoempresa
 * @property PaginatorComponent $Paginator
 */
class TipoempresasController extends AppController {

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
		$this->Tipoempresa->recursive = 0;
		$this->set('tipoempresas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tipoempresa->exists($id)) {
			throw new NotFoundException(__('Invalid tipoempresa'));
		}
		$options = array('conditions' => array('Tipoempresa.' . $this->Tipoempresa->primaryKey => $id));
		$this->set('tipoempresa', $this->Tipoempresa->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tipoempresa->create();
			if ($this->Tipoempresa->save($this->request->data)) {
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
		if (!$this->Tipoempresa->exists($id)) {
			throw new NotFoundException(__('Invalido tipoempresa'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tipoempresa->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tipoempresa.' . $this->Tipoempresa->primaryKey => $id));
			$this->request->data = $this->Tipoempresa->find('first', $options);
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
		$this->Tipoempresa->id = $id;
		if (!$this->Tipoempresa->exists()) {
			throw new NotFoundException(__('Invalid tipoempresa'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tipoempresa->delete()) {
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
