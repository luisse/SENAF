<?php
App::uses('AuthComponent', 'Controller/Component');
class UsersController extends AppController{
	var $name = 'Users';
	var $components = array('RequestHandler','Session','Email','Paginator', 'Acl', 'Security');
	var $uses = array('User','Persona');
	var $helpers = array('Html','Form','Time');
    public $actsAs = array('Acl' => array('type' => 'requester'));
	
	//Funcion principal para visualizar todos los usuarios
	function index(){
		$this->User->recursive = 0;
        $this->set('title_for_layout','Administracion Datos de Usuario'); 
		$this->set('tipousr',$this->Session->read('tipousr'));
	}
	
	function listusers(){
		$this->User->recursive = 0;
        $this->set('title_for_layout',__('Administración Datos de Usuario')); 
		$ls_filtro =' 1=1 ';
		//usuario administrador sin filtros puede ver todos los usuarios
		if($this->Session->read('tipousr') <> 6){
			$ls_filtro = ' AND User.id = '.$this->Session->read('user_id');
		}	
		
		$ls_filtronotexist=' 1=1 ';	
		$ls_notexist = '';
		//if(!empty($this->request->data)){
			$this->paginate=array('limit' => 8,
							'page' => 1,
							'order'=>array('username'=>'desc'),
							'conditions'=>$ls_filtro.$ls_notexist,
							'fields'=>array('User.id','User.username','Persona.email','Persona.apellido','Persona.nombre'),
							'joins'=>array(array('table'=>'personas',
															'alias'=>'Persona',
															'type'=>'LEFT',
															'conditions'=>array('Persona.id = User.persona_id'))));				
			$this->set('users', $this->paginate());
		//}
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
					//Guardamos los datos de usuario y configuraciones en las sesion del usuario
					//--$result = $this->User->getUserDetails($user['User']['group_id'],$user['User']['id']);
					$this->Session->write('username',$user['User']['username']);
					$this->Session->write('user_id',$user['User']['id']);
					$this->Session->write('tipousr',$user['User']['group_id']);
					//$this->Session->write('personal_id',$user['User']['tallercito_id']);
					if($user['User']['group_id'] == 2){
						//$this->Session->write('bicicleta_id',$result['User']['bicicleta_id']);
					}else{
						
					}
					$this->redirect(array('controller'=>'accesorapidos','action'=>'index'));
					exit();
				}else{
					$this->Session->setFlash(__('El usuario o Password son incorrectos.',true));
				}			
			}else{
					$this->Session->setFlash(__('Acl: El usuario o Password son incorrectos.',true));
					$this->redirect('login');
			}	
		}
	}


	//Permite salir de la aplicacion y cerrar la sesion activa
	function logout(){
	       $this->Session->destroy('user');
		   $this->Session->destroy('username');
		   $this->Session->destroy('user_id');
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
			//$this->Cliente->set($this->request->data);
			$validaUser = $this->User->validates();
			//$validaDatosGen= $this->Cliente->validates();
			$validaDatosGen=true;
			if(($validaDatosGen == true || empty($validaDatosGen)) && $validaUser = 1){
				if($this->User->addusersall($this->request->data)){
					//enviamos un correo para poder realizar la confirmación del mail
					App::uses('CakeEmail', 'Network/Email');
					$Email = new CakeEmail('smtp');
					$Email->to($this->request->data['User']['email']);
					$usrencrypt = AuthComponent::password($this->request->data['User']['username']);
					$Email->subject('Alta de Usuario');
					//$Email->send("http://localhost:8080/users/usersactive/".$usrencrypt);
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
		}
		//$this->initDB();
	}
	
    function initDB(){
                $group = $this->User->Group;
                //root todos los permisos
                $group->id=6;
                $this->Acl->allow($group,'controllers');
                //Clientes
                //$group->id=2;
               
                /**$this->Acl->deny($group,'controllers');
                $this->Acl->allow($group,'controllers/Users/edit');
                $this->Acl->allow($group,'controllers/Accesorapidos/index');
                $this->Acl->allow($group,'controllers/Bicicletas/index');
                $this->Acl->allow($group,'controllers/Bicicletareparamos/servicesclientes');
                $this->Acl->allow($group,'controllers/Mensajesmantenimientos/retornarmensajes');
                $this->Acl->allow($group,'controllers/Mensajeservices/mostrarmensajecliente');
                $this->Acl->allow($group,'controllers/Bicicletareparamos/bicicletasentaller');
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
                $this->Acl->allow($group,'controllers/Bicicletareparamos/tallerlistarbicicletas');
				$this->Acl->allow($group,'controllers/Bicicletareparamos/cambiarestado');
				$this->Acl->allow($group,'controllers/Mensajeservices/add');
				$this->Acl->allow($group,'controllers/Mensajeservices/index');
                echo 'all done';**/
                exit;
    }
	
	//Funcion para despues de renderizar permite cargar los ddw y ejecutar otras funciones
	function beforeRender(){
		if($this->params['action'] == 'add' || 
			$this->params['action']=='edit' ||
			$this->params['action']=='addusrneg'){
			
			/***$tipousuarios = $this->Tipousuario->find("list",
						array('fields'=>array('Tipousuario.id','Tipousuario.descripcion'),
							'conditions'=>array('Tipousuario.estado'=>'1')));
			
			//Inicializamos el country sin seleccion
			asort($tipousuarios,2);	
			$this->set('tipousuarios',$tipousuarios);			**/
			//si contiene datos el data es por que se activo la validacion
		}
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
		/*Seguridad UPDATE */
		if($this->Session->read('tipousr') == 2 ) $id = $this->Session->read('user_id');
	    $this->User->id = $id;
        $this->set('title_for_layout','Actualizar Datos de Usuario'); 
        if($this->request->is('get')){
        	$this->data = $this->User->read();
        		//Datos del usuario persona
				//$clientes = array();
				//$clientes = $this->Cliente->find('first',array('fields'=>array('Cliente.id','Cliente.documento','Cliente.fechanac','Cliente.apellido','Cliente.nombre','Cliente.domicilio',
				//													'Cliente.telefono','Cliente.dpto','Cliente.piso','Cliente.block'),
				//			'conditions'=>array('Cliente.user_id'=>$id)));
				//$this->set('clientes',$clientes);
        }else{
			if($this->User->saveAll ($this->request->data)){
				$this->Session->Setflash(__('Los datos del Usuario Fueron Actualizados',true));
				$this->redirect(array('action'=>'index'));
			}
		}
	}	

	//metodo para buscar clientes
	function buscarclientes(){
		$this->layout ='buscaralumnos';
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
	 * Funcion: un usuario profesor puede dar de alta usuarios alumnos
	 * */
	function addusuario(){
		//$this->layout = 'usersadd';
		$this->set('title_for_layout','Registración de Usuario Cliente');
		$this->set('errorval','');
		if($this->request->is('post')){
			$this->User->create();
			$this->request->data['User']['group_id'] = 2;
			$thid->request->data['User']['state']=2;
			$this->request->data['Cliente']['documento'] = str_replace('.', '', $this->request->data['Cliente']['documento']);
			//Encryptamos la contraseña con MD5
			$this->User->set($this->request->data);
			$this->Persona->set($this->request->data);
			$validaUser = $this->User->validates();
			$validaDatosGen= $this->Persona->validates();
			if(($validaDatosGen == true || empty($validaDatosGen)) && $validaUser = 1){
				if($this->User->addusersall($this->request->data)){
					//enviamos un correo para poder realizar la confirmación del mail
					App::uses('CakeEmail', 'Network/Email');
					$Email = new CakeEmail('smtp');
					$Email->to($this->request->data['User']['email']);
					$usrencrypt = MD5($this->request->data['User']['username']);
					$tallercito = $this->Session->read('tallercito');
					if(!empty($tallercito)) 
						$Email->subject('Alta de Usuario - '.$tallercito['Tallercito']['razonsocial']);
					else
						$Email->subject('Alta de Usuario');
					$Email->send("http://localhost:8083/users/usersactive/".$usrencrypt);
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('El usuario no se pudo dar de Alta.', true));
				}
			}
		}else{
			$estciviles = $this->Persona->Estcivile->find('list',array('fields'=>array('Estcivile.id','Estcivile.descrip')));
			$this->set(compact('estciviles'));			
		}
	}
	
	/*PERMITE ACTIVAR EL USUARIO DE FORMA REMOTA CON EL MAIL DEL USUARIO*/
	function usersactive($autcode = null){
		$this->set('title_for_layout','Confirmación de Cliente');
		$this->layout = 'usersadd';
		$this->set('errorval','');
		if(!empty($autcode)){
			$usersdata = $this->User->find('first',array('conditions'=>array('Md5(User.username)'=>$autcode,'User.state'=>2)));
			$clientes = $this->Cliente->find('first',array('fields'=>array('Cliente.id','Cliente.documento','Cliente.fechanac','Cliente.apellido','Cliente.nombre','Cliente.domicilio',
						'Cliente.telefono','Cliente.dpto','Cliente.piso','Cliente.block'),
						'conditions'=>array('Cliente.user_id'=>$usersdata['User']['id'])));
			
			$this->set('usersdata',$usersdata);
			$this->set('clientes',$clientes);
		}
	}
	
	function confirmarusuario(){
		$this->layout = 'usersadd';
		print_r($this->request->data);
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
		$error = '';
		$resultgrupo = array();
		$resultuser = array();
		$resultcliente = $this->Cliente->find('first',array('conditions'=>array('user_id'=>$id),
								'limit'=>1,
								'fields'=>array('Cliente.id')
					)
				);
				
		if(!empty($resultcliente) || !empty($resultprof)){
			if(!empty($resultcliente)) $this->set('cliente',$this->Cliente->read(null, $resultcliente['Cliente']['id']));

			$error = 'No se puede eliminar el Usuario ya que se encuentran asociada a un Cliente.';
		}else{
			$this->redirect(array('action'=>'delete',$id));
		}
		$this->set('error',$error);
	}
	
	function cambiarcontrasenia(){
		if ($this->request->is(array('post', 'put'))) {
			$user = $this->User->read(null, $this->request->data['User']['id']);
			$user['User']['password'] = AuthComponent::password($this->request->data['User']['passwordc']);
			$user['User']['password_repit'] = AuthComponent::password($this->request->data['User']['passwordrepit']);
			if ($this->User->save($user)) {
				$this->Session->setFlash(__('Los Datos han sido Actualizado.'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
			}
			$this->redirect(array('controller' => 'users','action'=>'edit',$this->request->data['User']['id']));			
			
		}
	}
}

?>
