<?php
App::uses('AppController', 'Controller');
/**
 * Grupsociales Controller
 *
 * @property Grupsociale $Grupsociale
 * @property PaginatorComponent $Paginator
 */
class GrupsocialesController extends AppController {

	public $uses = array('Grupsociale','Afinidade');
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
		$this->set('title_for_layout',__('Grupos Sociales'));
		$this->Grupsociale->recursive = 0;
		$this->set('grupsociales', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Grupsociale->exists($id)) {
			throw new NotFoundException(__('Invalid grupsociale'));
		}
		$options = array('conditions' => array('Grupsociale.' . $this->Grupsociale->primaryKey => $id));
		$this->set('grupsociale', $this->Grupsociale->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($persona_id = null) {
		$this->set('title_for_layout',__('Alta de Grupo Social'));
		if ($this->request->is('post')) {
			$this->Grupsociale->create();
			//$this->request->data['Persxgrupsociale']['persona_id']=$this->request->data['Grupsociale']['persona_id'];
			$this->request->data['Persxgrupsociale']['usuariocrea'] = $this->Session->read('username');
			$this->request->data['Persxgrupsociale']['ipcrea']=$this->request->clientIp();
			$groupsociale_id=$this->Grupsociale->savegroupsociale($this->request->data);
			if ($groupsociale_id > 0) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				$this->Session->write('grupsociale_id',$groupsociale_id);
				if(empty($persona_id))
					return $this->redirect(array('controller'=>'domicilios','action' => 'add'));
				else
					return $this->redirect(array('controller'=>'personas','action' => 'sissegpersona'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
			}
		}
		$this->set('persona_id',$persona_id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout',__('Actualizar Grupo Social'));
	
		if (!$this->Grupsociale->exists($id)) {
			throw new NotFoundException(__('Invalido grupsociale'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Grupsociale->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Grupsociale.' . $this->Grupsociale->primaryKey => $id));
			$this->request->data = $this->Grupsociale->find('first', $options);
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
		$this->Grupsociale->id = $id;
		if (!$this->Grupsociale->exists()) {
			throw new NotFoundException(__('Invalid grupsociale'));
		}
		try {
			if ($this->Grupsociale->delete()) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}				
		return $this->redirect(array('action' => 'index'));
	}
	public function beforerender(){
		if($this->params['action']=='edit' || $this->params['action']=='add'  || $this->params['action']=='index' ){
			$afinidades = $this->Grupsociale->Afinidade->find('list',array('fields'=>array('Afinidade.id','Afinidade.descrip'),
																	'order'=>array('Afinidade.descrip ASC')));
			if($this->params['action']=='index'){
				$afinidades[0]='Todas';
			}
																		
			$this->set(compact('afinidades'));
		}		

		try{
			$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
			), ucfirst($this->params['controller']).'/'.$this->params['action']);
			if(!$result)
				$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
		}catch(Exeption $e){
	
		}
		
	}

	public function beforeFilter() {
	    parent::beforeFilter();
	
	    // For CakePHP 2.0
	    $this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	    $this->Auth->allow();
	}
	
}
