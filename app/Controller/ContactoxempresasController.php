<?php
App::uses('AppController', 'Controller');
/**
 * Contactoxempresas Controller
 *
 * @property Contactoxempresa $Contactoxempresa
 * @property PaginatorComponent $Paginator
 */
class ContactoxempresasController extends AppController {

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
		$this->Contactoxempresa->recursive = 0;
		$this->set('contactoxempresas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contactoxempresa->exists($id)) {
			throw new NotFoundException(__('Invalid contactoxempresa'));
		}
		$options = array('conditions' => array('Contactoxempresa.' . $this->Contactoxempresa->primaryKey => $id));
		$this->set('contactoxempresa', $this->Contactoxempresa->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contactoxempresa->create();
			if ($this->Contactoxempresa->save($this->request->data)) {
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
		if (!$this->Contactoxempresa->exists($id)) {
			throw new NotFoundException(__('Invalido contactoxempresa'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contactoxempresa->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Contactoxempresa.' . $this->Contactoxempresa->primaryKey => $id));
			$this->request->data = $this->Contactoxempresa->find('first', $options);
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
		$this->Contactoxempresa->id = $id;
		if (!$this->Contactoxempresa->exists()) {
			throw new NotFoundException(__('Invalid contactoxempresa'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contactoxempresa->delete()) {
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
