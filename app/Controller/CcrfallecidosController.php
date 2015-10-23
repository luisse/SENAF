<?php
App::uses('AppController', 'Controller');
/**
 * ccrfallecidos Controller
 *
 * @property Ccrfallecido $Ccrfallecido
 * @property PaginatorComponent $Paginator
 */
class CcrfallecidosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses 		= array('Ccrfallecido','Ccrcabfallec');
	public $components 	= array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
        $this->set('title_for_layout',__('Listado de Fallecidos Cargados'));

		$this->set('ccrfallecidos', $this->Paginator->paginate());
	}
	
	public function listccrfallecidos(){
		$this->layout='';
		$this->Ccrfallecido->recursive = 0;
 		$ls_filtro =' 1=1 ';
 		$filtrosfecha='';
		if(!empty($this->request->data)){
			if(!empty($this->request->data['Persona']['fecdesde']) && !empty($this->request->data['Persona']['fechasta'])){
				App::uses('CakeTime', 'Utility');
				$filtrosfecha = CakeTime::daysAsSql($this->Ccrfallecido->formatDate($this->request->data['Persona']['fecdesde']),
																			$this->Ccrfallecido->formatDate($this->request->data['Persona']['fechasta']),
																			'fconfserv');
			}
			
			
			$this->request->data['Persona']['nrodoc'] = str_replace('.', '', $this->request->data['Persona']['nrodoc']);
			if(!empty($this->request->data['Persona']['nrodoc'])){
				$ls_filtro = "Ccrfallecido.dnifall like('%".$this->request->data['Persona']['nrodoc']."%')";
			}
			if(!empty($this->request->data['Persona']['apellido'])){
				$ls_filtro = "Upper(Ccrfallecido.fallecido)  like Upper('%".$this->request->data['Persona']['apellido']."%')";
			}
			if(!empty($this->request->data['Persona']['nombre'])){
				$ls_filtro = "Upper(Ccrfallecido.fallecido)  like Upper('%".$this->request->data['Persona']['nombre']."%')";
			}			
		}
		
		$ls_filtronotexist=' 1=1 ';	
		$ls_notexist = '';
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('fallecido'=>'asc'),
							'conditions'=>array($ls_filtro,$filtrosfecha,'ccrcodregfallec_id = 1'),
							'fields'=>array('Ccrfallecido.id','Ccrfallecido.idservicio','Ccrfallecido.fconfserv','Ccrfallecido.dnifall',
											'Ccrfallecido.fallecido','Ccrfallecido.domicfall','Ccrfallecido.localdptofall',
											'Ccrfallecido.solicitante','Ccrfallecido.dnisolic','Ccrfallecido.operador',
											'Ccrfallecido.empresa','Ccrfallecido.observ'),
							/***'joins'=>array(array('table'=>'personas',
															'alias'=>'Persona',
															'type'=>'LEFT',
															'conditions'=>array('Persona.id = User.persona_id')),
											array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Tipdocxper.persona_id = User.persona_id'))
			)***/);				
			$this->set('ccrfallecidos', $this->paginate());	
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ccrfallecido->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$options = array('conditions' => array('Ccrfallecido.' . $this->Ccrfallecido->primaryKey => $id));
		$this->set('Ccrfallecido', $this->Ccrfallecido->find('first', $options));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Ccrfallecido->id = $id;
		if (!$this->Ccrfallecido->exists()) {
			throw new NotFoundException(__('Invalid Ccrfallecido'));
		}
		try {
			if ($this->Ccrfallecido->delete()) {
				$this->Session->setFlash(__('El Registro fue eliminado.'));
			} else {
				$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
				$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}			
		return $this->redirect(array('action' => 'index'));
	}

/**
 * cargarsubtypeprodcvs method permite cargar los subtypos de productos desde un CVS
 *
 * @return void
 */	
	public function cargarsepelioscvs(){
		$this->set('title_for_layout',__('Carga Masiva de Cepelios',true));
		if(!empty($this->request->data)){
			//validamos que el archivo sea del tipo string
			if(strstr($this->request->data['Ccrfallecido']['File']['type'],'application/octet-stream') ||
			strstr($this->request->data['Ccrfallecido']['File']['type'],'text/csv') || 1==1/*ALL*/){
				//cargamos el parseado de archivos CVS
				App::import("Vendor","parsecsv");
				//nuevo objeto cvs
				$cvs = new parseCSV();
				$cvs->auto($this->request->data['Ccrfallecido']['File']['tmp_name']);
				
				if(!empty($cvs->data)){
					
					//validamos si algún dato existe lo marcamos como malo
					$count = 0;
					$i = 0;
					$existe=0;
					$ccrfallecidos=array();
					$ccrfallecidostodos=array();
					$agregados=0;
					$conerror=0;
					$col_error='';
					foreach ($cvs->data as $datas){
						$ccrfallecidores = $this->Ccrfallecido->find('first',
										array('conditions'=>
												array('Ccrfallecido.idservicio'=>$datas['Ord.']),
												'order'=>array('Ccrfallecido DESC')));
						if(!empty($ccrfallecidores))
							$existe = 1;
						else
							$existe = 0;
							
						/*Validamos que existan los detalles de la cabecera de lo contrario no se procesa el archivo*/
						if(!array_key_exists('Ord.',$datas))
							$col_error='Ord. - Id de Servicio';
						if(!array_key_exists('Documento',$datas))
							$col_error='Documento';
						if(!array_key_exists('DocumentoSol',$datas))
							$col_error='DocumentoSol';
						if(!array_key_exists('Domicilio',$datas))
							$col_error='Domicilio';
						if(!array_key_exists('Localidad',$datas))
							$col_error='Localidad';
						if(!array_key_exists('Solicitado por',$datas))
							$col_error='Solicitado por - Solicitado por';
						if(!array_key_exists('Operador',$datas))
							$col_error='Operador - Operador';
						if(!array_key_exists('Empresa',$datas))
							$col_error='Empresa - Empresa';
						if(!array_key_exists('OBSERVACIONES',$datas))
							$col_error='OBSERVACIONES - OBSERVACIONES';
						//si hay un error salimos y no procesamos los datos
						if(!empty($col_error)){
							$this->Session->setFlash(__('Error en Procesamiento de Archivo. No se encontro el nombre de columna ('.$col_error.'). Valide que el nombre existe en la cabecera del archivo'));
							break;
						}	
							
							
						/*Creamos un array con los datos a guardar*/							
						$dnifall=str_replace('.', '', trim($datas['Documento']));
						if(!is_numeric($dnifall)) $dnifall = 0;
						
													
						
						$dnisol=str_replace('.', '', trim($datas['DocumentoSol']));
						if(!is_numeric($dnisol)) $dnisol =0;
						
						//Recuperamos la fecha y la hora
						$fechahora = split('-', $datas['Fecha']);
						$hora		= split(':',$fechahora[1]);
						
						$ccrfallecido=array();
						$ccrfallecido['Ccrfallecido']['idservicio']	=	$datas['Ord.'];
						if(!empty($fechahora[0]))
							$ccrfallecido['Ccrfallecido']['fconfserv']	=	$fechahora[0];
						if(!empty($hora[0]))	
							$ccrfallecido['Ccrfallecido']['hconfserv']	=	'01/01/1900 '.$hora[0].':'.$hora[1];
						else 
							$ccrfallecido['Ccrfallecido']['hconfserv']='';
						if(trim($datas['Fallecido'])==''){
							$datas['Fallecido']='NN';
						}
							
						$ccrfallecido['Ccrfallecido']['fallecido']			=	$datas['Fallecido'];
						$ccrfallecido['Ccrfallecido']['dnifall']			=	$dnifall;
						$ccrfallecido['Ccrfallecido']['domicfall']			=	$datas['Domicilio'];
						$ccrfallecido['Ccrfallecido']['localdptofall']		=	$datas['Localidad'];
						$ccrfallecido['Ccrfallecido']['solicitante']		=	$datas['Solicitado por'];
						$ccrfallecido['Ccrfallecido']['dnisolic']			=	$dnisol;
						$ccrfallecido['Ccrfallecido']['operador']			=	$datas['Operador']; 
						$ccrfallecido['Ccrfallecido']['empresa']			=	$datas['Empresa'];
						$ccrfallecido['Ccrfallecido']['observ']				=	$datas['OBSERVACIONES'];
						$ccrfallecido['Ccrfallecido']['existe']				=	$existe;
						$ccrfallecido['Ccrfallecido']['ccrcodregfallec_id'] = 1;//cargado sin errores
						$ccrfallecido['Ccrfallecido']['usuariocrea']		= $this->Session->read('username');
						$ccrfallecido['Ccrfallecido']['ipcrea']				= $this->request->clientIp();
						
						$distinct=0;
						if(!empty($ccrfallecidores)){
							if(($this->Ccrfallecido->formatDate($ccrfallecido['Ccrfallecido']['fconfserv']) !=  $ccrfallecidores['Ccrfallecido']['fconfserv']) ||
								($ccrfallecido['Ccrfallecido']['idservicio']    != 	$ccrfallecidores['Ccrfallecido']['idservicio']) ||
								($ccrfallecido['Ccrfallecido']['fallecido']	  	!=	$ccrfallecidores['Ccrfallecido']['fallecido']) ||
								($ccrfallecido['Ccrfallecido']['dnifall']		!=	$ccrfallecidores['Ccrfallecido']['dnifall']) ||
								($ccrfallecido['Ccrfallecido']['domicfall']	  	!=	$ccrfallecidores['Ccrfallecido']['domicfall']) ||
								($ccrfallecido['Ccrfallecido']['localdptofall'] !=	$ccrfallecidores['Ccrfallecido']['localdptofall']) ||
								($ccrfallecido['Ccrfallecido']['solicitante']	!=	$ccrfallecidores['Ccrfallecido']['solicitante']) ||
								($ccrfallecido['Ccrfallecido']['dnisolic']	  	!=	$ccrfallecidores['Ccrfallecido']['dnisolic']) ||
								($ccrfallecido['Ccrfallecido']['operador']	  	!=	$ccrfallecidores['Ccrfallecido']['operador']) || 
								($ccrfallecido['Ccrfallecido']['empresa']		!=	$ccrfallecidores['Ccrfallecido']['empresa']) ||
								($ccrfallecido['Ccrfallecido']['observ']		!=	$ccrfallecidores['Ccrfallecido']['observ'])){
									$distinct=1;
									$conerror++;
								}
						}
						//or$distinct=1;
						$ccrfallecido['Ccrfallecido']['distinct']	=	$distinct;	
						if($existe == 1){
							$ccrfallecido['Ccrfallecido']['db']=$ccrfallecidores;
						}
						$ccrfallecidostodos[$i]=$ccrfallecido;
						$i++;
					}
					//Datos del archivo cabecera
					$this->request->data['Ccrcabfallec']['nombarch']=$this->request->data['Ccrfallecido']['File']['name'];
					$this->request->data['Ccrcabfallec']['cantreg']	=$i;
					$this->request->data['Ccrcabfallec']['usuariocrea']=strtolower ($this->Session->read('username'));;
					$this->request->data['Ccrcabfallec']['ipcrea'] 	= $this->request->clientIp();
					//verificamos is existe un valor igual en la DB para el archivo y cabecera no procesamos el archivo
					$ccrcabfallecs=$this->Ccrcabfallec->find('first',array('conditions'=>array('Ccrcabfallec.nombarch'=>$this->request->data['Ccrfallecido']['File']['name'],
																				'Ccrcabfallec.cantreg'=>$i)));
					//Fin datos cabecera
					$this->set(compact('ccrcabfallecs'));					
					$this->set('ccrcabfallec',$this->request->data['Ccrcabfallec']);
					$this->set('agregados',$agregados);
					$this->set('totalregistros',$i);
					$this->set('conerror',$conerror);
					$this->set('col_error',$col_error);
					$this->set(compact('ccrfallecidostodos'));
				}					
			}else{
				$this->set('error','El archivo ingresado no es válido. El formato debe ser un archivo tipo CVS. Formato Actual: '.$this->request->data['Ccrfallecido']['File']['type']);
			}
			
		}	
	}

/**
 * procesarcvs permite procesar los datos recuperados desde CVS
 *
 * @return void
 */		
	public function procesarcvs(){
		$this->set('title_for_layout',__('Carga Masiva de Cepelios',true));
		if(empty($this->request->data)){
			$data=$this->Session->read('arrayprocesar');
			$this->set('data',$data);
			if(!empty($data)){
				//validamos si algún dato existe lo marcamos como malo
				$count = 0;
				$i = 0;
				foreach ($data as $datas){
					$count = $this->Ccrfallecido->find('count',
									array('conditions'=>
											array('Ccrfallecido.idservicio'=>$datas['Ord.'])));
					if($count > 0)
						$data[$i]['existe'] = 1;
					else
						$data[$i]['existe'] = 0;
					$i++;
				}
				$this->set('data',$data);
			}
		}else{
			//guardamos las filas que no contienen ningún tipo de error
			foreach ($this->data as $datas){
				//contador para recorrer el array
				$i = 0;
				$filas = count($datas);
				for($i = 0;$i < $filas;$i++){
					//si existe en la DB no debe ser insertado de nuevo
					if($datas[$i]['existe'] == 1){
						unset($datas[$i]);
					}else{
						unset($datas[$i]['existe']);
					}
				}
			}
		}
	}
	
	public function beforeRender(){
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
	
	public function guardarccrfallecidos(){
		$i=0;
		$ccrfallecidos=$this->request->data['Ccrfallecido'];
		$ccrfallecidos_up=array();
		foreach($ccrfallecidos as $ccrfallecido){
			if(!empty($ccrfallecido['guardar'])){
				if($ccrfallecido['guardar'] == 0){
					$ccrfallecidos[$i]['ccrcodregfallec_id']=1;
					$ccrcodregfallec_id=2;
				}else{
					$ccrfallecidos[$i]['ccrcodregfallec_id']=2;
					$ccrcodregfallec_id=1;
				}
			}else{
				$ccrfallecidos[$i]['ccrcodregfallec_id']=1;
				$ccrcodregfallec_id=2;
			}	
				//datos a actualizar con nuevo valor
				if(!empty($ccrfallecido['id'])){
					$ccrfallecidos_up['Ccrfallecido'][$i]['id']=$ccrfallecido['id'];
					$ccrfallecidos_up['Ccrfallecido'][$i]['ccrcodregfallec_id']=$ccrcodregfallec_id;
					unset($ccrfallecidos[$i]['id']);
				}
				$i++;
		}
		//create headers
		$cabecera['Ccrcabfallec']=$this->request->data['Ccrcabfallec'];
		if($this->Ccrfallecido->saveallccrfallecidos($ccrfallecidos,$ccrfallecidos_up,$cabecera)){
			return $this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash(__('No se pudieron guardar los datos en la base de datos.'));
			return $this->redirect(array('action'=>'index'));
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
