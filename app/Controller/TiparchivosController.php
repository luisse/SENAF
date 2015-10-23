<?php
App::uses('AppController', 'Controller');
/**
 * Tiparchivos Controller
 *
 * @property Tiparchivo $Tiparchivo
 * @property PaginatorComponent $Paginator
 */
class TiparchivosController extends AppController {

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
		$this->set('title_for_layout',__('Tipos de Archivos Aceptados por el Sistema'));
		$this->Tiparchivo->recursive = 0;
		$this->set('tiparchivos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tiparchivo->exists($id)) {
			throw new NotFoundException(__('Invalid tiparchivo'));
		}
		$options = array('conditions' => array('Tiparchivo.' . $this->Tiparchivo->primaryKey => $id));
		$this->set('tiparchivo', $this->Tiparchivo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Agregar Nuevo Tipo de Archivo'));
		if ($this->request->is('post')) {
			$this->Tiparchivo->create();
			if ($this->Tiparchivo->save($this->request->data)) {
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
		$this->set('title_for_layout',__('Actualizar Tipo de Archivo'));		
		if (!$this->Tiparchivo->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tiparchivo->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tiparchivo.' . $this->Tiparchivo->primaryKey => $id));
			$this->request->data = $this->Tiparchivo->find('first', $options);
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
		$this->Tiparchivo->id = $id;
		if (!$this->Tiparchivo->exists()) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		try {
			if ($this->Tiparchivo->delete()) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
	
		// For CakePHP 2.0
		//$this->Auth->allow('*');
	
		// For CakePHP 2.1 and up
		//$this->Auth->allow();
	}
	
	public function beforeRender(){
			try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
					), ucfirst($this->params['controller']).'/'.$this->params['action']);
				if(!$result)
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',$this->params['controller'].'-'.$this->params['action']));
			}catch(Exeption $e){
				
			}
	}
}
