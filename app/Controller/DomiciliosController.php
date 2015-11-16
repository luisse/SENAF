<?php
App::uses('AppController', 'Controller');
/**
 * Domicilios Controller
 *
 * @property Domicilio $Domicilio
 * @property PaginatorComponent $Paginator
 */
class DomiciliosController extends AppController {
	public $uses=array('Domicilio','Paise','Barrio','Provincia','Depto',
					'Municipio','Localidade','Calle','Grupsocxdomi',
					'Deptoxprovincia','Munixdepto','Localxmunicipio','Provxpaise','Coordsxdomicilio','Coord');
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
		$this->Domicilio->recursive = 0;
		$this->set('domicilios', $this->Paginator->paginate());
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
		$options = array('conditions' => array('Domicilio.' . $this->Domicilio->primaryKey => $id));
		$this->set('domicilio', $this->Domicilio->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($grupsociale_id = null) {
		if ($this->request->is('post')) {
			$this->Domicilio->create();
			$calle = $this->request->data['Domicilio']['callenombre'];
			$this->request->data['Domicilio']['calle_id']= $this->Calle->retornaidcalle($calle);
			$this->request->data['Domicilio']['usuariocrea'] = $this->Session->read('username');
			$this->request->data['Domicilio']['ipcrea']=$this->request->clientIp();
			$this->request->data['Domicilio']['usuarioactu'] = $this->Session->read('username');
			$this->request->data['Domicilio']['ipactu']=$this->request->clientIp();

			//recuperamos el id del departamento el verdadero
			if(!empty($this->request->data['Domicilio']['depto_id'])){
				$deptoxprovincia=$this->Deptoxprovincia->find('first',array('conditions'=>array('Deptoxprovincia.id'=>$this->request->data['Domicilio']['depto_id'])));
				$this->request->data['Domicilio']['depto_id'] = $deptoxprovincia['Deptoxprovincia']['depto_id'];
			}else{
				$this->request->data['Domicilio']['depto_id']='';
			}

			//recuperamos el id del municipio el verdadero
			if(!empty($this->request->data['Domicilio']['municipio_id'])){
				$munixdepto = $this->Munixdepto->find('first',array('conditions'=>array('Munixdepto.id'=>$this->request->data['Domicilio']['municipio_id'])));
				$this->request->data['Domicilio']['municipio_id'] = $munixdepto['Munixdepto']['municipio_id'];
			}else{
				$this->request->data['Domicilio']['municipio_id']='';
			}

			//SI TIENE GRUPO SOCIAL LO ADJUNTAMOS AL MISMO
			if($this->request->data['Domicilio']['grupsociale_id'] == '')
				$this->request->data['Domicilio']['grupsociale_id']=$this->Session->read('grupsociale_id');
			else
				$this->request->data['Domicilio']['grupsociale_id']=$this->request->data['Domicilio']['grupsociale_id'];

			if ($this->Domicilio->guardarasocgroup($this->request->data)) {
				$this->Session->setFlash(__('El domiclio fue guardado.'));
				//SOLO CUANDO ES LLAMADO EL SEGUIMIENTO DE PERSONAS
				if($this->Session->check('SISSEGPEREXISTE')){
					$existe =  $this->Session->read('SISSEGPEREXISTE');
					if($existe) return $this->redirect(array('controller'=>'personas','action' => 'sissegpersona'));
				}
				return $this->redirect(array('controller'=>'personas','action' => 'add'));
			} else {
				if(!empty($this->request->data)){
						if(!empty($this->request->data['Domicilio']['paise_id'])){
							$provincias	=$this->Provincia->retornarprovincias($this->request->data['Domicilio']['paise_id'],'list');
						}

						if(!empty($this->request->data['Domicilio']['provincia_id'])){
							$deptos 	= $this->Depto->retornardeptos($this->request->data['Domicilio']['provincia_id'],'list');
						}

						if(!empty($this->request->data['Domicilio']['depto_id'])){
							$municipios = $this->Municipio->retornarmunicipios($this->request->data['Domicilio']['depto_id'],'list');
						}

						if(!empty($this->request->data['Domicilio']['municipio_id'])){
							$localidades = $this->Localidade->retornarlocalidades($this->request->data['Domicilio']['municipio_id'],'list');
						}
						$this->set(compact('provincias','deptos','municipios','localidades'));
					}
				}
				$this->Session->setFlash(__('No se pudo guardar el Domicilio. Por favor, intente de nuevo.'));
			}
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
		if (!$this->Domicilio->exists($id)) {
			throw new NotFoundException(__('Invalid domicilio'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$calle = $this->request->data['Domicilio']['callenombre'];
			$this->request->data['Domicilio']['calle_id']= $this->Calle->retornaidcalle($calle);
			$this->request->data['Domicilio']['usuarioactu'] = $this->Session->read('username');
			$this->request->data['Domicilio']['ipactu']=$this->request->clientIp();
			//recuperamos el id del departamento el verdadero
			if(!empty($this->request->data['Domicilio']['depto_id'])){
				$deptoxprovincia=$this->Deptoxprovincia->find('first',array('conditions'=>array('Deptoxprovincia.id'=>$this->request->data['Domicilio']['depto_id'])));
				$this->request->data['Domicilio']['depto_id'] = $deptoxprovincia['Deptoxprovincia']['depto_id'];
			}else{
				$this->request->data['Domicilio']['depto_id']='';
			}

			//recuperamos el id del municipio el verdadero
			if(!empty($this->request->data['Domicilio']['municipio_id'])){
				$munixdepto = $this->Munixdepto->find('first',array('conditions'=>array('Munixdepto.id'=>$this->request->data['Domicilio']['municipio_id'])));
				$this->request->data['Domicilio']['municipio_id'] = $munixdepto['Munixdepto']['municipio_id'];
			}else{
				$this->request->data['Domicilio']['municipio_id']='';
			}

			if ($this->Domicilio->save($this->request->data)) {
				$this->Session->setFlash(__('The domicilio has been saved.'));
				return $this->redirect(array('controller'=>'personas','action' => 'sissegpersona'));
			} else {
				$this->Session->setFlash(__('The domicilio could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Domicilio.' . $this->Domicilio->primaryKey => $id));
			$this->request->data = $this->Domicilio->find('first', $options);
		}

		if(!empty($this->request->data['Depto']['id'])){
			$deptoxprovincia=$this->Deptoxprovincia->find('first',array('conditions'=>array('Deptoxprovincia.depto_id'=>$this->request->data['Depto']['id'],
																							'Deptoxprovincia.provxpaise_id'=>$this->request->data['Provincia']['id'])));
			//echo 'Dpto at: '.$this->request->data['Depto']['id'];
			$this->request->data['Depto']['id'] =$deptoxprovincia['Deptoxprovincia']['id'];
			//echo 'Depto: '.$deptoxprovincia['Deptoxprovincia']['id'];
		}

		if(!empty($this->request->data['Municipio']['id'])){
			$munixdepto = $this->Munixdepto->find('first',array('conditions'=>array('Munixdepto.municipio_id'=>$this->request->data['Municipio']['id'])));
			$this->request->data['Municipio']['id'] = $munixdepto['Munixdepto']['id'];
		}
		if(!empty($this->request->data['Localidade']['id'])){
			$localxmunicipio = $this->Localxmunicipio->find('first',array('conditions'=>array('Localxmunicipio.localidade_id'=>$this->request->data['Localidade']['id'])));
			$this->request->data['Localidade']['id'] = $localxmunicipio['Localxmunicipio']['id'];
		}
		if(!empty($this->request->data['Provincia']['id'])){
			$provxpaises=$this->Provxpaise->find('first',array('conditions'=>array('Provxpaise.provincia_id'=>$this->request->data['Provincia']['id'])));
			$this->request->data['Provincia']['id']=$provxpaises['Provxpaise']['id'];
		}

		$paises = $this->Domicilio->Paise->find('list',array('fields'=>array('Paise.id','Paise.descrip')));
		$provincias = $this->Domicilio->Provincia->retornarprovincias($this->request->data['Paise']['id'],'list');
		$deptos = $this->Domicilio->Depto->retornardeptos($this->request->data['Provincia']['id'],'list');

		$municipios = $this->Domicilio->Municipio->retornarmunicipios($this->request->data['Depto']['id'],'list');
		$localidades = $this->Domicilio->Localidade->retornarlocalidades($this->request->data['Municipio']['id'],'list');

		$barrios = $this->Domicilio->Barrio->find('list',array('fields'=>array('Barrio.id','Barrio.descrip')));
		$calles = $this->Domicilio->Calle->find('first',array('fields'=>array('Calle.id','Calle.descrip'),
												'conditions'=>array('Calle.id'=>$this->request->data['Calle']['id'])));
		//print_r($this->request->data);
		$this->set(compact('paises', 'provincias', 'deptos', 'municipios', 'localidades', 'barrios', 'calles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Domicilio->id = $id;
		if (!$this->Domicilio->exists()) {
			throw new NotFoundException(__('Invalid domicilio'));
		}
		try {
			if ($this->Domicilio->delete()) {
				$this->Session->setFlash(__('The domicilio has been deleted.'));
			} else {
				$this->Session->setFlash(__('The domicilio could not be deleted. Please, try again.'));
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
			$paises = $this->Paise->find('list',array('fields'=>array('Paise.id','Paise.descrip')));
			$barrios = $this->Barrio->find('list',array('fields'=>array('Barrio.id','Barrio.descrip')));
			$this->set(compact('paises','barrios'));
		}
		/***	try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
					), ucfirst($this->params['controller']).'/'.$this->params['action']);
				//SI NO TIENE PERMISOS DA ERROR!!!!!!
	        	if(!$result)
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror','Users-'.$this->params['action']));
			}catch(Exeption $e){

			}***/
	}

	public function beforeFilter() {
	    parent::beforeFilter();
	    // For CakePHP 2.0
	    $this->Auth->allow('*');

	    // For CakePHP 2.1 and up
	    $this->Auth->allow();
	}

	/*
	* Funcion: Permite localizar el punto dónde se encuentra un domicilio
	*/
	public function getlocalize($domicilio_id=null){
		$this->set('title_for_layout',__('Ubicacion GPS de Domiclio'));
		$coordxdomicilios=array();
		if(!empty($domicilio_id)){
			$coordxdomicilios=$this->Coordsxdomicilio->find('all',array('conditions'=>array('Coordsxdomicilio.domicilio_id'=>$domicilio_id)));
		}
		$this->set(compact('coordxdomicilios'));
		$this->set('domicilio_id',$domicilio_id);
		if(!empty($this->request->data)){
			if ($this->request->is(array('post', 'put'))) {
				$coords['Coord']['latitud']	=$this->request->data['Coord']['latitude'];
				$coords['Coord']['longitud']=$this->request->data['Coord']['longitude'];
				$coords['Coord']['fecha']	=$this->request->data['Coord']['fecha'];
				$coords['Coord']['descrip']	=$this->request->data['Coord']['descrip'];
				$coords['Coord']['domicilio_id']	=$this->request->data['Coord']['domicilio_id'];
				if(!empty($this->request->data['Coord']['id']))
					$coords['Coord']['id'] = $this->request->data['Coord']['id'];

				$result=false;
				//si existe actualiza caso contrario crea y guarda
				$this->Coord->create();
				if(!empty($coords['Coord']['id'])){
					$result = $this->Coord->save($coords);
				}else{
					$result = $this->Coord->guardarcoordom($coords);
				}
				if($result){
					$this->Session->setFlash('Punto GPS guardado satisfactoriamente');
					return $this->redirect(array('controller'=>'personas','action' => 'sissegpersona'));
				}else{
					$this->Session->setFlash('No se pudo almacenar el punto GPS');
				}
			}
		}
	}
}
