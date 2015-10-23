<?php
App::uses('AppController', 'Controller');
/**
 * Buttonusers Controller
 *
 * @property Buttonuser $Buttonuser
 * @property PaginatorComponent $Paginator
 */
class ButtonusersController extends AppController {

	var $uses = array('Buttonuser','Group');
/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Paginator');

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
		$this->set('title_for_layout','Administración de Botones');
		$this->Buttonuser->recursive = 0;
		$this->set('buttonusers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Buttonuser->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$options = array('conditions' => array('Buttonuser.' . $this->Buttonuser->primaryKey => $id));
		$this->set('buttonuser', $this->Buttonuser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Buttonuser->create();
			$this->request->data['Buttonuser']['group_id']=0;
			if ($this->Buttonuser->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
	}
	
	public function addbuttongrup(){
		$this->set('title_for_layout',__('Asociar Botones a Grupos'));
		if ($this->request->is('post')) {
			$this->Buttonuser->create();
			print_r($this->request->data);
			if ($this->Buttonuser->saveAll($this->request->data['Buttonuser'])) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$error = $this->Buttonuser->invalidFields();
				print_r($error);
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$buttons = $this->Buttonuser->find('all',array('conditions'=>array('group_id'=>'0')));
		$this->set(compact('buttons'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Buttonuser->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Buttonuser->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Buttonuser.' . $this->Buttonuser->primaryKey => $id));
			$this->request->data = $this->Buttonuser->find('first', $options);
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
		$this->Buttonuser->id = $id;
		if (!$this->Buttonuser->exists()) {
			throw new NotFoundException(__('No se encuentra el identificador'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Buttonuser->delete()) {
			$this->Session->setFlash(__('El Registro fue eliminado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function beforeRender(){
		if($this->action =='edit' ||
			$this->action =='add' ||
			$this->action =='addbuttongrup'){
			$groups = $this->Buttonuser->Group->find('list',array('fields'=>array('Group.id','Group.name')));
			$this->set(compact('groups'));
		}
	}
}
