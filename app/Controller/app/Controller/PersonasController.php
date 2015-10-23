<?php
App::uses('AppController', 'Controller');
/**
 * Personas Controller
 *
 * @property Persona $Persona
 * @property PaginatorComponent $Paginator
 */
class PersonasController extends AppController {

	public $uses = array('Persona','Tipdocxper','Tipodoc','Paise','Coord','Coordsxpersona');
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
		$this->Persona->recursive = 0;
		$this->set('personas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		$options = array('conditions' => array('Persona.' . $this->Persona->primaryKey => $id));
		$this->set('persona', $this->Persona->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Alta de Persona');
		if ($this->request->is('post')) {
			$this->Persona->create();
			$this->request->data['Tipdocxper']['nrodoc'] = str_replace('.', '', $this->request->data['Tipdocxper']['nrodoc']);			
			$this->request->data['Persona']['username']=$this->Session->read('username');
			$this->request->data['Persona']['ip']=$this->request->clientIp();
			$this->Persona->set($this->request->data['Persona']);
			$personaval = $this->Persona->validates();
			$personatipdoc = $this->Tipdocxper->validates();
			
			if ($personaval && $personatipdoc){
				print_r($this->request->data['Persona']);
				if($this->Persona->GuardarPersonaExterna($this->request->data)){
					$this->Session->setFlash(__('El Registro se Guardo Satisfactoriamente.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se pudo guardar el registro. Por favor intente de nuevo.'));
				}
			}else{
				print_r($this->request->data['Persona']);
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
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Persona->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fu actualizado'));
				return $this->redirect(array('controller'=>'users','action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Persona.' . $this->Persona->primaryKey => $id),
							'joins'=>array(array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Tipdocxper.persona_id = Persona.id and Tipdocxper.tipodoc_id=1'))));
			$this->request->data = $this->Persona->find('first', $options);
		}
		$estciviles = $this->Persona->Estcivile->find('list');
		$this->set(compact('estciviles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Persona->id = $id;
		if (!$this->Persona->exists()) {
			throw new NotFoundException(__('Invalid persona'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Persona->delete()) {
			$this->Session->setFlash(__('The persona has been deleted.'));
		} else {
			$this->Session->setFlash(__('The persona could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
/**
 * beforeRender method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 
	function beforeRender(){
		if($this->params['action']=='edit' || $this->params['action']=='add'){
			$estciviles = $this->Persona->Estcivile->find('list',array('fields'=>array('Estcivile.id','Estcivile.descrip')));
			$paises = $this->Paise->find('list',array('fields'=>array('Paise.id','Paise.descrip')));
			$this->set(compact('estciviles','paises'));
		}
		if($this->params['action']=='add'){
			$tipodocs = $this->Tipodoc->find('list',array('fields'=>array('Tipodoc.id','Tipodoc.descrip')));
			$this->set(compact('tipodocs'));			
		
		}
		
	}		
/**
 * listpersonas method listar las personas de acuerdo a filtros determinados
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function listpersonas(){
		$this->layout='';
		$ls_filtro = "1=1";
		if(!empty($this->request->data)){
			$this->request->data['Persona']['nrodoc'] = str_replace('.', '', $this->request->data['Persona']['nrodoc']);
			if(!empty($this->request->data['Persona']['nrodoc'])){
				$ls_filtro = $ls_filtro.' AND Tipdocxper.nrodoc = '.$this->request->data['Persona']['nrodoc'];
			}
			if(!empty($this->request->data['Persona']['apellido'])){
				$ls_filtro = $ls_filtro." AND Upper(Persona.apellido)  like Upper('%".$this->request->data['Persona']['apellido']."%')";
			}
			if(!empty($this->request->data['Persona']['nombre'])){
				$ls_filtro = $ls_filtro." AND Upper(Persona.nombre)  like Upper('%".$this->request->data['Persona']['nombre']."%')";
			}			
		}
	
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('Persona.apellido'=>'desc','Persona.nombre'=>'desc'),
							'conditions'=>$ls_filtro,
							'fields'=>array('Tipdocxper.tipodoc_id','Tipdocxper.nrodoc','Persona.id','Persona.email','Persona.apellido','Persona.nombre','Persona.fnac','Persona.sexo'),
							'joins'=>array(/*array('table'=>'personas',
															'alias'=>'Persona',
															'type'=>'LEFT',
											 			'conditions'=>array('Persona.id = User.persona_id')),*/
											array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Tipdocxper.persona_id = Persona.id and Tipdocxper.tipodoc_id=1'))
											));				
			$this->set('personas', $this->paginate());	
	}

/**
 * listpersonas method listar las personas de acuerdo a filtros determinados
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function listpersonassel(){
		$this->layout='';
		$ls_filtro = "1=1";
		if(!empty($this->request->data)){
			$this->request->data['Persona']['nrodoc'] = str_replace('.', '', $this->request->data['Persona']['nrodoc']);
			if(!empty($this->request->data['Persona']['nrodoc'])){
				$ls_filtro = $ls_filtro.' AND Tipdocxper.nrodoc = '.$this->request->data['Persona']['nrodoc'];
			}
			if(!empty($this->request->data['Persona']['apellido'])){
				$ls_filtro = $ls_filtro." AND Upper(Persona.apellido)  like Upper('%".$this->request->data['Persona']['apellido']."%')";
			}
			if(!empty($this->request->data['Persona']['nombre'])){
				$ls_filtro = $ls_filtro." AND Upper(Persona.nombre)  like Upper('%".$this->request->data['Persona']['nombre']."%')";
			}			
		}
	
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('Persona.apellido'=>'desc','Persona.nombre'=>'desc'),
							'conditions'=>$ls_filtro,
							'fields'=>array('Tipdocxper.tipodoc_id','Tipdocxper.nrodoc','Persona.id','Persona.email','Persona.apellido','Persona.nombre','Persona.fnac','Persona.sexo'),
							'joins'=>array(/*array('table'=>'personas',
															'alias'=>'Persona',
															'type'=>'LEFT',
											 			'conditions'=>array('Persona.id = User.persona_id')),*/
											array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Tipdocxper.persona_id = Persona.id and Tipdocxper.tipodoc_id=1'))
											));				
			$this->set('personas', $this->paginate());	
	}

	
	public function beforeFilter() {
	    parent::beforeFilter();
	
	    // For CakePHP 2.0
	    $this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	    $this->Auth->allow();
	}
	
	public function demophoto(){
		$this->layout='';
	}
	
	/*
	* Funcion: Permite localizar el punto dónde se encuentra un persona
	*/	
	public function getlocalize($id=null){
		$this->set('title_for_layout',__('Ubicacion GPS de Persona'));
		if(!empty($id)) 
			$this->Session->write('id');
		else
			$id = $this->Session->write('id');		
		if(!empty($id)){
			$personas = $this->Persona->find('first',array('conditions'=>array('Persona.id'=>$id),
										'joins'=>array(array('table'=>'coordsxpersonas',
															'alias'=>'Coordsxpersona',
															'type'=>'LEFT',
															'conditions'=>array('Coordsxpersona.persona_id = Persona.id')),
															array('table'=>'coords',
															'alias'=>'Coord',
															'type'=>'LEFT',
															'conditions'=>array('Coordsxpersona.coord_id = Coord.id'))),
										'fields'=>array('Persona.id','Persona.nombre','Persona.apellido','Coord.latitud','Coord.longitud','Coord.descrip'),
										'order'=>array('Coord.id'=>'DESC')));
			$this->set(compact('personas'));
		}
			
		if(!empty($this->request->data)){		
				if ($this->request->is(array('post', 'put'))) {
					$coords['Coord']['latitud']	=$this->request->data['Coord']['latitude'];	
					$coords['Coord']['longitud']=$this->request->data['Coord']['longitude'];	
					$coords['Coord']['fecha']	= date('Y-m-d H:i:s');	
					$coords['Coord']['descrip']	=$this->request->data['Coord']['descrip'];	
					$coords['Coord']['persona_id']= $this->request->data['Coord']['persona_id'];	
					if($this->Coord->guardarcoor($coords)){
						$this->Session->setFlash('Ubicación GPS guardada satisfactoriamente');
					}else{
						$this->Session->setFlash('No se pudo almacenar el punto GPS');
					}					
					return $this->redirect(array('action' => 'index'));
				}
		}																		
	}
	
	public function seleccionarpersonasgrupo($rowpos = null){
		$this->layout = 'bmodalbox';
		$this->set('rowpos',$rowpos);
	}

}
