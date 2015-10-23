<?php
App::uses('AppController', 'Controller');
/**
 * Archxpersonas Controller
 *
 * @property Archxpersona $Archxpersona
 * @property PaginatorComponent $Paginator
 */
class ArchxpersonasController extends AppController {

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
		$this->Archxpersona->recursive = 0;
		$this->set('archxpersonas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Archxpersona->exists($id)) {
			throw new NotFoundException(__('Invalid archxpersona'));
		}
		$options = array('conditions' => array('Archxpersona.' . $this->Archxpersona->primaryKey => $id));
		$this->set('archxpersona', $this->Archxpersona->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Archxpersona->create();
			if ($this->Archxpersona->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$personas = $this->Archxpersona->Persona->find('list');
		$archivos = $this->Archxpersona->Archivo->find('list');
		$permisos = $this->Archxpersona->Permiso->find('list');
		$this->set(compact('personas', 'archivos', 'permisos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Archxpersona->exists($id)) {
			throw new NotFoundException(__('Invalido archxpersona'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Archxpersona->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Archxpersona.' . $this->Archxpersona->primaryKey => $id));
			$this->request->data = $this->Archxpersona->find('first', $options);
		}
		$personas = $this->Archxpersona->Persona->find('list');
		$archivos = $this->Archxpersona->Archivo->find('list');
		$permisos = $this->Archxpersona->Permiso->find('list');
		$this->set(compact('personas', 'archivos', 'permisos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Archxpersona->id = $id;
		if (!$this->Archxpersona->exists()) {
			throw new NotFoundException(__('Invalid archxpersona'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Archxpersona->delete()) {
			$this->Session->setFlash(__('El Registro fue eliminado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
