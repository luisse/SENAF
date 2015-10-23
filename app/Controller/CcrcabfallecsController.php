<?php
App::uses('AppController', 'Controller');
/**
 * Ccrcabfallecs Controller
 *
 * @property Ccrcabfallec $Ccrcabfallec
 * @property PaginatorComponent $Paginator
 */
class CcrcabfallecsController extends AppController {

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
		$this->Ccrcabfallec->recursive = 0;
		$this->set('ccrcabfallecs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ccrcabfallec->exists($id)) {
			throw new NotFoundException(__('Invalid ccrcabfallec'));
		}
		$options = array('conditions' => array('Ccrcabfallec.' . $this->Ccrcabfallec->primaryKey => $id));
		$this->set('ccrcabfallec', $this->Ccrcabfallec->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ccrcabfallec->create();
			if ($this->Ccrcabfallec->save($this->request->data)) {
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
		if (!$this->Ccrcabfallec->exists($id)) {
			throw new NotFoundException(__('Invalido ccrcabfallec'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ccrcabfallec->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Ccrcabfallec.' . $this->Ccrcabfallec->primaryKey => $id));
			$this->request->data = $this->Ccrcabfallec->find('first', $options);
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
		$this->Ccrcabfallec->id = $id;
		if (!$this->Ccrcabfallec->exists()) {
			throw new NotFoundException(__('Invalid ccrcabfallec'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ccrcabfallec->delete()) {
			$this->Session->setFlash(__('El Registro fue eliminado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
