<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel{
   	public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));
	var $name = 'User';
	var $validate=array('username'=>array('alphaNumeric'=>
											array('rule'=>'alphaNumeric','requiered'=>true,
											'message'=>'Solo puede Ingresar Letras y Numeros'),
											'userunique'=>array('rule'=>'userunique','message'=>'(*) Usuario Existente'),
											'caracteres'=>array('rule'=>array('between',5,20),
								'message'=>'(*) El Usuario Debe Contener entre 5 y 20 Caracteres'),
								'notEmpty' => array(
											'rule' => array('notEmpty'),
											'message' => 'Debe Ingresar un usuario')),
								'password'=>array('passwordequal'=>array('rule'=>'passwordequal',
								'message'=>'(*) Los Password Ingresados deben ser Iguales')),
								'image' => array(
												'extension' => array(
													'rule' => array('extension',array('jpg','png')),
													'message' => 'Solo se pueden subir archivos JPG'
												),
												'upload-file' => array(
													'rule' => array('uploadFile'),
													'message' => 'Error al Cargar el Archivo'
												),
												'fileSize' => array(
													'rule' => array('fileSize', '<=', '1MB'),
													'message' => 'La Imagen debe ser menor igual a un 1MB'
												)
											)
								);
/**
 * belongsTo associations
 *
 * @var array
 */
        public $belongsTo = array(
                'Group' => array(
                        'className' => 'Group',
                        'foreignKey' => 'group_id',
                        'conditions' => '',
                        'fields' => '',
                        'order' => ''
                )
        );

	/*
	 * Funcion: permite cargar la imagen del usuario
	 */
        
	function uploadFile($data){
			App::uses('CimageComponent','Controller/Component');
			$cimage = new CimageComponent(new ComponentCollection());			
			/*imagen tamanio normal*/
			$fileData = $cimage->ImagenToBlob($this->data['User']['image']['tmp_name'],110,50);
			$this->data['User']['image']=base64_encode($fileData);
			//print_r($this->data);
			return true;
	}        
	/*
	 * Funcion: permite validar el login para el inicio de sesion'
	 */
	function validateLogin($data){
		if(strlen($data['username'])<=0) return false;
		if(strlen($data['password'])<=0) return false;		
		$user = $this->find('first',array('conditions' => array('User.username'=>$data['username'],'User.password'=>AuthComponent::password($data['password']),'User.state'=>'1'),
											'joins'=>array(array('table'=>'personas',
															'alias'=>'Persona',
															'type'=>'LEFT',
															'conditions'=>array('Persona.id = User.persona_id'))),
											'fields'=>array('User.id','User.group_id','User.image','User.username','Persona.id',
															'Persona.apellido','Persona.nombre','Persona.email','User.cambiarcontrasenia')));
		if(empty($user) == false){
			return $user;
		}
		return false;
	}
								
	/*
	 * Funcion: Permite validar si el usuario que se quiere dar de alta ya existe
	 */
	
	function userunique($data){
		return $this->isUnique(array('username'=>$this->data['User']['username']));
	}
	
	/*
	 * Funcion: permite determinar si las password ingresadas son iguales
	 */
	function passwordequal($data){
		$valid = false;
		if($this->data['User']['password'] == $this->data['User']['password_repit']) $valid = true;
		return $valid;
	}

	
	/*
	 * Funcion: permite insertar un nuevo usuario
	 * */
	function addusersall($data = null){
		if(!empty($data)){
			$data['User']['password']=AuthComponent::password($data['User']['password']);
			$data['User']['password_repit']=AuthComponent::password($data['User']['password_repit']);		
			$datasource = $this->getDataSource();
			ClassRegistry::init('Persona');
			$Persona = new Persona();
			$datasource->begin($this);
			$result = $Persona->GuardarPersona($data);
			$result=true;
			if($result){
				$datasource->commit($this);
				return true;
			}else{
				$datasource->rollback($this);					
				return false;
			}
		}
	}
	
	
	function guardaruser($data){
		$this->create();
		return $this->save($data);
	}

	function beforeSave($options= array())
	{
			
			//return parent::beforeSave($options);
			return true;
	}
	
	function beforeValidate($options = array()){
		//$this->data['Alumno']['nrolegajo']=str_replace('.', '', $this->data['Usersalumno']['document']);
		return true;
	}
	
	function getUsers($id = null){
		return $this->find('first',array('conditions' => array('User.id'=>$id,'User.state'=>1)));
	}
	
	function getUserDetails($group_id=null,$user_id = null){
		$userdetails = array();
		if($group_id == 2){
			ClassRegistry::init('Cliente');
			$Cliente = new Cliente();
			$datos =$Cliente->find('first',array('conditions'=>array('user_id'=>$user_id)));
			$userdetails['User']['group_id']=$group_id;
			$userdetails['User']['cliente_id']=$datos['Cliente']['id'];
			ClassRegistry::init('Bicicleta');
			$ClienteBicicleta = new Bicicleta();
			$datos =  $ClienteBicicleta->find('all',array('conditions'=>array('cliente_id'=>$userdetails['User']['cliente_id'])));
			$grupos_id='0';
			//cargamos todos los grupos asociados al usuario
			foreach($datos as $dato){
				$grupos_id=$grupos_id.','.$dato['Bicicleta']['id'];
			}
			$userdetails['User']['bicicleta_id']=$grupos_id;
		}else{
			//ADMIN NO RETURN DATA
		}
		return $userdetails;
	}

	public function parentNode() {
        	if (!$this->id && empty($this->data)) {
            		return null;
        	}
        	if (isset($this->data['User']['group_id'])) {
            		$groupId = $this->data['User']['group_id'];
        	} else {
            		$groupId = $this->field('group_id');
        	}
        	if (!$groupId) {
            		return null;
        	} else {
            		return array('Group' => array('id' => $groupId));
        	}
    }
    
	function bindNode($user) {
		//$data = AuthComponent::user();
	    return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}    	

}

?>
