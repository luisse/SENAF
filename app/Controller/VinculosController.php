<?php
App::uses('AppController', 'Controller');
/**
 * Vinculos Controller
 *
 * @property Vinculo $Vinculo
 * @property PaginatorComponent $Paginator
 */
class VinculosController extends AppController {

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
		$this->Vinculo->recursive = 0;
		$this->set('vinculos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Vinculo->exists($id)) {
			throw new NotFoundException(__('Invalid vinculo'));
		}
		$options = array('conditions' => array('Vinculo.' . $this->Vinculo->primaryKey => $id));
		$this->set('vinculo', $this->Vinculo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Vinculo->create();
			if ($this->Vinculo->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$persxparentescos = $this->Vinculo->Persxparentesco->find('list');
		$personas = $this->Vinculo->Persona->find('list');
		$this->set(compact('persxparentescos', 'personas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Vinculo->exists($id)) {
			throw new NotFoundException(__('Invalido vinculo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Vinculo->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Vinculo.' . $this->Vinculo->primaryKey => $id));
			$this->request->data = $this->Vinculo->find('first', $options);
		}
		$persxparentescos = $this->Vinculo->Persxparentesco->find('list');
		$personas = $this->Vinculo->Persona->find('list');
		$this->set(compact('persxparentescos', 'personas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Vinculo->id = $id;
		if (!$this->Vinculo->exists()) {
			throw new NotFoundException(__('Invalid vinculo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Vinculo->delete()) {
			$this->Session->setFlash(__('El Registro fue eliminado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
