<?php
App::uses('AppController', 'Controller');
/**
 * Userbuttongets Controller
 *
 * @property Userbuttonget $Userbuttonget
 * @property PaginatorComponent $Paginator
 */
class UserbuttongetsController extends AppController {

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
		$this->set('title_for_layout',__('Botones de Usuario'));
		$this->Userbuttonget->recursive = 0;
		//opciones solo debe traer los botones del usuario actualmente conectado
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('username'=>'desc'),
							'fields'=>array('Userbuttonget.id','Buttonuser.buttondescr','User.username','Userbuttonget.active'),
							'conditions'=>array('Userbuttonget.user_id'=>$this->Session->read('user_id')));
		$this->set('userbuttongets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Userbuttonget->exists($id)) {
			throw new NotFoundException(__('Invalid userbuttonget'));
		}
		$options = array('conditions' => array('Userbuttonget.' . $this->Userbuttonget->primaryKey => $id));
		$this->set('userbuttonget', $this->Userbuttonget->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Activar Botones'));
		if ($this->request->is('post')) {
			$this->Userbuttonget->create();
			if ($this->Userbuttonget->saveAll($this->request->data['Userbuttonget'])) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$ls_notexists=' NOT EXISTS(SELECT 1 FROM userbuttongets WHERE userbuttongets.buttonuser_id=Buttonuser.id and userbuttongets.user_id ='.$this->Session->read('user_id').')';
		$buttonusers = $this->Userbuttonget->Buttonuser->find('all',array('conditions'=>array('Buttonuser.group_id'=>$this->Session->read('tipousr'),$ls_notexists)));
		$this->set(compact('buttonusers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout',__('Activar/Desativar Botones'));
		if (!$this->Userbuttonget->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Userbuttonget->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		}else{
			$options = array('conditions' => array('Userbuttonget.' . $this->Userbuttonget->primaryKey => $id));
			$this->request->data = $this->Userbuttonget->find('first', $options);
			
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
		$this->Userbuttonget->id = $id;
		if (!$this->Userbuttonget->exists()) {
			throw new NotFoundException(__('Invalid userbuttonget'));
		}
		//$this->request->onlyAllow('post', 'delete');
		try {
			if ($this->Userbuttonget->delete()) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}			
		return $this->redirect(array('action' => 'index'));
	}}
