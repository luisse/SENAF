<?php
App::uses('AppController', 'Controller');
/**
 * Persxgrupsociales Controller
 *
 * @property Persxgrupsociale $Persxgrupsociale
 * @property PaginatorComponent $Paginator
 */
class PersxgrupsocialesController extends AppController {
	public $uses = array('Persxgrupsociale','Grupsociale');
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
		$this->Persxgrupsociale->recursive = 0;
		$this->set('persxgrupsociales', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Persxgrupsociale->exists($id)) {
			throw new NotFoundException(__('Invalid persxgrupsociale'));
		}
		$options = array('conditions' => array('Persxgrupsociale.' . $this->Persxgrupsociale->primaryKey => $id));
		$this->set('persxgrupsociale', $this->Persxgrupsociale->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($grupsociale_id = null) {
		$this->set('title_for_layout',__('Asociar Personas a Grupo Social'));
		if ($this->request->is('post')) {
			$this->Persxgrupsociale->create();
			$grupsociale_id = $this->request->data['Persxgrupsociale']['grupsociale_id'];
			unset($this->request->data['Persxgrupsociale']['grupsociale_id']);
			foreach($this->request->data as $persxgrupsociales){
				$i=0;
				foreach($persxgrupsociales as $persxgrupsociale){
					$this->request->data['Persxgrupsociale'][$i]['grupsociale_id'] = $grupsociale_id;
					$this->request->data['Persxgrupsociale'][$i]['persona_id'] = $persxgrupsociale['persona_id'];
					$this->request->data['Persxgrupsociale'][$i]['usuariocrea'] = $this->Session->read('username');
					$this->request->data['Persxgrupsociale'][$i]['ipcrea']=$this->request->clientIp();
					$i++;		
				}
			}
			
			if ($this->Persxgrupsociale->saveMany($this->request->data['Persxgrupsociale'])) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('controller' =>'personas','action' =>'sissegpersona'));
			} else {
				$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
				$grupsociale_id = $this->request->data['Persxgrupsociale']['grupsociale_id'];
			}
		}
		if(!empty($grupsociale_id)){
			$gruposociale = $this->Grupsociale->find('first',array('conditions'=>array('Grupsociale.id'=>$grupsociale_id)));
		}

		$this->set(compact('gruposociale'));
		$this->set('grupsociale_id',$grupsociale_id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Persxgrupsociale->exists($id)) {
			throw new NotFoundException(__('Invalido persxgrupsociale'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Persxgrupsociale->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Persxgrupsociale.' . $this->Persxgrupsociale->primaryKey => $id));
			$this->request->data = $this->Persxgrupsociale->find('first', $options);
		}
		$personas = $this->Persxgrupsociale->Persona->find('list');
		$grupsociales = $this->Persxgrupsociale->Grupsociale->find('list');
		$persxoficinas = $this->Persxgrupsociale->Persxoficina->find('list');
		$this->set(compact('personas', 'grupsociales', 'persxoficinas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->layout='';
		$error = '';
		$this->Persxgrupsociale->id = $id;
		if (!$this->Persxgrupsociale->exists()) {
			throw new NotFoundException(__('Invalid persxgrupsociale'));
		}
		try {		
			if (!$this->Persxgrupsociale->delete()) {
				$error = 'No se puede eliminar la persona asociada al grupo';
			}
		}catch(Exception $e){
			$error = 'Error: No se puede eliminar el registro. Atributo asignado a registro';
		}
				
		$this->set('error',$error);
	}
	
	public function borrarpersona($persona_id = null,$persxgrupsociale_id = null){
		$this->layout='';
		$error='';
		if(!empty($persona_id)){
			try{
				if (!$this->Persxgrupsociale->deleteAll(array('Persxgrupsociale.persona_id'=>$persona_id,
																'Persxgrupsociale.id'=>$persxgrupsociale_id
				))) {
					$error = 'No se puede eliminar la persona asociada al grupo';
				}
			}catch(Exception $e){
				$error = 'Error: No se puede eliminar el registro. Atributo asignado a registro';
			}
		}
		$this->set('error',$error);
	}
	
	public function existepersgruposoc($afinidade_id = null,$persona_id=null){
		$this->layout='';
		$count = 0;
		if(!empty($persona_id) && !empty($afinidade_id)){
			$count = $this->Persxgrupsociale->find('count',array('conditions'=>array('Persxgrupsociale.persona_id'=>$persona_id,
																		'Grupsociale.afinidade_id'=>$afinidade_id)));
		}
		$this->set('count',$count);
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
	public function beforeFilter() {
	    parent::beforeFilter();
	
	    // For CakePHP 2.0
	    //$this->Auth->allow('*');
	
	    // For CakePHP 2.1 and up
	    //$this->Auth->allow();
	}
	
	/**
	 * agregarfila method
	 *
	 * @throws NotFoundException
	 * @param integer $row Referencia de fila actual no creada
	 * @return void
	 */
	
	public function agregarfila($row = null){
		$this->layout='';
		$this->set('row',$row);
	}
		
	/**
	 * existepersonagrupo agrega rpersonas a grupo
	 *
	 * @throws NotFoundException
	 * @param integer $grupsociale_id Grupo Social Asociado
	 * @param integer $persona_id Persona Asociada
	 * @return void
	 */
	
	public function existepersonagrupo($grupsociale_id = null,$persona_id = null){
		$this->layout='';
		$cant = 0;
		if(!empty($grupsociale_id) && !empty($persona_id)){
			$cant = $this->Persxgrupsociale->find('count',array('conditions'=>array('Persxgrupsociale.grupsociale_id'=>$grupsociale_id,
																					'Persxgrupsociale.persona_id'=>$persona_id)));
		}
		$this->set('cant',$cant);
	}

	/**
	 * modificargrupopersona modificar grupos de personas
	 *
	 * @throws NotFoundException
	 * @param integer $persona_id Persona Asociada al Grupo
	 * @return void
	 */
	public function modificargrupopersona($persona_id = null){
		$this->set('title_for_layout','Modificar Grupo');		
		if(!empty($persona_id)){
								//PERSONAS ASOCIADAS A GRUPO SOCIALES
					$this->Persxgrupsociale->unbindModel(
							array('belongsTo' => array('Grupsociale')));
					$persxgrupsociales = $this->Persxgrupsociale->find('all',array('conditions'=>array('Persxgrupsociale.persona_id'=>$persona_id),
																					'joins'=>array(	
																						array('table'=>'grupsociales',
																								'alias'=>'Grupsociale',
																								'type'=>'LEFT',
																								'conditions'=>array('Grupsociale.id = Persxgrupsociale.grupsociale_id')),
																						array('table'=>'afinidades',
																								'alias'=>'Afinidade',
																								'type'=>'LEFT',
																								'conditions'=>array('Grupsociale.afinidade_id = Afinidade.id'))),
																					'fields'=>array('Persxgrupsociale.id','Persxgrupsociale.persona_id','Persxgrupsociale.grupsociale_id',
																									'Grupsociale.id','Grupsociale.afinidade_id','Afinidade.id','Afinidade.descrip')));
					//DOMICILIOS CARGADOS
					$j=0;
					//Cargo Domicilios y personas
					foreach($persxgrupsociales as $persxgrupsociale){
						//Personas asociadas al grupo social
						$personasgruposocial = $this->Persxgrupsociale->find('all',array('conditions'=>array('Persxgrupsociale.grupsociale_id'=>$persxgrupsociale['Grupsociale']['id'])));
						if(!empty($personasgruposocial)){
							$gruposocialpersonas[$j]= $personasgruposocial;
						}
						
						$gruposocialpersonas[$j]['Afinidade']['descrip'] =  $persxgrupsociale['Afinidade']['descrip'];	
						$gruposocialpersonas[$j]['Grupsociale']['id'] =  $persxgrupsociale['Grupsociale']['id'];	
						$j++;
					}
					$this->set(compact('gruposocialpersonas'));
		}
	}
	
	/**
	 * editgrupsave Permite guardar u modificar los grupos acorde a los cambios realizados
	 *
	 * @throws NotFoundException
	 * @param POTS Llamada AJAX con POST
	 * @return void
	 */
	
	public function editgrupsave(){
		//FORMATO Gruposocialeid-position tabla-Grupo Social-Persona Id
		//[grupxpersonas] => 14G0|14-21,14-22,37G1|37-22,14-23,38G2|38-22,39G3|39-22,40G4|40-22,
		
		$this->layout='';
		$error='';
		$grupoborrar=array();
		$grupoagregar=array();
		if( isset($_POST['accion']) ){
			$grupopersonasstr =$_POST['grupxpersonas'];
			$grupopersonasvc = preg_split('/&/', $grupopersonasstr, -1, PREG_SPLIT_OFFSET_CAPTURE);
			
			$rows = count($grupopersonasvc);
			$i=0;
			while($i < $rows){
				//recuperamos todo el grupo
				$strgrup = $grupopersonasvc[$i][0];
				//sacamos el grupo cabecera
				$index = $i-1;
				$pos = strpos($strgrup,'|');
				
				//gruposocial de la cabecera
				$grupsocialecab_id = '';
				$grupsocialecab_id = substr($strgrup,0,$pos);
				$grupsocialecab_id = str_replace('G'.$index,'',$grupsocialecab_id);
				$grupsocialecab_id = trim($grupsocialecab_id);
				
				//personas asociadas al grupo
				$personasasociadas=substr($strgrup,$pos + 1,strlen($strgrup));
				$personasasociadasvc = preg_split('/,/', $personasasociadas, -1, PREG_SPLIT_OFFSET_CAPTURE);
				//recorremos los subgrupos
				$j=0;
				foreach($personasasociadasvc as $personaasociada){
					if(!empty($personaasociada[0])){
						$pos = strpos($personaasociada[0],'-');
						//grupo social perteneciente actualmente
						$grupsociale_id = substr($personaasociada[0],0,$pos);
						$persona_id = substr($personaasociada[0],$pos + 1,strlen($personaasociada[0]));
						if($grupsocialecab_id != $grupsociale_id){
							$grupoborrar[$j]['Grupsociale']['id']=$grupsociale_id;
							$grupoborrar[$j]['Grupsociale']['persona_id']=$persona_id;
							$grupoborrar[$j]['Grupsociale']['usuariocrea']=$this->Session->read('username');
							$grupoborrar[$j]['Grupsociale']['ipcrea']=$this->request->clientIp();
							$grupoagregar[$j]['Grupsociale']['id']=$grupsocialecab_id;
							$grupoagregar[$j]['Grupsociale']['persona_id']=$persona_id;
							$grupoagregar[$j]['Grupsociale']['usuariocrea']=$this->Session->read('username');
							$grupoagregar[$j]['Grupsociale']['ipcrea']=$this->request->clientIp();
							$j++;
							//echo 'Distintos Grupos Sociales Cambios requeridos'.$grupsocialecab_id.'='.$grupsociale_id."\n";
						}
					}
				}
				$i++;
			}
			//ejecutamos la consulta en caso de existir datos
			if(!$this->Persxgrupsociale->actualizargruposocial($grupoborrar,$grupoagregar)){
				$error='No se pudo actualizar el grupo social';	
			}
		}
		$this->set('error',$error);
	}
	
}
