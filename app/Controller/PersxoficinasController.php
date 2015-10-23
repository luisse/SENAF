<?php
App::uses('AppController', 'Controller');
/**
 * Persxoficinas Controller
 *
 * @property Persxoficina $Persxoficina
 * @property PaginatorComponent $Paginator
 */
class PersxoficinasController extends AppController {
	public $uses = array('Persxoficina','Oficina');

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
		$this->set('title_for_layout',__('Personas Asociadas a Oficina'));
	}

	public function listperxoficinas(){
		$this->layout='';
		$ls_filtro = '1=1';
		if(!empty($this->request->data)){
			if(!empty($this->request->data['Persxoficina']['oficina_id']) && $this->request->data['Persxoficina']['oficina_id']!=''){
				$ls_filtro = $ls_filtro.' AND Persxoficina.oficina_id ='.$this->request->data['Persxoficina']['oficina_id'];
			}
			if(!empty($this->request->data['Persxoficina']['nombre']) && $this->request->data['Persxoficina']['nombre']!=''){
				$ls_filtro = $ls_filtro." AND Upper(Persona.nombre)  like Upper('%".$this->request->data['Persxoficina']['nombre']."%')";
			}
			if(!empty($this->request->data['Persxoficina']['apellido']) && $this->request->data['Persxoficina']['apellido']!=''){
				$ls_filtro = $ls_filtro." AND Upper(Persona.apellido)  like Upper('%".$this->request->data['Persxoficina']['apellido']."%')";
			}
			
		}
		$this->Persxoficina->recursive = 0;
		$this->paginate=array('limit' => 10,
							'page' => 1,
							'conditions'=>$ls_filtro,
							'order'=>array('Oficina.descrip'=>'asc'),
											);				
		$this->set('persxoficinas', $this->Paginator->paginate());
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Persxoficina->exists($id)) {
			throw new NotFoundException(__('Invalid persxoficina'));
		}
		$options = array('conditions' => array('Persxoficina.' . $this->Persxoficina->primaryKey => $id));
		$this->set('persxoficina', $this->Persxoficina->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Agregar Personas a Oficina'));
		if ($this->request->is('post')) {
			$this->Persxoficina->create();
			$oficina_id = $this->request->data['Persxoficina']['oficina_id'];
			unset($this->request->data['Persxoficina']['oficina_id']);
			foreach($this->request->data as $persxoficinas){
				$i=0;
				foreach($persxoficinas as $personaoficina){
					$this->request->data['Persxoficina'][$i]['oficina_id'] = $oficina_id;
					$this->request->data['Persxoficina'][$i]['activo'] = true;
					$i++;		
				}
				
			}

			if ($this->Persxoficina->saveMany($this->request->data['Persxoficina'])) {
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
		$this->set('title_for_layout',__('Editar Personas en Oficina'));	
		if (!$this->Persxoficina->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido '));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Persxoficina->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Persxoficina.' . $this->Persxoficina->primaryKey => $id));
			$this->request->data = $this->Persxoficina->find('first', $options);
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
		$this->Persxoficina->id = $id;
		if (!$this->Persxoficina->exists()) {
			throw new NotFoundException(__('Invalid persxoficina'));
		}
		//$this->request->onlyAllow('post', 'delete');
		try {
			if ($this->Persxoficina->delete()) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}				
		return $this->redirect(array('action' => 'index'));
	}
	
	public function beforeRender(){

		if($this->params['action']=='edit' || $this->params['action']=='add'  || $this->params['action']=='index' ){
			$oficinas = $this->Persxoficina->Oficina->find('list',array('fields'=>array('Oficina.id','Oficina.descrip'),
																		'order'=>array('Oficina.descrip ASC')));
			if($this->params['action']=='index'){
				$oficinas[0]='Todas';
			}
																		
			$this->set(compact('oficinas'));
		}
				
		try{
			$result =	$this->Acl->check(array(
				'model' => 'Group',       # The name of the Model to check agains
				'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
				), ucfirst($this->params['controller']).'/'.$this->params['action']);
			//SI NO TIENE PERMISOS DA ERROR!!!!!!
	       	if(!$result)
	       		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
		}catch(Exeption $e){
		}		
	}
	
	public function agregarfila($row){
		$this->layout='';
		$this->set('row',$row);
	}

	public function beforeFilter() {
	    parent::beforeFilter();
	
	    // For CakePHP 2.0
	    //$this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	    ///$this->Auth->allow();
	}	
	
	
	
	public function existepersonagrupo($oficina_id = null,$persona_id = null){
		$this->layout='';
		$existe=0;
		if(!empty($oficina_id) && !empty($persona_id)){
			$existe = $this->Persxoficina->find('count',array('conditions'=>array('oficina_id'=>$oficina_id,'persona_id'=>$persona_id)));
		}
		$this->set('existe',$existe);
	}
}
