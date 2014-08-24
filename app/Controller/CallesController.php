<?php
App::uses('AppController', 'Controller');
/**
 * Calles Controller
 *
 * @property Calle $Calle
 * @property PaginatorComponent $Paginator
 */
class CallesController extends AppController {

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
		$this->Calle->recursive = 0;
		$this->set('calles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Calle->exists($id)) {
			throw new NotFoundException(__('Invalid calle'));
		}
		$options = array('conditions' => array('Calle.' . $this->Calle->primaryKey => $id));
		$this->set('calle', $this->Calle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Calle->create();
			if ($this->Calle->save($this->request->data)) {
				$this->Session->setFlash(__('The calle has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calle could not be saved. Please, try again.'));
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
		if (!$this->Calle->exists($id)) {
			throw new NotFoundException(__('Invalid calle'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Calle->save($this->request->data)) {
				$this->Session->setFlash(__('The calle has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calle could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Calle.' . $this->Calle->primaryKey => $id));
			$this->request->data = $this->Calle->find('first', $options);
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
		$this->Calle->id = $id;
		if (!$this->Calle->exists()) {
			throw new NotFoundException(__('Invalid calle'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Calle->delete()) {
			$this->Session->setFlash(__('The calle has been deleted.'));
		} else {
			$this->Session->setFlash(__('The calle could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
