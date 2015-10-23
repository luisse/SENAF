<?php
App::uses('AuthComponent', 'Controller/Component');
class UsersController extends AppController{
	var $name = 'Users';
	var $components = array('RequestHandler','Session','Email','Paginator', 'Acl', 'Security','Cimage','Access','Getmacaddres');
	var $uses = array('User','Persona');
	var $helpers = array('Html','Form','Time','Access');
    public $actsAs = array('Acl' => array('type' => 'requester'));
	
	//Funcion principal para visualizar todos los usuarios
	function index(){
		//if(!$this->Access->check($this->params['controller'],$this->params['action'])) die('Error');
		$this->User->recursive = 0;
        $this->set('title_for_layout','Administracion Datos de Usuario');
		$this->set('tipousr',$this->Session->read('tipousr'));
	}
	
	function listusers(){
		$this->User->recursive = 0;
        $this->set('title_for_layout',__('Administración Datos de Usuario')); 
		$ls_filtro =' 1=1 ';
		//usuario administrador sin filtros puede ver todos los usuarios
		if($this->Session->read('tipousr') <> 1){
			$ls_filtro = $ls_filtro.' AND User.id = '.$this->Session->read('user_id');
		}	
		if(!empty($this->request->data)){
			$this->request->data['Persona']['nrodoc'] = str_replace('.', '', $this->request->data['Persona']['nrodoc']);
			if(!empty($this->request->data['Persona']['nrodoc'])){
				$ls_filtro = 'Tipdocxper.nrodoc = '.$this->request->data['Persona']['nrodoc'];
			}
			if(!empty($this->request->data['Persona']['apellido'])){
				$ls_filtro = "Upper(Persona.apellido)  like Upper('%".$this->request->data['Persona']['apellido']."%')";
			}
			if(!empty($this->request->data['Persona']['nombre'])){
				$ls_filtro = "Upper(Persona.nombre)  like Upper('%".$this->request->data['Persona']['nombre']."%')";
			}			
		}
		
		$ls_filtronotexist=' 1=1 ';	
		$ls_notexist = '';
		$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('username'=>'asc'),
							'conditions'=>$ls_filtro.$ls_notexist,
							'fields'=>array('User.id','User.username','Tipdocxper.tipodoc_id','Tipdocxper.nrodoc','Persona.id','Persona.email','Persona.apellido','Persona.nombre'),
							'joins'=>array(array('table'=>'personas',
															'alias'=>'Persona',
															'type'=>'LEFT',
															'conditions'=>array('Persona.id = User.persona_id')),
											array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Tipdocxper.persona_id = User.persona_id'))
			));				
			$this->set('users', $this->paginate());
	}
	
	function login2(){
		//enabled only remote consult	
	}
	/*
	*Funcion: permite realizar el login de los datos
	*/
	function login(){
		$this->layout = 'login';
		$this->set('title_for_layout','Sistema de Secretaría de estado de Niñez adolescencia y familia');
		if(!empty($this->request->data)){
			if ($this->Auth->login()) {
				$user = $this->User->validateLogin($this->request->data['User']);
				if(!empty($user) ){		
					/*NUEVO 28/10/2014 - GUARDAMOS EN SESION LAS CONFIGURACIONES DEL USUARIO*/
					
					/****$userGroup = $this->User->Group->findById($user['User']['group_id']);
					//print_r($this->_user);
					//print_r($user);
					$aro = $this->Acl->Aro->find('first', array(
							'conditions' => array(
								'Aro.model' => 'Group',
								'Aro.foreign_key' => $user['User']['group_id'],
							),
					));
					if(!empty($aro)){
						$acos = $this->Acl->Aco->children();
						foreach($acos as $aco){
							$permission = $this->Acl->Aro->Permission->find('first', array(
							'conditions' => array(
								'Permission.aro_id' => $aro['Aro']['id'],
								'Permission.aco_id' => $aco['Aco']['id'],
							),
							));
							
							if(isset($permission['Permission']['id'])){
							if ($permission['Permission']['_create'] == 1 ||
								$permission['Permission']['_read'] == 1 ||
								$permission['Permission']['_update'] == 1 ||
								$permission['Permission']['_delete'] == 1) {
									$this->Session->write(
										'Auth.Permissions.'.$permission['Aco']['alias'],
										 true
									);
									if(!empty($permission['Aco']['parent_id'])){
										$parentAco = $this->Acl->Aco->find('first', array(
											'conditions' => array(
												'id' => $permission['Aco']['parent_id']
											)	
										));
										$this->Session->write(
											'Auth.Permissions.'.$permission['Aco']['alias']
											.'.'.$parentAco['Aco']['alias'], 
											true
										);
									}
								}
							}
						}	
					}****/			
					
					/*FIN CONFIGURACIONES*/
					//Guardamos los datos de usuario y configuraciones en las sesion del usuario
					//--$result = $this->User->getUserDetails($user['User']['group_id'],$user['User']['id']);
					$this->Session->write('username',$user['User']['username']);
					$this->Session->write('user_id',$user['User']['id']);
					$this->Session->write('tipousr',$user['User']['group_id']);
					$this->Session->write('image',$user['User']['image']);
					$this->Session->write('persona_id',$user['Persona']['id']);
					$this->Session->write('nomape',$user['Persona']['apellido'].', '.$user['Persona']['nombre']);
					$this->Session->write('email',$user['Persona']['email']);

					if($user['User']['cambiarcontrasenia']==1){
						$this->redirect(array('controller'=>'users','action'=>'cambiarcontraseniauser'));
						exit();
					}
					
					
					if($user['User']['group_id'] == 2){

					}else{
						
					}
					$this->redirect(array('controller'=>'accesorapidos','action'=>'index'));
					exit();
				}else{
					$this->Session->setFlash(__('El usuario u Contraseña son incorrectos.',true));
				}			
			}else{
					$this->Session->setFlash(__('Acl: El usuario u Contraseña son incorrectos.',true));
					$this->redirect('login');
			}	
		}
	}


	//Permite salir de la aplicacion y cerrar la sesion activa
	function logout(){
		   $this->Session->destroy();
		   $this->redirect($this->Auth->logout());
	}


	function confirmmail($msgmail = null){
		if($msgmail == null)
			$this->set('msgmail','No se pudo enviar el correo de confirmación: '.$errormail);
		else
			$this->set('msgmail','Verifique en su correo el mail de confirmación de usuario');	
	}

	//Registrar nuevo usuario al sistema
	
	function add(){
		$this->layout = 'usersadd';
		$this->set('title_for_layout','Registración de Usuario');
		$this->set('errorval','');
		if($this->request->is('post')){
			$this->User->create();
			$this->request->data['User']['state'] = 2; //Usuario inhabilitado para operar al dar de alta
			//Encryptamos la contraseña con MD5
			$this->User->set($this->request->data);
			$validaUser = $this->User->validates();
			$validaDatosGen=true;
			if(($validaDatosGen == true || empty($validaDatosGen)) && $validaUser = 1){
				if($this->User->addusersall($this->request->data)){
					//enviamos un correo para poder realizar la confirmación del mail
					try {
						App::uses('CakeEmail', 'Network/Email');
						$Email = new CakeEmail('smtp');
						$Email->to($this->request->data['Persona']['email']);
						$usrencrypt = AuthComponent::password($this->request->data['User']['username']);
						$Email->subject('Alta de Usuario');
						$Email->send("http://localhost:8080/users/usersactive/".$usrencrypt);
					}catch(SocketException $e){
						$error = $e->getmessage();
					}		
					$this->redirect(array('action' => 'login',$this->Email->smtpError));
				} else {
					$this->Session->setFlash(__('El usuario no se pudo dar de Alta.', true));
				}
			}
		}
	}
	
		
	function beforeFilter(){
	    parent::beforeFilter();
		if($this->params['action'] == 'userajaxlogin' ||
		$this->params['action'] == 'login' ||
		$this->params['action'] == 'listusers' ||
		$this->params['action'] == 'cambiarcontrasenia'){
	    		$this->Security->unlockedActions=true;
		}else{
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

	    // For CakePHP 2.0
	   //$this->Auth->allow('*');
	    // For CakePHP 2.1 and up
	   //$this->Auth->allow();
	   //$this->initDB();
		
	}
	
    function initDB(){
                $group = $this->User->Group;
                //root todos los permisos
                //$group->id=1;
                //$this->Acl->allow($group,'controllers');
                //$this->Acl->allow($group,'controllers/Personas/index');
                //Clientes
                $group->id=2;
               
                //$this->Acl->deny($group,'controllers');
                //$this->Acl->allow($group,'controllers/Accesorapidos/seguridaderror');
                $this->Acl->allow($group,'controllers/Users/mostrarusuario');
				/***$this->Acl->allow($group,'controllers/Users/cambiarcontrasenia');
				$this->Acl->allow($group,'controllers/Users/logout');
				$this->Acl->allow($group,'controllers/Users/edit');
				$this->Acl->allow($group,'controllers/Users/listusers');
				$this->Acl->allow($group,'controllers/Users/editimage');
				$this->Acl->allow($group,'controllers/Personas/index');
				$this->Acl->allow($group,'controllers/Personas/add');
				$this->Acl->allow($group,'controllers/Personas/listpersonas');
				$this->Acl->allow($group,'controllers/Personas/edit');***/
				
                //$this->Acl->allow($group,'controllers/Accesorapidos/seguridaderror');
                /***$this->Acl->allow($group,'controllers/Bicicletas/index');
                $this->Acl->allow($group,'controllers/Bicicletareparamos/servicesclientes');
                $this->Acl->allow($group,'controllers/Mensajesmantenimientos/retornarmensajes');
                $this->Acl->allow($group,'controllers/Mensajeservices/mostrarmensajecliente');
                $this->Acl->allow($group,'controllers/Clientes/editimage');
                $this->Acl->allow($group,'controllers/Users/cambiarcontrasenia');**/
                //$this->Acl->allow($group,'controllers/Clientes/mostrarfoto');
				//$this->Acl->allow($group,'controllers/Users/cambiarcontrasenia');
				//$this->Acl->deny($group,'controllers/Users/add');
				//$this->Acl->allow($group,'controllers/Bicicletareparamos/listbicicletasreparadas');
				//$this->Acl->allow($group,'controllers/Users/logout');
                //Mecanicos                
                /***$group->id=3;
                $this->Acl->deny($group,'controllers');
                $this->Acl->allow($group,'controllers/Accesorapidos/index');

				$this->Acl->allow($group,'controllers/Bicicletareparamos/cambiarestado');
				$this->Acl->allow($group,'controllers/Mensajeservices/add');
				$this->Acl->allow($group,'controllers/Mensajeservices/index');
                echo 'all done';**/
                exit;
    }
	
	//Funcion para despues de renderizar permite cargar los ddw y ejecutar otras funciones
	function beforeRender(){
		if($this->params['action']=='addusuario'){
			$estciviles = $this->Persona->Estcivile->find('list',array('fields'=>array('Estcivile.id','Estcivile.descrip')));
			$this->set(compact('estciviles'));			
			/***$tipousuarios = $this->Tipousuario->find("list",
						array('fields'=>array('Tipousuario.id','Tipousuario.descripcion'),
							'conditions'=>array('Tipousuario.estado'=>'1')));
			
			//Inicializamos el country sin seleccion
			asort($tipousuarios,2);	
			$this->set('tipousuarios',$tipousuarios);			**/
			//si contiene datos el data es por que se activo la validacion
		}
		//$this->initDB();
	}	
	//Funcion: permite realizar el borrado de un Usuario
	function delete($id = null){
			//Control de errores sin validar
			/*Seguridad UPDATE */
			//$registros = $this->User->find('count',array('conditions'=>array('User.id'=>$id,'User.tallercito_id'=>$this->Session->read('tallercito_id'))));
			//if($registros > 0){
			try {
				if($this->User->delete($id)){
					$this->Session->Setflash(__('Los Datos Fueron Borrados satisfactoriamente',true));
					$this->redirect(array('action'=>'index'));
				}
				}catch(Exception $e){
					$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a registro'));
				}
			//}
			return $this->redirect(array('action' => 'index'));
	}
	
	//Codigo necesario para actualizar los ACOS
	function edit($id = null){
		$this->set('errorval','');
	    $this->User->id = $id;
        $this->set('title_for_layout','Actualizar Datos de Usuario'); 
        if($this->request->is('get')){
        	$this->request->data = $this->User->read();
        		//Datos del usuario persona
				$personas = array();
				$personas = $this->Persona->find('first',array('fields'=>array('Persona.id','Persona.fnac','Persona.apellido','Persona.nombre','Persona.email',
																				'Tipdocxper.nrodoc'),
													'joins'=>array(array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Persona.id = Tipdocxper.persona_id'))),
													'conditions'=>array('Persona.id'=>$this->request->data['User']['persona_id'])
							));
				$this->set('personas',$personas);
        }else{
			if($this->User->saveAll ($this->request->data)){
				$this->Session->Setflash(__('Los datos del Usuario Fueron Actualizados',true));
				$this->redirect(array('action'=>'index'));
			}
		}
	}	

	/*Permite ver el detalle de un usuario*/
	function verdetalleusuario($user_id = null){
		$this->layout='buscar';
		$js_funciones = array('fmensajes.js','dateformat.js');
		$this->set('js_funciones',$js_funciones);
		
		$users = $this->User->getUsers($user_id);
		$this->set('users',$users);
	}
	
	/*
	 * Funcion: permite realizar el proceso de login mediante ajax
	 * */
	function userajaxlogin(){
		$this->layout = '';
		$error='';
		App::uses('AuthComponent', 'Controller/Component');		
		$users = $this->User->find('first',array('conditions' => array('User.username'=>$this->request->data['User']['username'],
				'User.password'=>AuthComponent::password($this->request->data['User']['password']))));
		if ($this->Auth->login()) {
			if(!empty($users)){
				if($users['User']['state'] == 2){
					$error = __('El Usuario no finalizo la registración',true);
				}else{
					if($users['User']['state'] <> 1){
						$error = __('Usuario con estado inválido para operar',true);
					}
				}
			}else{
				$error =__('El usuario o contraseña son incorrectos',true);
			}
		}else{
			$error = __('El usuario o contraseña son incorrectos',true);
		}
		$this->set('error',$error);
	}	
	
	
	/*
	 * Funcion: permite realizar el proceso de login mediante ajax
	 * */
	function userajaxloginremote($user = null,$passowrd = null){
		$this->layout = '';
		$users = $this->User->find('first',array('username'=>$user,
				'password'=>AuthComponent::password($passowrd)));
		$error = ''; //not error
		//Nuevo Login con Athority
		if ($this->Auth->login()) {
			if(!empty($users)){
				if($users['User']['state'] == 2){
					$error = __('El Usuario no finalizo la registración',true);
				}else{
					if($users['User']['state'] <> 1){
						$error = __('Usuario con estado inválido para operar',true);
					}
				}
			}else{
				$error =__('El usuario o contraseña son incorrectos',true);
			}
		}else{
			$error =__('AUTH: El usuario o contraseña son incorrectos',true);			
		}
		$this->set('error',$error);
	}		
	/*
	 * Funcion: permite dar de alta un usuario persona
	 * */
	function addusuario(){
		$this->set('title_for_layout',__('Registración de Usuario'));
		$this->set('errorval','');
		if($this->request->is('post')){
			$this->User->create();
			$this->request->data['User']['group_id'] = 1;
			$this->request->data['User']['state'] = 2;
			$this->request->data['User']['username'] = strtolower ($this->request->data['User']['username']);			
			$this->request->data['Persona']['nrodoc'] = str_replace('.', '', $this->request->data['Persona']['nrodoc']);
			$this->request->data['Persona']['tipodoc_id'] = 1; /*DEFAULT DNI*/
			$this->request->data['Persona']['nn'] = false; /*DEFAULT DNI*/
			$this->request->data['Persona']['username'] = $this->Session->read('username'); /*DEFAULT DNI*/
			$this->request->data['Persona']['ip'] = $this->request->clientIp();
			
			//Encryptamos la contraseña con MD5
			$this->User->set($this->request->data['User']);
			$this->Persona->set($this->request->data);
			$validarUser = $this->User->validates();
			//validamos solo si no tenemos datos caso contrario existe la persona
			if($this->request->data['Persona']['id']==''){
				$validatePersona = $this->Persona->validates();
			}else
				$validatePersona=true;
			
			if($validarUser){
				if($validatePersona){
					$enviarmail=false;
					//si existe la persona damos de alta el usuario solamente
					if($this->request->data['Persona']['id'] != ''){
						$this->request->data['User']['persona_id']=$this->request->data['Persona']['id'];
						if($this->User->save($this->request->data)){
							$enviarmail=true;
						}else{
							$this->Session->setFlash(__('El usuario no se pudo dar de Alta.', true));
						}
					}
					if($this->request->data['Persona']['id'] != '' OR empty($this->request->data['Persona']['id'])){
						if($this->User->addusersall($this->request->data)){						
							echo 'PASO';
							$enviarmail=true;
						} else {
							$this->Session->setFlash(__('El usuario no se pudo dar de Alta.', true));
						}
					}
					if($enviarmail){
						try{
							//enviamos un correo para poder realizar la confirmación del mail
							App::uses('CakeEmail', 'Network/Email');
							$Email = new CakeEmail('smtp');
							$Email->to($this->request->data['Persona']['email']);
							$usrencrypt = MD5($this->request->data['User']['username']);
							$Email->subject('Alta de Usuario SENAyF - ');
							$Email->subject('Alta de Usuario');
							$Email->send("http://localhost:8083/users/usersactive/".$usrencrypt);
							$this->redirect(array('action' => 'index'));
						}catch(SocketException $e){
							$error = $e->getmessage();
							$this->Session->setFlash(__('Usuario Registrado. Envío de Correo con error'));
						}		
						$this->redirect(array('action'=>'index'));
					}
				}
			}
		}
	}
	
	/*PERMITE ACTIVAR EL USUARIO DE FORMA REMOTA CON EL MAIL DEL USUARIO*/
	function usersactive($autcode = null){
		$this->set('title_for_layout','Confirmación de Cliente');
		$this->layout = 'usersadd';
		$this->set('errorval','');
		if(!empty($autcode)){
			$usersdata = $this->User->find('first',array('conditions'=>array('Md5(User.username)'=>$autcode,'User.state'=>2)));
			$personas = $this->Persona->find('first',array('fields'=>array('Persona.id','Persona.documento','Persona.fcnac','Persona.apellido','Persona.nombre',
						'Persona.telefono','Persona.email'),
						'conditions'=>array('Persona.id'=>$usersdata['User']['id'])));
			
			$this->set('usersdata',$usersdata);
			$this->set('personas',$personas);
		}
	}
	
	function confirmarusuario(){
		$this->layout = 'usersadd';
		if($this->request->is('post')){
				$this->request->data['User']['state']=1;
				if($this->User->save($this->request->data)){
					$this->redirect(array('action'=>'login'));
				}else{
					$this->Session->setFlash(__('No se pudo Confirmar el Usuario. Intente Nuevamente', true));
				}		
		}else{
			$this->Session->setFlash(__('No se pudo Confirmar el Usuario. Intente Nuevamente', true));
		}
	}
	
	function emailmensaje($mensaje = null){
		$this->layout = 'usersadd';
		$this->set('mensaje',$mensaje);
	}
	
	//validar borrado de los datos
	function valdelete($id = null){
		/**$error = '';
		$resultgrupo = array();
		$resultuser = array();
		$resultpersona = $this->Persona->find('first',array('conditions'=>array('Persona.id'=>$id),
								'limit'=>1,
								'fields'=>array('Persona.id')
					)
				);
		if(!empty($resultpersona)){
			if(!empty($resultpersona)) $this->set('persona',$this->Persona->read(null,$resultpersona['Persona']['id']));
			$error = 'No se puede eliminar el Usuario ya que se encuentran asociada a una Persona.';
		}else{***/
			$this->redirect(array('action'=>'delete',$id));
		/***}
		$this->set('error',$error);**/
	}

/**
 * cambiarcontrasenia cambiar la contraseña del usuario
 *
 * @throws NotFoundException
 * @param int $id
 * @param blob $image
 * @return void
 */		
	function cambiarcontrasenia(){
		if ($this->request->is(array('post', 'put'))) {
			//$user = $this->User->read(null, $this->request->data['User']['id']);
			$user['User']['id'] = $this->request->data['User']['id'];
			$user['User']['password'] = AuthComponent::password($this->request->data['User']['passwordc']);
			$user['User']['password_repit'] = AuthComponent::password($this->request->data['User']['passwordrepit']);
			if ($this->User->save($user)) {
				$this->Session->setFlash(__('Los Datos han sido Actualizado.'));
			} else {
				$userval = $this->User->invalidFields();
				if(!empty($userval)){
					$this->Session->setFlash(__($userval['image'][0]));
				}else{
					$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
				}
			}
			$this->redirect(array('controller' => 'users','action'=>'edit',$this->request->data['User']['id']));			
			
		}
	}
	

/**
 * editimage actualizar imagen del usuario
 *
 * @throws NotFoundException
 * @param int $id
 * @param blob $image
 * @return void
 */	
	public function editimage(){
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Los Datos han sido guardado.'));
			} else {
				//debug($this->validationErrors); 
				//debug($this->User->invalidFields());
				$userval = $this->User->invalidFields();
				if(!empty($userval)){
					$this->Session->setFlash(__($userval['image'][0]));
				}else{
					$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
				}
			}
			$this->redirect(array('controller' => 'users','action'=>'edit',$this->request->data['User']['id']));
		}			
	}
/**
 * mostrarfoto mostrar la imagen asociado al usuario
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */		
	public function mostrarfoto($id=null){
		$user = $this->User->find("first",array('fields'=>
												array('User.image'),
												'conditions'=>array('User.id'=>$id)));
		if(!empty($user)){
			$cimage = new CimageComponent(new ComponentCollection());	
			$cimage->view(base64_decode($user['User']['image']),'jpg');
		}
	}

	public function mostrarusuario(){
			$cimage = new CimageComponent(new ComponentCollection());	
			//echo $this->Session->read('image');
			$cimage->view(base64_decode($this->Session->read('image')),'jpg');
	}
	
	/*
	*Funcion: permite cambiar la contraseña del usuario por medio de un proceso obligatorio
	*/
	public function cambiarcontraseniauser(){
		$this->set('title_for_layout',__('Cambiar Contraseña de Usuario'));
		$this->layout='usersadd';
		if ($this->request->is(array('post', 'put'))) {
			$user['User']['id']=$this->request->data['User']['id'];
			$user['User']['cambiarcontrasenia'] = 0;
			$user['User']['password'] = AuthComponent::password($this->request->data['User']['passwordc']);
			$user['User']['password_repit'] = AuthComponent::password($this->request->data['User']['passwordrepit']);
			if ($this->User->save($user)) {
				$this->Session->setFlash(__('Los Datos han sido Actualizado.'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
			}
			$this->redirect(array('controller' => 'users','action'=>'logout'));			
		}else{
			$usersdata = $this->User->find('first',array('conditions'=>array('User.id'=>$this->Session->read('user_id'),'User.state'=>1)));
			if(!empty($usersdata)){
				$personas = $this->Persona->find('first',array('fields'=>array('Persona.id','Tipdocxper.nrodoc','Persona.fnac','Persona.apellido','Persona.nombre','Persona.email'),
						'conditions'=>array('Persona.id'=>$usersdata['User']['persona_id']),
						'joins'=>array(array('table'=>'tipdocxpers',
															'alias'=>'Tipdocxper',
															'type'=>'LEFT',
															'conditions'=>array('Tipdocxper.persona_id = Persona.id and Tipdocxper.tipodoc_id=1')))));
				$this->set('usersdata',$usersdata);
				$this->set('personas',$personas);
			}
			$this->set(compact('usersdata','personas'));	
		}
	}
	
	
}

?>
