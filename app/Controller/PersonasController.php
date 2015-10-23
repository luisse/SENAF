<?php
App::uses('AppController', 'Controller');
/**
 * Personas Controller
 *
 * @property Persona $Persona
 * @property PaginatorComponent $Paginator
 */
class PersonasController extends AppController {

	public $uses = array('Persona','Tipdocxper','Tipodoc',
						'Paise','Coord','Coordsxpersona',
						'Barrio','Persxgrupsociale',
						'Persxparentesco','Grupsocxdomi','Vinculoper','Tiparchivo','Archivo');
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
		$this->layout = 'bmodalbox';
		$archivo=array();
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		$options = array('conditions' => array('Persona.' . $this->Persona->primaryKey => $id),
						/*'joins'=>array(array('table'=>'estciviles',
												'alias'=>'Estcivile',
												'type'=>'LEFT',
												'conditions'=>array('Estcivile.id = Persona.estcivile_id'))),*/
						'values'=>array('Persona.id','Perosna.apellido','Persona.nombre','Persona.sexo','Persona.fnac','Persona.ffallec','Estcivile.descrip'));
						
		$persona=$this->Persona->find('first', $options);				
		if(!empty($persona)){
			$archivo = $this->Archivo->getfotopersonal($persona['Persona']['id']);
		}
		
		$this->set(compact('persona','archivo'));
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
			$this->request->data['Tipdocxper']['tipodoc_id']=$this->request->data['Persona']['tipodoc_id'];
			$this->request->data['Tipdocxper']['nrodoc'] = str_replace('.', '', $this->request->data['Persona']['nrodoc']);			
			$this->request->data['Persona']['username']=$this->Session->read('username');
			$this->request->data['Persona']['ip']=$this->request->clientIp();
			
			$grupsociale_id = $this->Session->read('grupsociale_id');
			
			if(empty($this->request->data['Persona']['email']) || $this->request->data['Persona']['email'] == '' ) $this->request->data['Persona']['email']='nn@noinforma.com';
			if(!empty($grupsociale_id))	$this->request->data['Persona']['grupsociale_id'] = $this->Session->read('grupsociale_id');
			$this->Persona->set($this->request->data['Persona']);
			if(!empty($this->request->data['Persona']['foto'])){
				//Recuperamos id de tipo de foto
				$tiparchivo = $this->Tiparchivo->find('first',array('conditions'=>array('Tiparchivo.descrip'=>'FOTO PERSONAL')));
				if(!empty($tiparchivo)){
					$this->request->data['Persona']['tiparchivo_id']=$tiparchivo['Tiparchivo']['id'];
				}
			}
			$personaval = $this->Persona->validates();
			$personatipdoc = $this->Tipdocxper->validates();
			if ($personaval && $personatipdoc){
				if($this->Persona->GuardarPersonaExterna($this->request->data)){
						return $this->redirect(array('action' => 'index'));						
				}else{
					$this->Session->setFlash(__('No se pudo guardar el registro. Por favor intente de nuevo.'));
				}
			}
		}else{
			/***$grupsociale_id = $this->Session->read('grupsociale_id');
			if(!empty($grupsociale_id)){
				$persxgrupsociales = $this->Persxgrupsociale->find('all',array('conditions'=>array('grupsociale_id'=>$grupsociale_id)));
				$this->set(compact('persxgrupsociales'));
			}***/
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
			if($this->request->data['Persona']['email']=='@') $this->request->data['Persona']['email']='nn@noinforma.com';
			if ($this->Persona->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro fu actualizado'));
				return $this->redirect(array('controller'=>'users','action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			//SETEAMOS EN LA SESION LA PERSONA 
			$this->Session->write('persona_id',$id);
			$options = array('conditions' => array('Persona.' . $this->Persona->primaryKey => $id),
							'joins'=>array(array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Tipdocxper.persona_id = Persona.id and Tipdocxper.tipodoc_id=2'))));
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
			throw new NotFoundException(__('Registro Invalido'));
		}
		try {
			if ($this->Persona->delete()) {
				$this->Session->setFlash(__('La persona fue eliminada.'));
			} else {
				$this->Session->setFlash(__('No se puede eliminar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
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
			$barrios = $this->Barrio->find('list',array('fields'=>array('Barrio.id','Barrio.descrip')));
			$this->set(compact('estciviles','paises','barrios'));
		}
		if($this->params['action']=='add' ||
			$this->params['action']=='edit'){
			$tipodocs = $this->Tipodoc->find('list',array('fields'=>array('Tipodoc.id','Tipodoc.descrip')));
			$this->set(compact('tipodocs'));			
		
		}
		
		if($this->params['action']	=='listpersonas' ||
			$this->params['action']	=='listpersonassel' ||
			$this->params['action']	=='view' ||
			$this->params['action']	=='mostrarseguimiento'){
			$tipodocs = $this->Tipodoc->find('list',array('fields'=>array('Tipodoc.id','Tipodoc.descred')));
			$this->set(compact('tipodocs'));			
		}
		
		
		/**try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
					), ucfirst($this->params['controller']).'/'.$this->params['action']);
				if(!$result)
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',$this->params['controller'].'-'.$this->params['action']));
			}catch(Exeption $e){
				
			}**/
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
		$fpersonas=null;
		if(!empty($this->request->data)){
			$this->request->data['Persona']['nrodoc'] = str_replace('.', '', $this->request->data['Persona']['nrodoc']);
			if(!empty($this->request->data['Persona']['nrodoc'])){
				$ls_filtro = $ls_filtro.' AND Tipdocxper.nrodoc = '.$this->request->data['Persona']['nrodoc'];
				$fpersonas=array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Tipdocxper.persona_id = Persona.id'));
			}
			
			if(!empty($this->request->data['Persona']['apellido']))
				$ls_filtro = $ls_filtro." AND Upper(Persona.apellido)  like Upper('%".$this->request->data['Persona']['apellido']."%')";
			
			if(!empty($this->request->data['Persona']['nombre']))
				$ls_filtro = $ls_filtro." AND Upper(Persona.nombre)  like Upper('%".$this->request->data['Persona']['nombre']."%')";
			
			if(!empty($this->request->data['Persona']['nn'])){
				if ($this->request->data['Persona']['nn']==1)
					$ls_filtro = $ls_filtro." AND Persona.nn = true";
				else
					$ls_filtro = $ls_filtro." AND Persona.nnn = false";
			}

			if(!empty($this->request->data['Persona']['id']))
				$ls_filtro = $ls_filtro." AND Persona.id = ".$this->request->data['Persona']['id'];
				
			if(!empty($this->request->data['Persona']['detalle']))
				$ls_filtro = $ls_filtro." AND Upper(Persona.detalle) like Upper('%".$this->request->data['Persona']['detalle']."%')";
		}
	
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('Persona.apellido'=>'desc','Persona.nombre'=>'desc'),
							'conditions'=>$ls_filtro,
							'fields'=>array(/*'Tipdocxper.tipodoc_id','Tipdocxper.nrodoc',*/'Persona.id','Persona.email','Persona.apellido','Persona.nombre','Persona.fnac','Persona.sexo'),
							'joins'=>array($fpersonas));				
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
				$ls_filtro = $ls_filtro.' AND EXISTS(SELECT 1 FROM "public"."tipdocxpers" WHERE "tipdocxpers"."persona_id" = "Persona"."id" AND "tipdocxpers"."nrodoc"='.$this->request->data['Persona']['nrodoc'].')';
			}
			if(!empty($this->request->data['Persona']['apellido'])){
				$ls_filtro = $ls_filtro." AND Upper(Persona.apellido)  like Upper('%".$this->request->data['Persona']['apellido']."%')";
			}
			if(!empty($this->request->data['Persona']['nombre'])){
				$ls_filtro = $ls_filtro." AND Upper(Persona.nombre)  like Upper('%".$this->request->data['Persona']['nombre']."%')";
			}
			
			if(!empty($this->request->data['Persona']['nn'])){
				if ($this->request->data['Persona']['nn']==1)
					$ls_filtro = $ls_filtro." AND Persona.nn = true";
				else
					$ls_filtro = $ls_filtro." AND Persona.nnn = false";
			}
			
			if(!empty($this->request->data['Persona']['id']))
				$ls_filtro = $ls_filtro." AND Persona.id = ".$this->request->data['Persona']['id'];
			
			if(!empty($this->request->data['Persona']['detalle']))
				$ls_filtro = $ls_filtro." AND Upper(Persona.detalle) like Upper('%".$this->request->data['Persona']['detalle']."%')";
		}
	
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('Persona.apellido'=>'desc','Persona.nombre'=>'desc'),
							'conditions'=>$ls_filtro,
							'fields'=>array(/***'Tipdocxper.tipodoc_id','Tipodoc.descred','Tipdocxper.nrodoc',***/'Persona.id','Persona.email','Persona.apellido','Persona.nombre','Persona.fnac','Persona.sexo'),
							'joins'=>array(/**array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Tipdocxper.persona_id = Persona.id')),
											array('table'=>'tipodocs',
															'alias'=>'Tipodoc',
															'type'=>'LEFT',
											 			'conditions'=>array('Tipodoc.id = Tipdocxper.tipodoc_id'))**/															
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
	* Funcion: Permite localizar el punto d�nde se encuentra un persona
	*/	
	public function getlocalize($id=null){
		$this->set('title_for_layout',__('Ubicacion GPS de Persona'));
		if(!empty($id)) 
			$this->Session->write('id');
		else
			$id = $this->Session->write('id');		
		if(!empty($id)){
			$personas = $this->Persona->find('all',array('conditions'=>array('Persona.id'=>$id),
										'joins'=>array(array('table'=>'coordsxpersonas',
															'alias'=>'Coordsxpersona',
															'type'=>'LEFT',
															'conditions'=>array('Coordsxpersona.persona_id = Persona.id')),
															array('table'=>'coords',
															'alias'=>'Coord',
															'type'=>'LEFT',
															'conditions'=>array('Coordsxpersona.coord_id = Coord.id'))),
										'fields'=>array('Persona.id','Persona.nombre','Persona.apellido','Coord.latitud','Coord.longitud','Coord.descrip','Coord.fecha'),
										'order'=>array('Coord.fecha'=>'DESC')));
			$this->set(compact('personas'));
		}
			
		if(!empty($this->request->data)){		
				if ($this->request->is(array('post', 'put'))) {
					$coords['Coord']['latitud']	=$this->request->data['Coord']['latitude'];	
					$coords['Coord']['longitud']=$this->request->data['Coord']['longitude'];	
					$coords['Coord']['fecha']	=$this->request->data['Coord']['fecha'];	
					$coords['Coord']['descrip']	=$this->request->data['Coord']['descrip'];	
					$coords['Coord']['persona_id']= $this->request->data['Coord']['persona_id'];	
					if($this->Coord->guardarcoor($coords)){
						$this->Session->setFlash('Punto GPS guardado satisfactoriamente');
					}else{
						$this->Session->setFlash('No se pudo almacenar el punto GPS');
					}					
					return $this->redirect(array('action' => 'index'));
				}
		}																		
	}

	/**
	 * seleccionapersona method permite seleccionar las persona para un grupo ventana modal
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	
	public function seleccionapersona($rowpos = null){
		$this->layout = 'bmodalbox';
		$this->set('rowpos',$rowpos);
	}
	/**
	 * seleccionarpersonasgrupo method permite seleccionar las persona para un grupo ventana modal
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	
	public function seleccionarpersonasgrupo($rowpos = null){
		$this->layout = 'bmodalbox';
		$this->set('rowpos',$rowpos);
	}

	/**
	 * seleccionarclientegrupsociale method permite seleccionar las persona para un grupo social. Ventana modal
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	
	public function seleccionarclientegrupsociale($rowpos = null){
		$this->layout = 'bmodalbox';
		$this->set('rowpos',$rowpos);
	}

	/**
	 * seleccionarpersonasvinculos method permite seleccionar las persona para un vinculo. Ventana modal
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	
	public function seleccionarpersonasvinculos($rowpos = null,$donde = null){
		$this->layout = 'bmodalbox';
		$this->set('rowpos',$rowpos);
		$this->set('donde',$donde);
	}

	/**
	 * sissegpersona method Seguimiento de personas filtros.
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	
	public function sissegpersona($persona_id = null){
		$this->Session->delete('grupsociale_id');
		$this->Session->delete('SISSEGPEREXISTE');
		if(!empty($persona_id)){
			$persona = $this->Persona->find('first',array('conditions'=>array('Persona.id'=>$persona_id)));
		}
		$this->set('title_for_layout',__('Seguimiento de Estado de Persona en Sistema'));
		$this->set(compact('persona'));
	}

	/**
	 * mostrarseguimiento method Seguimiento de personas ventana principal.
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	
	public function mostrarseguimiento(){
		$this->layout='';
		
		if(!empty($this->request->data)){
			if($this->Session->read('perdoc') != $this->request->data['Persona']['nrodoc']){
				$this->Session->write('perdoc',$this->request->data['Persona']['nrodoc']);
				if(!empty($this->request->data['Persona']['apellido']))
				$this->Session->write('perapellido',$this->request->data['Persona']['apellido']);
				if(!empty($this->request->data['Persona']['nombre']))
				$this->Session->write('pernombre',$this->request->data['Persona']['nombre']);
				
			}
			//$ls_filtro = "1=1";
			if(!empty($this->request->data)){
				$ls_filtro = "1=1";
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
			
				if(empty($ls_filtro)) return;
				$persona = $this->Persona->find('first',array('conditions'=>$ls_filtro,
															'fields'=>array('Persona.id','Persona.email','Persona.apellido','Persona.nombre','Persona.fnac','Persona.sexo','Persona.created'),
															'joins'=>array(array('table'=>'tipdocxpers',
																		'alias'=>'Tipdocxper',
																		'type'=>'LEFT',
																		'conditions'=>array('Tipdocxper.persona_id = Persona.id')))));
				if(!empty($persona)){
					$this->Session->write('SISSEGPEREXISTE',true);
					//PERSONAS ASOCIADAS A GRUPO SOCIALES
					$this->Persxgrupsociale->unbindModel(
							array('belongsTo' => array('Grupsociale')));
					$persxgrupsociales = $this->Persxgrupsociale->find('all',array('conditions'=>array('Persxgrupsociale.persona_id'=>$persona['Persona']['id']),
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
					
					
					
					
					//PARENTESTOS ASOCIADOS TABLA FUERA DE AMBITO SE ESPERA NUEVA ESTRUCTURA											
					//$persxparentescos = $this->Persxparentesco->find('all',array('conditions'=>array('Persxparentesco.persona_id'=>$persona['Persona']['id'])));
					//DOMICILIOS CARGADOS
					$i=0;
					$j=0;
					//Cargo Domicilios y personas
					foreach($persxgrupsociales as $persxgrupsociale){
						$this->Grupsocxdomi->unbindModel(array('belongsTo'=>array('Domicilio')));
						$domicilio = $this->Grupsocxdomi->find('all',array('conditions'=>array('Grupsocxdomi.grupsociale_id'=>$persxgrupsociale['Grupsociale']['id']),
																				'joins'=>array(array('table'=>'domicilios',
																											'alias'=>'Domicilio',
																											'type'=>'LEFT',
																											'conditions'=>array('Domicilio.id = Grupsocxdomi.domicilio_id')),
																								array('table'=>'calles',
																											'alias'=>'Calle',
																											'type'=>'LEFT',
																											'conditions'=>array('Calle.id = Domicilio.calle_id'))),
																				'fields'=>array('Grupsocxdomi.id','Domicilio.nro','Domicilio.id','Calle.descrip')));
						if(!empty($domicilio)){
							$domicilios[$i]=$domicilio;
							$domicilios[$i]['Afinidade']['descrip'] =  $persxgrupsociale['Afinidade']['descrip'];	
							$domicilios[$i]['Grupsociale']['id'] =  $persxgrupsociale['Grupsociale']['id'];	
							$i++;
						}
						//Personas asociadas al grupo social
						$personasgruposocial = $this->Persxgrupsociale->find('all',array('conditions'=>array('Persxgrupsociale.grupsociale_id'=>$persxgrupsociale['Grupsociale']['id'])));
						if(!empty($personasgruposocial)){
							$gruposocialpersonas[$j]= $personasgruposocial;
						}
						
						$gruposocialpersonas[$j]['Afinidade']['descrip'] =  $persxgrupsociale['Afinidade']['descrip'];	
						$gruposocialpersonas[$j]['Grupsociale']['id'] =  $persxgrupsociale['Grupsociale']['id'];	
						$j++;

					}

					//vinculos personas
					$vinculopers = $this->Vinculoper->find('all',array('conditions'=>array('Vinculoper.personaizq_id'=>$persona['Persona']['id']),
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
							)));
					//COORDENADAS GPS
					$coordsxpersonas = $this->Coordsxpersona->find('all',array('conditions'=>array('Coordsxpersona.persona_id'=>$persona['Persona']['id'])));
					$this->set(compact('persona','persxgrupsociales','persxparentescos','coordsxpersonas','domicilios','gruposocialpersonas','vinculopers'));
				}
			}
		}
	
	}

	/**
	 * personaexiste method Ventana para validar existencia de persona
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function personaexiste(){
		$this->set('title_for_layout','Entorno Social de Personas');
		
	}

	/**
	 * getpersona method recupera los datos de una persona por medio de un XML
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function getpersona(){
		$this->layout='';
		$persona=array();
		if(!empty($this->request->data)){
			if(empty($this->request->data['Persona']['id']) || $this->request->data['Persona']['id'] == 0 || $this->request->data['Persona']['id']==''){
				$ls_filtro = "";
				$this->request->data['Persona']['nrodoc'] = str_replace('.', '', $this->request->data['Persona']['nrodoc']);
				if(!empty($this->request->data['Persona']['nrodoc'])){
					$tipdocxper = $this->Tipdocxper->find('first',array('conditions'=>array('Tipdocxper.nrodoc'=>$this->request->data['Persona']['nrodoc'])));
					if(!empty($tipdocxper) && $this->request->data['Persona']['nrodoc'] != 0){
						$ls_filtro = $ls_filtro.' Persona.id = '.$tipdocxper['Tipdocxper']['persona_id'];
					}else
						$ls_filtro = '';
				}
				
				if($ls_filtro != ''){
					if(!empty($this->request->data['Persona']['apellido'])){
						$ls_filtro = $ls_filtro." AND Upper(Persona.apellido)  like Upper('%".$this->request->data['Persona']['apellido']."%')";
					}
					if(!empty($this->request->data['Persona']['nombre'])){
						$ls_filtro = $ls_filtro." AND Upper(Persona.nombre)  like Upper('%".$this->request->data['Persona']['nombre']."%')";
					}
					
					$this->Persona->unbindModel(
							array('hasMany' => array('Tipdocxper'))
					);		
				}
			}else{
				$ls_filtro = 'Persona.id ='.$this->request->data['Persona']['id'];
			}
			$personas=array();
			if(!empty($ls_filtro)){
				$personas = $this->Persona->find('all',array('conditions'=>$ls_filtro,
						'fields'=>array('Persona.id','Persona.email','Persona.apellido','Persona.nombre','Persona.fnac','Persona.sexo','Persona.created'),
				));
			}
		}
		$this->set(compact('personas'));
	}
	
	public function getperdoc($nrodoc = null){
		$this->layout='';
		$persona=null;
		$nrodoc=str_replace('.', '', $nrodoc);
		if(!empty($nrodoc)){
			
			$this->Persona->unbindModel(
				array('hasMany' => array('Tipdocxper'))
			);				
			$persona = $this->Persona->find('first',array(
						'conditions'=>array('Tipdocxper.nrodoc' => $nrodoc),
						'fields'=>array('Persona.id','Persona.email','Persona.apellido','Persona.nombre',
										'Persona.fnac','Persona.sexo','Persona.created','Persona.estcivile_id','Tipdocxper.nrodoc',
										'(SELECT COUNT(*) FROM "users" AS "User" WHERE "User"."persona_id"="Persona"."id") AS Persona__cper'),
						'joins'=>array(array('table'=>'tipdocxpers',
								'alias'=>'Tipdocxper',
								'type'=>'LEFT',
								'conditions'=>array('Tipdocxper.persona_id = Persona.id','Tipdocxper.nrodoc'=>$nrodoc)))));
		}
		$this->set(compact('persona'));
	}
	
	public function seguimientopersonas(){
		$this->layout='';
		$seguimiento=array();
		if(!empty($this->request->data['Asigper'])){
			$personas = $this->request->data['Asigper'];
			$i=0;
			foreach($personas as $persona){
				$domicilios=array();
				$persxgrupsociales=array();
				$gruposocialpersonas=array();
				$vinculopers=array();
				$archivo=array();				
				//RECUPERAMOS LOS DATOS DE LA PERSONA
				$personadetalle = $this->Persona->find('first',array('conditions'=>array('Persona.id'=>$persona['persona_id']),
						'fields'=>array('Persona.id','Persona.email','Persona.apellido','Persona.nombre','Persona.fnac','Persona.sexo','Persona.created'),
						'joins'=>array(array('table'=>'tipdocxpers',
								'alias'=>'Tipdocxper',
								'type'=>'LEFT',
								'conditions'=>array('Tipdocxper.persona_id = Persona.id')))));
				
				//PERSONAS ASOCIADAS A GRUPO SOCIALES
				$this->Persxgrupsociale->unbindModel(
						array('belongsTo' => array('Grupsociale')));
				$persxgrupsociales = $this->Persxgrupsociale->find('all',array('conditions'=>array('Persxgrupsociale.persona_id'=>$persona['persona_id']),
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
				//Cargo Domicilios de las personas y sus grupos sociales
				$j=0;
				foreach($persxgrupsociales as $persxgrupsociale){
					$this->Grupsocxdomi->unbindModel(array('belongsTo'=>array('Domicilio')));
					$domicilio = $this->Grupsocxdomi->find('all',array('conditions'=>array('Grupsocxdomi.grupsociale_id'=>$persxgrupsociale['Grupsociale']['id']),
							'joins'=>array(array('table'=>'domicilios',
									'alias'=>'Domicilio',
									'type'=>'LEFT',
									'conditions'=>array('Domicilio.id = Grupsocxdomi.domicilio_id')),
									array('table'=>'calles',
											'alias'=>'Calle',
											'type'=>'LEFT',
											'conditions'=>array('Calle.id = Domicilio.calle_id'))),
							'fields'=>array('Grupsocxdomi.id','Domicilio.nro','Domicilio.id','Calle.descrip')));
					if(!empty($domicilio)){
						$domicilios[$i]=$domicilio;
						$domicilios[$i]['Afinidade']['descrip'] =  $persxgrupsociale['Afinidade']['descrip'];
						$domicilios[$i]['Grupsociale']['id'] =  $persxgrupsociale['Grupsociale']['id'];
						$i++;
					}
					//Personas asociadas al grupo social
					$personasgruposocial = $this->Persxgrupsociale->find('all',array('conditions'=>array('Persxgrupsociale.grupsociale_id'=>$persxgrupsociale['Grupsociale']['id'])));
					if(!empty($personasgruposocial)){
						$gruposocialpersonas[$j]= $personasgruposocial;
					}
				
					$gruposocialpersonas[$j]['Afinidade']['descrip'] =  $persxgrupsociale['Afinidade']['descrip'];
					$gruposocialpersonas[$j]['Grupsociale']['id'] =  $persxgrupsociale['Grupsociale']['id'];
					$j++;
				}
				//vinculos personas
				$vinculopers = $this->Vinculoper->find('all',array('conditions'=>array('Vinculoper.personaizq_id'=>$persona['persona_id']),
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
						)));
				//Obtenemos la imagen de la persona si existe en la Db
				
				$archivo = $this->Archivo->getfotopersonal($persona['persona_id']);
				if(!empty($archivo)){
					$seguimiento[$i]['archivo']=$archivo;				
				}				
				$seguimiento[$i]['persona']=$personadetalle;
				$seguimiento[$i]['gruposociale']=$persxgrupsociales;
				$seguimiento[$i]['domicilios']=$domicilios;
				$seguimiento[$i]['gruposocialpersona']=$gruposocialpersonas;
				$seguimiento[$i]['vinculos']=$vinculopers;
				$i++;
			}
		}
		$this->set(compact('seguimiento'));
	}
	
}

