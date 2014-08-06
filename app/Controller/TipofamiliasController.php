<?php
App::uses('AppController', 'Controller');
/**
 * Tipofamilias Controller
 *
 * @property Tipofamilia $Tipofamilia
 * @property PaginatorComponent $Paginator
 */
class TipofamiliasController extends AppController {

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
		$this->set('title_for_layout','Tipo de Familias');
		$this->Tipofamilia->recursive = 0;
		$this->set('tipofamilias', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tipofamilia->exists($id)) {
			throw new NotFoundException(__('Invalid tipofamilia'));
		}
		$options = array('conditions' => array('Tipofamilia.' . $this->Tipofamilia->primaryKey => $id));
		$this->set('tipofamilia', $this->Tipofamilia->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Agregar - Tipo de Familias');		
		if ($this->request->is('post')) {
			$this->Tipofamilia->create();
			if ($this->Tipofamilia->save($this->request->data)) {
				$this->Session->setFlash(__('El tipofamilia a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El tipofamilia no se pudo grabar. Por favor, intente de nuevo.'));
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
		$this->set('title_for_layout','Actualizar - Tipo de Familias');		
		if (!$this->Tipofamilia->exists($id)) {
			throw new NotFoundException(__('Id Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tipofamilia->save($this->request->data)) {
				$this->Session->setFlash(__('El Tipo de Familia a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Tipo de Familia no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tipofamilia.' . $this->Tipofamilia->primaryKey => $id));
			$this->request->data = $this->Tipofamilia->find('first', $options);
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
		$this->Tipofamilia->id = $id;
		if (!$this->Tipofamilia->exists()) {
			throw new NotFoundException(__('Invalid tipofamilia'));
		}
		try {
			if ($this->Tipofamilia->delete()) {
				$this->Session->setFlash(__('El tipofamilia a sido borrado.'));
			} else {
				$this->Session->setFlash(__('El tipofamilia no se pudo borrar. Por favor, intente de nuevo.'));
			}
		}catch(Exception $e){
				$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}
			
		return $this->redirect(array('action' => 'index'));
	}}
