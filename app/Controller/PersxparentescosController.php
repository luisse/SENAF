<?php
App::uses('AppController', 'Controller');
/**
 * Persxparentescos Controller
 *
 * @property Persxparentesco $Persxparentesco
 * @property PaginatorComponent $Paginator
 */
class PersxparentescosController extends AppController {

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
		$this->Persxparentesco->recursive = 0;
		$this->set('persxparentescos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Persxparentesco->exists($id)) {
			throw new NotFoundException(__('Invalid persxparentesco'));
		}
		$options = array('conditions' => array('Persxparentesco.' . $this->Persxparentesco->primaryKey => $id));
		$this->set('persxparentesco', $this->Persxparentesco->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Persxparentesco->create();
			if ($this->Persxparentesco->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$personas = $this->Persxparentesco->Persona->find('list');
		$parentescos = $this->Persxparentesco->Parentesco->find('list');
		$persxoficinas = $this->Persxparentesco->Persxoficina->find('list');
		$this->set(compact('personas', 'parentescos', 'persxoficinas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Persxparentesco->exists($id)) {
			throw new NotFoundException(__('Invalido persxparentesco'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Persxparentesco->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Persxparentesco.' . $this->Persxparentesco->primaryKey => $id));
			$this->request->data = $this->Persxparentesco->find('first', $options);
		}
		$personas = $this->Persxparentesco->Persona->find('list');
		$parentescos = $this->Persxparentesco->Parentesco->find('list');
		$persxoficinas = $this->Persxparentesco->Persxoficina->find('list');
		$this->set(compact('personas', 'parentescos', 'persxoficinas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Persxparentesco->id = $id;
		if (!$this->Persxparentesco->exists()) {
			throw new NotFoundException(__('Invalid persxparentesco'));
		}
		//$this->request->onlyAllow('post', 'delete');
		try {
			if ($this->Persxparentesco->delete()) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}				
		return $this->redirect(array('action' => 'index'));
	}


}
