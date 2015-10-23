<?php
App::uses('AppController', 'Controller');
/**
 * Parentescos Controller
 *
 * @property Parentesco $Parentesco
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 */
class ParentescosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout',__('Parentescos'));
		$this->Parentesco->recursive = 0;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'fields'=>array('Parentesco.id','Parentesco.descrip','Parentesco.definicion','Parentescorecip.descrip'),
						'order'=>array('parentesco_id'=>'desc','id'=>'asc'),
						'joins'=>array(array('table'=>'parentescos',
												'alias'=>'Parentescorecip',
												'type'=>'LEFT',
												'conditions'=>array('Parentesco.id = Parentescorecip.parentesco_id')))
					);
		$parentescos = $this->Paginator->paginate();
		$this->set(compact('parentescos'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Parentesco->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$options = array('conditions' => array('Parentesco.' . $this->Parentesco->primaryKey => $id));
		$this->set('parentesco', $this->Parentesco->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Agregar Parentesco'));
		if ($this->request->is('post')) {
			$this->Parentesco->create();
			if ($this->Parentesco->save($this->request->data)) {
				$this->Session->setFlash(__('El Parentesco a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Parentesco no se pudo grabar. Por favor, intente de nuevo.'));
			}
		}
	}
/**
 * addsub method
 *
 * @return void
 */
	public function addsub($parentesco_id = null) {
		$this->set('title_for_layout',__('Agregar Sub Parentesco'));
		if(!empty($parentesco_id)) 
			$this->Session->write('parentesco_id',$parentesco_id);
		else
			$parentesco_id=$this->Session->read('parentesco_id');
			
		if ($this->request->is('post')) {
			$this->Parentesco->create();
			if(!empty($parentesco_id)) $this->request->data['Parentesco']['parentesco_id'] = $parentesco_id;	
			if ($this->Parentesco->save($this->request->data)) {
				$this->Session->setFlash(__('El Parentesco a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Parentesco no se pudo grabar. Por favor, intente de nuevo.'));
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
		$this->set('title_for_layout',__('Actualizar Parentesco'));
		if (!$this->Parentesco->exists($id)) {
			$this->Session->setFlash(__('No existe el identificador'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Parentesco->save($this->request->data)) {
				$this->Session->setFlash(__('El Parentesco a sido actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Parentesco no se pudo actualizar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Parentesco.' . $this->Parentesco->primaryKey => $id));
			$this->request->data = $this->Parentesco->find('first', $options);
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
		$this->Parentesco->id = $id;
		if (!$this->Parentesco->exists()) {
			throw new NotFoundException(__('Invalid parentesco'));
		}

		try {
			if ($this->Parentesco->delete()) {
				$this->Session->setFlash(__('El Parentesco a sido borrado.'));
			} else {
				$this->Session->setFlash(__('El Parentesco no se pudo borrar. Por favor, intente de nuevo.'));
			}
		}catch(Exception $e){
				$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}	
		return $this->redirect(array('action' => 'index'));
	}
	public function beforeFilter() {
	    parent::beforeFilter();

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
