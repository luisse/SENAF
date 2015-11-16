<?php
App::uses('AppController', 'Controller');
/**
 * Calles Controller
 *
 * @property Calle $Calle
 * @property PaginatorComponent $Paginator
 */
class CallesController extends AppController {

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
		$this->set('title_for_layout','Listado de Calles');
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('descrip'=>'desc'));
		$this->Calle->recursive = 0;
		$this->set('calles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Calle->exists($id)) {
			throw new NotFoundException(__('Invalid calle'));
		}
		$options = array('conditions' => array('Calle.' . $this->Calle->primaryKey => $id));
		$this->set('calle', $this->Calle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Agregar Calle'));
		if ($this->request->is('post')) {
			$this->Calle->create();
			$this->request->data['Calle']['usuariocrea']=trim($this->Session->read('username'));
			$this->request->data['Calle']['ipcrea']=$this->request->clientIp();
			$this->request->data['Calle']['usuarioactu']=trim($this->Session->read('username'));
			$this->request->data['Calle']['ipactu']=$this->request->clientIp();

			if ($this->Calle->save($this->request->data)) {
				$this->Session->setFlash(__('El registro fue guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo grabar el registro. Por favor intente de nuevo.'));
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
		$this->set('title_for_layout',__('Modificar Calle'));
		if (!$this->Calle->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Calle->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar la calle. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Calle.' . $this->Calle->primaryKey => $id));
			$this->request->data = $this->Calle->find('first', $options);
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
		$this->Calle->id = $id;
		if (!$this->Calle->exists()) {
			throw new NotFoundException(__('Calle Invalida'));
		}
		try {
			if ($this->Calle->delete()) {
				$this->Session->setFlash(__('La Calle fue eliminada.'));
			} else {
				$this->Session->setFlash(__('The calle could not be deleted. Please, try again.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}

		return $this->redirect(array('action' => 'index'));
	}

	public function autocompletarcalle($filtro){
		$this->layout ='';
		$calles = $this->Calle->find('all',array('conditions'=>array("Upper(Calle.descrip) like Upper('%".$filtro."%')"),
																							'fields'=>array('Calle.id','Calle.descrip')
																							)
												);
		$this->set(compact('calles'));
	}

	public function beforeFilter() {
	    parent::beforeFilter();

	    // For CakePHP 2.0
	   // $this->Auth->allow('*');

	    // For CakePHP 2.1 and up
	   // $this->Auth->allow();
	}

	public function beforeRender(){
				try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
					), ucfirst($this->params['controller']).'/'.$this->params['action']);
				//SI NO TIENE PERMISOS DA ERROR!!!!!!
	        	if(!$result)
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror','Users-'.$this->params['action']));
			}catch(Exeption $e){

			}
	}
}
