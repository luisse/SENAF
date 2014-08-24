<?php
App::uses('AppController', 'Controller');
/**
 * Tipodocs Controller
 *
 * @property Tipodoc $Tipodoc
 * @property PaginatorComponent $Paginator
 * @property AclComponent $Acl
 */
class TipodocsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Acl');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','Listado de Tipo de Documentos');
		$this->Tipodoc->recursive = 0;
		$this->set('tipodocs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tipodoc->exists($id)) {
			throw new NotFoundException(__('Invalid tipodoc'));
		}
		$options = array('conditions' => array('Tipodoc.' . $this->Tipodoc->primaryKey => $id));
		$this->set('tipodoc', $this->Tipodoc->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Nuevo Tipo de Documento');		
		if ($this->request->is('post')) {
			$this->Tipodoc->create();
			if ($this->Tipodoc->save($this->request->data)) {
				$this->Session->setFlash(__('The tipodoc has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipodoc could not be saved. Please, try again.'));
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
		$this->set('title_for_layout','Actualizar Tipo de Documento');		
		if (!$this->Tipodoc->exists($id)) {
			throw new NotFoundException(__('Invalid tipodoc'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tipodoc->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tipodoc.' . $this->Tipodoc->primaryKey => $id));
			$this->request->data = $this->Tipodoc->find('first', $options);
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
		$this->Tipodoc->id = $id;
		if (!$this->Tipodoc->exists()) {
			throw new NotFoundException(__('Invalid tipodoc'));
		}

		if ($this->Tipodoc->delete()) {
			$this->Session->setFlash(__('El Tipo de Documento fue Borrado.'));
		} else {
			$this->Session->setFlash(__('El Tipo de Documento no puede ser Borrado. Por Favor intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}