<?php
App::uses('AppController', 'Controller');
/**
 * Domicilios Controller
 *
 * @property Domicilio $Domicilio
 * @property PaginatorComponent $Paginator
 */
class DomiciliosController extends AppController {

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
		$this->Domicilio->recursive = 0;
		$this->set('domicilios', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Domicilio->exists($id)) {
			throw new NotFoundException(__('Invalid domicilio'));
		}
		$options = array('conditions' => array('Domicilio.' . $this->Domicilio->primaryKey => $id));
		$this->set('domicilio', $this->Domicilio->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Domicilio->create();
			if ($this->Domicilio->save($this->request->data)) {
				$this->Session->setFlash(__('The domicilio has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The domicilio could not be saved. Please, try again.'));
			}
		}
		$paises = $this->Domicilio->Paise->find('list');
		$provincias = $this->Domicilio->Provincium->find('list');
		$deptos = $this->Domicilio->Depto->find('list');
		$municipios = $this->Domicilio->Municipio->find('list');
		$localidades = $this->Domicilio->Localidade->find('list');
		$barrios = $this->Domicilio->Barrio->find('list');
		$calles = $this->Domicilio->Calle->find('list');
		$this->set(compact('paises', 'provincias', 'deptos', 'municipios', 'localidades', 'barrios', 'calles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Domicilio->exists($id)) {
			throw new NotFoundException(__('Invalid domicilio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Domicilio->save($this->request->data)) {
				$this->Session->setFlash(__('The domicilio has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The domicilio could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Domicilio.' . $this->Domicilio->primaryKey => $id));
			$this->request->data = $this->Domicilio->find('first', $options);
		}
		$paises = $this->Domicilio->Paise->find('list');
		$provincias = $this->Domicilio->Provincium->find('list');
		$deptos = $this->Domicilio->Depto->find('list');
		$municipios = $this->Domicilio->Municipio->find('list');
		$localidades = $this->Domicilio->Localidade->find('list');
		$barrios = $this->Domicilio->Barrio->find('list');
		$calles = $this->Domicilio->Calle->find('list');
		$this->set(compact('paises', 'provincias', 'deptos', 'municipios', 'localidades', 'barrios', 'calles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Domicilio->id = $id;
		if (!$this->Domicilio->exists()) {
			throw new NotFoundException(__('Invalid domicilio'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Domicilio->delete()) {
			$this->Session->setFlash(__('The domicilio has been deleted.'));
		} else {
			$this->Session->setFlash(__('The domicilio could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
