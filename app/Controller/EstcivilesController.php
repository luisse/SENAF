<?php
App::uses('AppController', 'Controller');
/**
 * Estciviles Controller
 *
 * @property Estcivile $Estcivile
 * @property PaginatorComponent $Paginator
 */
class EstcivilesController extends AppController {

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
		$this->Estcivile->recursive = 0;
		$this->set('estciviles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Estcivile->exists($id)) {
			throw new NotFoundException(__('Invalid estcivile'));
		}
		$options = array('conditions' => array('Estcivile.' . $this->Estcivile->primaryKey => $id));
		$this->set('estcivile', $this->Estcivile->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Estcivile->create();
			if ($this->Estcivile->save($this->request->data)) {
				$this->Session->setFlash(__('El registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por favor, intente de nuevo.'));
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
		if (!$this->Estcivile->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Estcivile->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro se Actualizo Correctamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Actualizar el Registro. Por favor, intente de Nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Estcivile.' . $this->Estcivile->primaryKey => $id));
			$this->request->data = $this->Estcivile->find('first', $options);
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
		$this->Estcivile->id = $id;
		if (!$this->Estcivile->exists()) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Estcivile->delete()) {
			$this->Session->setFlash(__('El Registro fue Borrado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
