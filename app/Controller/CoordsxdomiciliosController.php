<?php
App::uses('AppController', 'Controller');
/**
 * Coordsxdomicilios Controller
 *
 * @property Coordsxdomicilio $Coordsxdomicilio
 * @property PaginatorComponent $Paginator
 */
class CoordsxdomiciliosController extends AppController {

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
		$this->Coordsxdomicilio->recursive = 0;
		$this->set('coordsxdomicilios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Coordsxdomicilio->exists($id)) {
			throw new NotFoundException(__('Invalid coordsxdomicilio'));
		}
		$options = array('conditions' => array('Coordsxdomicilio.' . $this->Coordsxdomicilio->primaryKey => $id));
		$this->set('coordsxdomicilio', $this->Coordsxdomicilio->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Coordsxdomicilio->create();
			if ($this->Coordsxdomicilio->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$coords = $this->Coordsxdomicilio->Coord->find('list');
		$domicilios = $this->Coordsxdomicilio->Domicilio->find('list');
		$this->set(compact('coords', 'domicilios'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Coordsxdomicilio->exists($id)) {
			throw new NotFoundException(__('Invalido coordsxdomicilio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Coordsxdomicilio->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Coordsxdomicilio.' . $this->Coordsxdomicilio->primaryKey => $id));
			$this->request->data = $this->Coordsxdomicilio->find('first', $options);
		}
		$coords = $this->Coordsxdomicilio->Coord->find('list');
		$domicilios = $this->Coordsxdomicilio->Domicilio->find('list');
		$this->set(compact('coords', 'domicilios'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Coordsxdomicilio->id = $id;
		if (!$this->Coordsxdomicilio->exists()) {
			throw new NotFoundException(__('Invalid coordsxdomicilio'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Coordsxdomicilio->delete()) {
			$this->Session->setFlash(__('El Registro fue eliminado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
