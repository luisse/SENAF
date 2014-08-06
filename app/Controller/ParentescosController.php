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
		$this->paginate=array('limit' => 5,
						'page' => 1,
						'order'=>array('parent_id'=>'desc','id'=>'asc'),
						'conditions'=>array('Parentesco.parent_id IS NULL'));
		$parentescos = $this->Paginator->paginate();
		$i=0;
		$subparentescos=array();
		foreach($parentescos as $parentesco){
			$subparentesco = $this->Parentesco->find('all',array('conditions'=>array('Parentesco.parent_id'=>$parentesco['Parentesco']['id'])));
			if(!empty($subparentesco)){
				$subparentescos[$i]=$subparentesco;
				$i++;
			}
		}		
			
		$this->set(compact('parentescos','subparentescos'));
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
		$parentParentescos = $this->Parentesco->ParentParentesco->find('list');
		$this->set(compact('parentParentescos'));
	}
/**
 * addsub method
 *
 * @return void
 */
	public function addsub($parent_id = null) {
		$this->set('title_for_layout',__('Agregar Sub Parentesco'));
		if(!empty($parent_id)) 
			$this->Session->write('parent_id',$parent_id);
		else
			$parent_id=$this->Session->read('parent_id');
			
		if ($this->request->is('post')) {
			$this->Parentesco->create();
			if(!empty($parent_id)) $this->request->data['Parentesco']['parent_id'] = $parent_id;	
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
	}}
