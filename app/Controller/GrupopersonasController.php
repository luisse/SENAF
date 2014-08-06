<?php
App::uses('AppController', 'Controller');
/**
 * Grupopersonas Controller
 *
 * @property Grupopersona $Grupopersona
 * @property PaginatorComponent $Paginator
 */
class GrupopersonasController extends AppController {

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
		$this->set('title_for_layout','Grupo de Personas');		
		$this->Grupopersona->recursive = 0;
		$this->set('grupopersonas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Grupopersona->exists($id)) {
			throw new NotFoundException(__('Invalid grupopersona'));
		}
		$options = array('conditions' => array('Grupopersona.' . $this->Grupopersona->primaryKey => $id));
		$this->set('grupopersona', $this->Grupopersona->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Agregar Grupo de Personas');			
		if ($this->request->is('post')) {
			$this->Grupopersona->create();
			if ($this->Grupopersona->save($this->request->data)) {
				$this->Session->setFlash(__('El grupopersona a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El grupopersona no se pudo grabar. Por favor, intente de nuevo.'));
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
		$this->set('title_for_layout','Actualizar Grupo de Personas');				
		if (!$this->Grupopersona->exists($id)) {
			throw new NotFoundException(__('Invalid grupopersona'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Grupopersona->save($this->request->data)) {
				$this->Session->setFlash(__('El grupopersona a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El grupopersona no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Grupopersona.' . $this->Grupopersona->primaryKey => $id));
			$this->request->data = $this->Grupopersona->find('first', $options);
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
		$this->Grupopersona->id = $id;
		if (!$this->Grupopersona->exists()) {
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Identificador invalido'));
			return $this->redirect(array('action' => 'index'));
		}
		try {
			if ($this->Grupopersona->delete()) {
				$this->Session->setFlash(__('El grupopersona a sido borrado.'));
			} else {
				$this->Session->setFlash(__('El grupopersona no se pudo borrar. Por favor, intente de nuevo.'));
			}
		}catch(Exception $e){
				$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}			
		return $this->redirect(array('action' => 'index'));
	}}
