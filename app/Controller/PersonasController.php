<?php
App::uses('AppController', 'Controller');
/**
 * Personas Controller
 *
 * @property Persona $Persona
 * @property PaginatorComponent $Paginator
 */
class PersonasController extends AppController {

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
		$this->Persona->recursive = 0;
		$this->set('personas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		$options = array('conditions' => array('Persona.' . $this->Persona->primaryKey => $id));
		$this->set('persona', $this->Persona->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Persona->create();
			if ($this->Persona->save($this->request->data)) {
				$this->Session->setFlash(__('El persona a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El persona no se pudo grabar. Por favor, intente de nuevo.'));
			}
		}
		$provincias = $this->Persona->Provincium->find('list');
		$localidades = $this->Persona->Localidade->find('list');
		$departamentos = $this->Persona->Departamento->find('list');
		$tipopersonas = $this->Persona->Tipopersona->find('list');
		$this->set(compact('provincias', 'localidades', 'departamentos', 'tipopersonas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Persona->save($this->request->data)) {
				$this->Session->setFlash(__('El persona a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El persona no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Persona.' . $this->Persona->primaryKey => $id));
			$this->request->data = $this->Persona->find('first', $options);
		}
		$provincias = $this->Persona->Provincium->find('list');
		$localidades = $this->Persona->Localidade->find('list');
		$departamentos = $this->Persona->Departamento->find('list');
		$tipopersonas = $this->Persona->Tipopersona->find('list');
		$this->set(compact('provincias', 'localidades', 'departamentos', 'tipopersonas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Persona->id = $id;
		if (!$this->Persona->exists()) {
			throw new NotFoundException(__('Invalid persona'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Persona->delete()) {
			$this->Session->setFlash(__('El persona a sido borrado.'));
		} else {
			$this->Session->setFlash(__('El persona no se pudo borrar. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
