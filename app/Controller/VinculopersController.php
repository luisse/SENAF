<?php
App::uses('AppController', 'Controller');
/**
 * Vinculopers Controller
 *
 * @property Vinculoper $Vinculoper
 * @property PaginatorComponent $Paginator
 */
class VinculopersController extends AppController {
	public $uses = array('Vinculoper','Parentesco','Tipdocxper','Persona');
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
	public function index($persona_id = null) {
		$persona=array();
		if(!empty($persona_id)){
			$persona_id =41;
			$persona = $this->Persona->find('first',array('conditions'=>array('Persona.id'=>$persona_id)));
		}
		$this->set(compact('persona'));
		$this->set('title_for_layout',__('Listado de Vinculos'));
	}

	public function listvinculopers(){
		$this->layout='';
		$ls_filtro = '1=1';
		if(!empty($this->request->data)){
			//print_r($this->request->data);
			if(!empty($this->request->data['Persona']['nrodoc']) && $this->request->data['Persona']['nrodoc']!=''){
				//recuperamos la persona asociada al documento ingresado
				$tipodocpers = $this->Tipdocxper->find('first',array('conditions'=>array('Tipdocxper.nrodoc'=>$this->request->data['Persona']['nrodoc'])));
				if(!empty($tipodocpers)){
					$ls_filtro = $ls_filtro.' AND Personaizq.id ='.$tipodocpers['Tipdocxper']['persona_id'];
				}
			}
			if(!empty($this->request->data['Persona']['nombre']) && $this->request->data['Persona']['nombre']!=''){
				$ls_filtro = $ls_filtro." AND Upper(Personaizq.nombre)  like Upper('%".$this->request->data['Persona']['nombre']."%')";
			}
			if(!empty($this->request->data['Persona']['apellido']) && $this->request->data['Persona']['apellido']!=''){
				$ls_filtro = $ls_filtro." AND Upper(Personaizq.apellido)  like Upper('%".$this->request->data['Persona']['apellido']."%')";
			}
		}

		$this->Vinculoper->recursive = 0;
		$this->paginate=array('limit' => 10,
				'page' => 1,
				'conditions'=>$ls_filtro,
				'fields'=>array('Vinculoper.personaizq_id','Vinculoper.parentesco_id','Vinculoper.id',
								'Vinculoper.personadcha_id','Personaizq.nombre','Personaizq.apellido',
								'Personadrch.nombre','Personadrch.apellido','Parentesco.descrip'
				),
				'joins'=>array(array('table'=>'personas',
												'alias'=>'Personadrch',
												'type'=>'LEFT',
												'conditions'=>array('Personadrch.id = Vinculoper.personadcha_id')),
									array('table'=>'personas',
										'alias'=>'Personaizq',
										'type'=>'LEFT',
										'conditions'=>array('Personaizq.id = Vinculoper.personaizq_id')),
									array('table'=>'parentescos',
										'alias'=>'Parentesco',
										'type'=>'LEFT',
										'conditions'=>array('Parentesco.id = Vinculoper.parentesco_id'))
				)
		);
		$this->set('vinculopers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Vinculoper->exists($id)) {
			throw new NotFoundException(__('Vinculo identificador Invalido'));
		}
		$options = array('conditions' => array('Vinculoper.' . $this->Vinculoper->primaryKey => $id));
		$this->set('vinculoper', $this->Vinculoper->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Vinculoper->create();
			foreach($this->request->data as $vinculopers){
				$i=0;
				foreach($vinculopers as $vinculoper){
					$vinculoperss['Vinculoper'][$i]['personaizq_id']	= $vinculoper['personaizq_id'];
					$vinculoperss['Vinculoper'][$i]['parentesco_id']	= $vinculoper['parentesco_id'];
					$vinculoperss['Vinculoper'][$i]['personadcha_id']	= $vinculoper['personadcha_id'];
					$vinculoperss['Vinculoper'][$i]['usuariocrea']		= $this->Session->read('username');
					$vinculoperss['Vinculoper'][$i]['ipcrea']					= $this->request->clientIp();
					$vinculoperss['Vinculoper'][$i]['usuarioactu']		= $this->Session->read('username');
					$vinculoperss['Vinculoper'][$i]['ipactu']					= $this->request->clientIp();

					//CREACION VINCULO INVERSO
					$parentesco = $this->Parentesco->find('first',array('conditions'=>array('Parentesco.id'=>$vinculoper['parentesco_id'])));
					if(!empty($parentesco)){
						$i++;
						$vinculoperss['Vinculoper'][$i]['personaizq_id']	= $vinculoper['personadcha_id'];
						$vinculoperss['Vinculoper'][$i]['parentesco_id']	= $parentesco['Parentesco']['parentesco_id'];
						$vinculoperss['Vinculoper'][$i]['personadcha_id']	= $vinculoper['personaizq_id'];
						$vinculoperss['Vinculoper'][$i]['usuariocrea']		= $this->Session->read('username');
						$vinculoperss['Vinculoper'][$i]['ipcrea']					= $this->request->clientIp();
						$vinculoperss['Vinculoper'][$i]['usuarioactu']		= $this->Session->read('username');
						$vinculoperss['Vinculoper'][$i]['ipactu']					= $this->request->clientIp();
					}
					$i++;
				}
			}
			if ($this->Vinculoper->saveMany($vinculoperss['Vinculoper'])) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$error = $this->Vinculoper->invalidFields();
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
		$this->set('title_for_layout',__('Actualizar Vinculos'));
		if (!$this->Vinculoper->exists($id)) {
			throw new NotFoundException(__('Invalido vinculoper'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Vinculoper->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Vinculoper.' . $this->Vinculoper->primaryKey => $id),
					'joins'=>array(array('table'=>'personas',
							'alias'=>'Personadrch',
							'type'=>'LEFT',
							'conditions'=>array('Personadrch.id = Vinculoper.personadcha_id')),
							array('table'=>'personas',
									'alias'=>'Personaizq',
									'type'=>'LEFT',
									'conditions'=>array('Personaizq.id = Vinculoper.personaizq_id')),
							array('table'=>'parentescos',
									'alias'=>'Parentesco',
									'type'=>'LEFT',
									'conditions'=>array('Parentesco.id = Vinculoper.parentesco_id'))
					),
					'fields'=>array('Vinculoper.personaizq_id','Vinculoper.parentesco_id','Vinculoper.id',
							'Vinculoper.personadcha_id','Personaizq.nombre','Personaizq.apellido',
							'Personadrch.nombre','Personadrch.apellido','Parentesco.descrip'
					)
			);
			$this->request->data = $this->Vinculoper->find('first', $options);
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
		$this->Vinculoper->id = $id;
		if (!$this->Vinculoper->exists()) {
			throw new NotFoundException(__('Invalid vinculoper'));
		}

		$vinculoper = $this->Vinculoper->find('first',array('conditions'=>array('Vinculoper.id'=>$id)));
		if(!empty($vinculoper)){
			$parentesco = $this->Parentesco->find('first',array('conditions'=>array('Parentesco.id'=>$vinculoper['Vinculoper']['parentesco_id'])));

		}
		try {
			if ($this->Vinculoper->delete()) {
				//borramos el reciproco
				if(!empty($parentesco)){
					$this->Vinculoper->deleteAll(array('Vinculoper.personadcha_id'=>$vinculoper['Vinculoper']['personaizq_id'],
																'Vinculoper.parentesco_id'=>$parentesco['Parentesco']['parentesco_id'],
																'Vinculoper.personaizq_id'=>$vinculoper['Vinculoper']['personadcha_id']));
				}
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
		if($this->params['action']=='edit' || $this->params['action']=='add'  || $this->params['action']=='index' ||
				$this->params['action'] == 'agregarfila'){
			$parentescos = $this->Parentesco->find('list',array('fields'=>array('Parentesco.id','Parentesco.descrip'),
					'order'=>array('Parentesco.descrip ASC')));
			if($this->params['action']=='index'){
				//$parentescos[0]='Todas';
			}

			$this->set(compact('parentescos'));
		}

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

	/**
	 * agregarfila vista retorna fila nueva para cargar con ajax
	 *
	 * @throws NotFoundException
	 * @param integer $row fila asignada
	 * @return void
	 */
	public function agregarfila($row){
		$this->layout='';
		$this->set('row',$row);
	}

	public function beforeFilter() {
		parent::beforeFilter();

		// For CakePHP 2.0
		$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		$this->Auth->allow();
	}
	/**
	 * existepersonagrupo AJAX permite determinar si dos personas existen ya vinculadas
	 *
	 * @throws NotFoundException
	 * @param integer $personadcha_id persona a vincular
	 * @param integer $parentesco_id parentesto de la persona
	 * @param integer $personadcha_id persona a vincular derecha
	 * @return void
	 */

	public function existepersonagrupo($personaizq_id = null,$parentesco_id = null,$personadcha_id = null){
		$this->layout='';
		$existe=0;
		if(!empty($personaizq_id) && !empty($personadcha_id)){
			$existe = $this->Vinculoper->find('count',array('conditions'=>array('personaizq_id'=>$personaizq_id,
																				'parentesco_id'=>$parentesco_id,
																				'personadcha_id'=>$personadcha_id
			)));
			if($existe == 0){
				$existe = $this->Vinculoper->find('count',array('conditions'=>array('personaizq_id'=>$personadcha_id,
						'parentesco_id'=>$parentesco_id,
						'personadcha_id'=>$personaizq_id
				)));
			}
		}
		$this->set('existe',$existe);
	}
}
