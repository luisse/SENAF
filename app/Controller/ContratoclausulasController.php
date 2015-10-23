<?php
App::uses('AppController', 'Controller');
/**
 * Contratoclausulas Controller
 *
 * @property Contratoclausula $Contratoclausula
 * @property PaginatorComponent $Paginator
 */
class ContratoclausulasController extends AppController {

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
		$this->Contratoclausula->recursive = 0;
		$this->set('contratoclausulas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contratoclausula->exists($id)) {
			throw new NotFoundException(__('Invalid contratoclausula'));
		}
		$options = array('conditions' => array('Contratoclausula.' . $this->Contratoclausula->primaryKey => $id));
		$this->set('contratoclausula', $this->Contratoclausula->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contratoclausula->create();
			if ($this->Contratoclausula->save($this->request->data)) {
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
		if (!$this->Contratoclausula->exists($id)) {
			throw new NotFoundException(__('Invalido contratoclausula'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contratoclausula->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Contratoclausula.' . $this->Contratoclausula->primaryKey => $id));
			$this->request->data = $this->Contratoclausula->find('first', $options);
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
		$this->Contratoclausula->id = $id;
		if (!$this->Contratoclausula->exists()) {
			throw new NotFoundException(__('Invalid contratoclausula'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contratoclausula->delete()) {
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
