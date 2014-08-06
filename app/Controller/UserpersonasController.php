<?php
App::uses('AppController', 'Controller');
/**
 * Userpersonas Controller
 *
 * @property Userpersona $Userpersona
 * @property PaginatorComponent $Paginator
 */
class UserpersonasController extends AppController {

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
		$this->Userpersona->recursive = 0;
		$this->set('userpersonas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Userpersona->exists($id)) {
			throw new NotFoundException(__('Invalid userpersona'));
		}
		$options = array('conditions' => array('Userpersona.' . $this->Userpersona->primaryKey => $id));
		$this->set('userpersona', $this->Userpersona->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Userpersona->create();
			if ($this->Userpersona->save($this->request->data)) {
				$this->Session->setFlash(__('El userpersona a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El userpersona no se pudo grabar. Por favor, intente de nuevo.'));
			}
		}
		$users = $this->Userpersona->User->find('list');
		$personas = $this->Userpersona->Persona->find('list');
		$this->set(compact('users', 'personas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Userpersona->exists($id)) {
			throw new NotFoundException(__('Invalid userpersona'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userpersona->save($this->request->data)) {
				$this->Session->setFlash(__('El userpersona a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El userpersona no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Userpersona.' . $this->Userpersona->primaryKey => $id));
			$this->request->data = $this->Userpersona->find('first', $options);
		}
		$users = $this->Userpersona->User->find('list');
		$personas = $this->Userpersona->Persona->find('list');
		$this->set(compact('users', 'personas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Userpersona->id = $id;
		if (!$this->Userpersona->exists()) {
			throw new NotFoundException(__('Invalid userpersona'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Userpersona->delete()) {
			$this->Session->setFlash(__('El userpersona a sido borrado.'));
		} else {
			$this->Session->setFlash(__('El userpersona no se pudo borrar. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
