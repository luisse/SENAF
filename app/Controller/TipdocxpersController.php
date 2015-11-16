<?php
App::uses('AppController', 'Controller');
/**
 * Tipdocxpers Controller
 *
 * @property Tipdocxper $Tipdocxper
 * @property PaginatorComponent $Paginator
 * @property AclComponent $Acl
 */
class TipdocxpersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Acl');
	public $uses = array('Tipdocxper','Persona','Tipodoc');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','Listado de Documentos');
		$this->Tipdocxper->recursive = 0;

		$this->paginate=array('limit' => 8,
				'page' => 1,
				//'order'=>array('Persona.apellido'=>'desc','Persona.nombre'=>'desc'),
				'conditions'=>array('Tipdocxper.persona_id'=>$this->Session->read('persona_id')));
		$this->set('tipdocxpers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tipdocxper->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$options = array('conditions' => array('Tipdocxper.' . $this->Tipdocxper->primaryKey => $id));
		$this->set('Tipdocxper', $this->Tipdocxper->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','');
		if ($this->request->is('post')) {
			$this->Tipdocxper->create();
			$this->request->data['Tipdocxper']['persona_id']	= $this->Session->read('persona_id');
			$this->request->data['Tipdocxper']['usuariocrea']	= $this->Session->read('username');
			$this->request->data['Tipdocxper']['ip']					= $this->request->clientIp();
			$this->request->data['Tipdocxper']['usuariocrea']	= $this->Session->read('username');
			$this->request->data['Tipdocxper']['ipcrea']			= $this->request->clientIp();
			$this->request->data['Tipdocxper']['usuarioactu']	= $this->Session->read('username');
			$this->request->data['Tipdocxper']['ipactu']			= $this->request->clientIp();

			if ($this->Tipdocxper->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar el tipo de coumento. Por Favor intente de nuevo.'));
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
		$this->set('title_for_layout','Actualizar Tipo de Documento');
		if (!$this->Tipdocxper->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tipdocxper->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tipdocxper.' . $this->Tipdocxper->primaryKey => $id));
			$this->request->data = $this->Tipdocxper->find('first', $options);
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
		$this->Tipdocxper->id = $id;
		if (!$this->Tipdocxper->exists()) {
			throw new NotFoundException(__('Invalid Tipdocxper'));
		}
		try {
			if ($this->Tipdocxper->delete()) {
				$this->Session->setFlash(__('El Documento fue Borrado.'));
			} else {
				$this->Session->setFlash(__('El Documento no puede ser Borrado. Por Favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}
		return $this->redirect(array('action' => 'index'));
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

		$persona_id =$this->Session->read('persona_id');
		if(!empty($persona_id)){
			$persona = $this->Persona->find('first',array('conditions'=>array('Persona.id'=>$this->Session->read('persona_id'))));
		}else{
			$persona=array();
		}

		if($this->params['action']=='edit' || $this->params['action']=='add'){
			$tipodocs = $this->Tipodoc->find('list',array('fields'=>array('Tipodoc.id','Tipodoc.descrip')));
		}
		$this->set(compact('persona','tipodocs'));


	}


	public function existetipdocper($persona_id = null,$tipodoc_id = null,$nrodoc = null){
		$this->layout='';
		$existe = 0;
		if(!empty($tipodoc_id) && !empty($nrodoc)){
			$ls_filtro='1=1 ';
			if($persona_id !=0){
				$ls_filtro=$ls_filtro.' AND Tipdocxper.persona_id = '.$persona_id;
			}
			$existe = $this->Tipdocxper->find('count',array('conditions'=>array($ls_filtro,
																	'Tipdocxper.tipodoc_id'=>$tipodoc_id,
																	'Tipdocxper.nrodoc'=>$nrodoc
			)));
		}
		$this->set('existe',$existe);
	}

	public function beforeFilter() {
	    parent::beforeFilter();

	    // For CakePHP 2.0
	   // $this->Auth->allow('*');

	    // For CakePHP 2.1 and up
	    //$this->Auth->allow();
	}
}

?>
