<?php
App::uses('AppController', 'Controller');
App::import('Vendor','ValumsFileUploader');
//App::import('Vendor','UploadHandler');

/**
 * Archivos Controller
 *
 * @property Archivo $Archivo
 * @property PaginatorComponent $Paginator
 */
class ArchivosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Uploadfile');
	public $uses = array('Archivo','Persona','Tiparchivo','Archxpersona');
/**
 * index method
 *
 * @return void
 */
	public function index($persona_id=null) {
		$this->set('title_for_layout',__('Arhivos vinculados'));
		if(!empty($persona_id)){
			$this->Session->write('archivo_persona_id',$persona_id);
			$persona=$this->Persona->find('first',array('conditions'=>array('Persona.id'=>$persona_id)));

			$this->Session->write('det_persona',$persona);
		}

		$tiparchivo = $this->Tiparchivo->find('first',array('conditions'=>array('Tiparchivo.descrip'=>'FOTO PERSONAL')));
		if(!empty($tiparchivo)){
			$archivoimagen=$this->Archivo->find('first',array('conditions'=>array('Archxpersona.persona_id'=>$this->Session->read('archivo_persona_id'),'Archivo.tiparchivo_id'=>$tiparchivo['Tiparchivo']['id']),
					'order'=>array('Archivo.created DESC'),
					'joins'=>array(array('table'=>'archxpersonas',
							'alias'=>'Archxpersona',
							'type'=>'LEFT',
							'conditions'=>array('Archxpersona.archivo_id = Archivo.id')
					))));
		}

		$this->set('persona',$this->Session->read('det_persona'));
		$tiparchivos = $this->Archivo->Tiparchivo->find('list',array('fields'=>array('Tiparchivo.id','Tiparchivo.descrip')));
		$tiparchivos[0]='Todos';
		$this->set(compact('tiparchivos','archivoimagen'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Archivo->exists($id)) {
			throw new NotFoundException(__('Invalid archivo'));
		}
		$options = array('conditions' => array('Archivo.' . $this->Archivo->primaryKey => $id));
		$this->set('archivo', $this->Archivo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout',__('Subir Archivos'));
		if ($this->request->is('post')) {
			$this->Archivo->create();
			$this->request->data['Archivo']['usuariocrea']	= $this->Session->read('username');
			$this->request->data['Archivo']['ipcrea']				= $this->request->clientIp();
			$this->request->data['Archivo']['persona_id']		= $this->Session->read('archivo_persona_id');
			$this->request->data['Archivo']['usuarioactu']	= $this->Session->read('username');
			$this->request->data['Archivo']['ipactu']				= $this->request->clientIp();

			$tipoarchivo = $this->Tiparchivo->find('first',array('conditions'=>array('Tiparchivo.extension'=>$this->request->data['Archivo']['archivo']['type'])));
			if(!empty($tipoarchivo)){
				$this->request->data['Archivo']['tiparchivo_id']=$tipoarchivo['Tiparchivo']['id'];
			}else{
				$this->Session->setFlash(__('No se pueden subir archivos de la extensión seleccionada'));
			}
			$this->Archivo->set($this->request->data);
			if(!empty($this->request->data['Archivo']['archivo'])){

				if($this->request->data['Archivo']['archivo']['size'] > 2097152 || $this->request->data['Archivo']['archivo']['error'] == 1){
					$this->Session->setFlash(__('El archivo debe contener menos de 2MB'));
					return;
				}
			}
			$validaArchivo = true;
			if($validaArchivo){
				if ($this->Archivo->guardarArchivo($this->request->data)) {
					$this->Session->setFlash(__('El Registro fue Guardado.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$archivosval = $this->Archivo->invalidFields();
					if(!empty($archivosval['archivo'][0])){

						$this->Session->setFlash($archivosval['archivo'][0]);
					}else{
						$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
					}
				}
			}else{

				$archivosval = $this->Archivo->invalidFields();
				if(!empty($archivosval))
					$this->Session->setFlash(__($archivosval['archivoget'][0]));
				else
					$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
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
		$this->set('title_for_layout',__('Actualizar Archivos'));
		if (!$this->Archivo->exists($id)) {
			throw new NotFoundException(__('Invalido archivo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Archivo->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro Fue Actualizado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo actualizar el registro. Por favor intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Archivo.' . $this->Archivo->primaryKey => $id));
			$this->request->data = $this->Archivo->find('first', $options);
		}
		$tiparchivos = $this->Archivo->Tiparchivo->find('list');
		$this->set(compact('tiparchivos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Archivo->id = $id;
		if (!$this->Archivo->exists()) {
			throw new NotFoundException(__('Invalid archivo'));
		}
		try {
			if($this->Archxpersona->deleteAll(array('Archxpersona.persona_id'=>$this->Session->read('archivo_persona_id'),
												'Archxpersona.archivo_id'=>$id))){
					if ($this->Archivo->delete()) {
						$this->Session->setFlash(__('El Registro fue eliminado.'));
					} else {
						$this->Session->setFlash(__('No se pudo borrar el registro. Por favor intente de nuevo.'));
					}
			}else{
				$this->Session->setFlash(__('No se pudo borrar el registro de asociación. Por favor intente de nuevo.'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * verarchivo permite visualizar un archivo
 *
 * @throws NotFoundException
 * @param integer $id
 * @return void
 */
		public function verarchivo($id = null){
		if(!empty($id)){
			$archivo = $this->Archivo->find('first',array('conditions'=>array('Archivo.id'=>$id)));
			if(!empty($archivo)){
				$this->set('title_for_layout',$archivo['Archivo']['descrip']);
				$cfile = new UploadfileComponent(new ComponentCollection());
				$cfile->viewfile(base64_decode($archivo['Archivo']['archivo']), $archivo['Tiparchivo']['extension']);
				exit;
			}
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
	 * listararchivo permite visualizar los archivos asociados a una persona
	 *
	 * @throws NotFoundException
	 * @param post tipoarchivo(filtro para el tipo de archivo)
	 * @return void
	 */

	public function listarchivos(){
		$this->layout='';
		$ls_filtro='1 = 1 ';
		if(!empty($this->request->data)){
			if(!empty($this->request->data['Archivo']['tiparchivo_id']) &&
					$this->request->data['Archivo']['tiparchivo_id'] != '')
				$ls_filtro = $ls_filtro.' AND Archivo.tiparchivo_id ='.$this->request->data['Archivo']['tiparchivo_id'];
			if(!empty($this->request->data['Archivo']['descrip']) &&
					$this->request->data['Archivo']['descrip'] != '')
				$ls_filtro = $ls_filtro." AND Upper(Archivo.descrip)  like Upper('%".$this->request->data['Archivo']['descrip']."%')";
		}

		$persona_id = $this->Session->read('archivo_persona_id');
		$this->paginate=array('limit' => 10,
				'page' => 1,
				'fields'=>array('Tiparchivo.descrip','Archivo.id','Archivo.descrip','Archivo.usuariocrea','Archivo.created'),
				'conditions'=>array('Archxpersona.persona_id'=>$persona_id,$ls_filtro),
				'joins'=>array(array('table'=>'archxpersonas',
						'alias'=>'Archxpersona',
						'type'=>'LEFT',
						'conditions'=>array('Archxpersona.archivo_id = Archivo.id'))),
				'order'=>array('Oficina.descrip'=>'asc'),
		);

		$this->Archivo->recursive = 0;
		$this->set('archivos', $this->Paginator->paginate());
	}

	/**
	 * tomarfotopersona permite tomar una foto personal de la persona
	 *
	 * @throws NotFoundException
	 * @param post tipoarchivo(filtro para el tipo de archivo)
	 * @return void
	 */
	public function tomarfotopersona($persona_id = null){
		$this->set('title_for_layout',__('Capturar Foto Personal'));
		if ($this->request->is('post')) {
			$this->Archivo->create();

			$tiparchivo = $this->Tiparchivo->find('first',array('conditions'=>array('Tiparchivo.descrip'=>'FOTO PERSONAL')));
			if(!empty($tiparchivo)){
				$this->request->data['Archivo']['tiparchivo_id']=$tiparchivo['Tiparchivo']['id'];
			}
			$this->request->data['Archivo']['usuariocrea']=$this->Session->read('username');
			$this->request->data['Archivo']['ipcrea']=$this->request->clientIp();
			$this->request->data['Archivo']['persona_id']=$this->Session->read('archivo_persona_id');
			$this->request->data['Archivo']['descgeneral']='FOTO PERSONAL';
			$this->request->data['Archivo']['descrip']='FOTO PERSONAL';
			//$this->request->data['Archivo']['archivo']=$data['Archivo']['archivo'];
			$this->Archivo->validator()->remove('archivo');
			if ($this->Archivo->guardarArchivo($this->request->data)) {
				$this->Session->setFlash(__('El Registro fue Guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$archivosval = $this->Archivo->invalidFields();
				if(!empty($archivosval['archivo'][0])){
					$this->Session->setFlash($archivosval['archivo'][0]);
				}else{
					$this->Session->setFlash(__('No se pudo Guardar el Registro. Por Favor Intente de Nuevo.'));
				}
			}
		}

		if(!empty($persona_id)){
			$this->Session->write('archivo_persona_id',$persona_id);
			$persona=$this->Persona->find('first',array('conditions'=>array('Persona.id'=>$persona_id)));

			$this->Session->write('det_persona',$persona);
		}

		$tiparchivo = $this->Tiparchivo->find('first',array('conditions'=>array('Tiparchivo.descrip'=>'FOTO PERSONAL')));
		if(!empty($tiparchivo)){
			$archivoimagen=$this->Archivo->find('first',array('conditions'=>array('Archxpersona.persona_id'=>$persona_id,'Archivo.tiparchivo_id'=>$tiparchivo['Tiparchivo']['id']),
					'order'=>array('Archivo.created DESC'),
					'joins'=>array(array('table'=>'archxpersonas',
							'alias'=>'Archxpersona',
							'type'=>'LEFT',
							'conditions'=>array('Archxpersona.archivo_id = Archivo.id')
					))));
		}

		$this->set('persona',$this->Session->read('det_persona'));
		$this->set(compact('archivoimagen'));
	}

	public function fileupload(){
		$filesload=array();
		$this->Session->write('filesload',$filesload);
	}

	public function addfileupload(){
		$this->layout='';
		$path               = "files/";
		$allowedExtensions  = array("jpg","jpeg", "png","pdf");
		$sizeLimit          = 10 * 1024 * 1024;

		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($path);
		$filesload=$this->Session->read('filesload');
		$index = count($filesload) + 1;
		$filesload[$index] = $result['file'];
		$this->Session->write('filesload',$filesload);
		echo json_encode($result);
		$this->render('addfileupload','ajax');
	}

	public function beforeRender(){
			/**$aclseguridad = $this->session->read('aclseguridad');
			if(!empty($aclseguridad)){
				if(!empty($aclseguridad[ucfirst($this->params['controller'])][$this->params['action']])){
					if(!$aclseguridad[ucfirst($this->params['controller'])][$this->params['action']]){
						$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
						return;
					}else{
						return;
					}
				}
			}***/

			try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
					), ucfirst($this->params['controller']).'/'.$this->params['action']);
				$aclseguridad[ucfirst($this->params['controller'])][$this->params['action']]=$result;
				$this->Session->write('aclseguridad',$aclseguridad);
	        	if(!$result)
	        		$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror','Users-'.$this->params['action']));
			}catch(Exeption $e){

			}
	}

}
