<?php
App::uses('AppModel', 'Model');
/**
 * Persona Model
 *
 * @property Estcivile $Estcivile
 * @property Tipdocxper $Tipdocxper
 */
class Persona extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'apellido' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Apellido'
			),
		),
		'nombre' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Nombre'
			),
		),
		'sexo' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Sexo'
			)
		),
		'fnac' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Debe Ingresar una Fecha valida Día/Mes/Año'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar una Fecha Valida'
			),
		),
		'estcivile_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar el Esado Civil'
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Debe Ingresar un correo valido'
			)/**,
			'mailunico'=>array('rule'=>'mailunico',
								'message'=>'(*) El Email Ingresado ya Existe',
							'on'=>'create')***/),
		'nn' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'NN debe ser un valor tipo booleano'
			),
		),
		'nrodoc' => array(
			'existetipdocnrodoc' => array(
				'rule' => array('existetipdocnrodoc'),
				'message' => 'Ya existe el tipo y Número de documento'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Número de Documento'
			)
		)
		
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Estcivile' => array(
			'className' => 'Estcivile',
			'foreignKey' => 'estcivile_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Tipdocxper' => array(
			'className' => 'Tipdocxper',
			'foreignKey' => 'persona_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	
	public function existetipdocnrodoc($data = null){
		$noexiste = true;
		if(!empty($data) && $data['nrodoc'] != 0){
				ClassRegistry::init('Tipdocxper');
				$Tipdocxper = new Tipdocxper();
				$cantidad  = $Tipdocxper->find('count',array('conditions'=>array(/**'Tipdocxper.tipodoc_id'=>$data['Tipdocxper']['tipodoc_id'],***/
																	'Tipdocxper.nrodoc'=>$data['nrodoc'])));
				if($cantidad > 0){
					$noexiste=false;
				}																	
		}
		return $noexiste;
	}
	
	/*
	* Funcion: antes de guardar es importante convertir la fecha al formato Unix/Mysql
	*/
	function beforeSave($options=array())
	{
		if(!empty($this->data['Persona']['fnac']))
			$this->data['Persona']['fnac'] = $this->formatDate($this->data['Persona']['fnac']);
		return true;
	}	
	
	function beforeValidate($options=array())
	{
		if(!empty($this->data['Persona']['fnac']))
			$this->data['Persona']['fnac'] = $this->formatDate($this->data['Persona']['fnac']);
		return true;
	}	
	
	function GuardarPersona($data = null){
		if(!empty($data)){
			$dataSource = $this->getDataSource();
			ClassRegistry::init('Tipdocxper'); 
			ClassRegistry::init('User'); 
			ClassRegistry::init('Archivo');
			$Archivo = new Archivo();
			$Tipdocxper = new Tipdocxper();
			$User = new User();
			$this->create();
			$dataSource->begin($this);
			//GUARDO PERSONA
			if($this->Save($data)){
				//GUARDO Usuario
				$data['User']['persona_id']= $this->id;
				if($User->save($data)){				
					$Tipdocxperdat['Tipdocxper']['tipodoc_id']=$data['Persona']['tipodoc_id'];
					$Tipdocxperdat['Tipdocxper']['nrodoc']=$data['Persona']['nrodoc'];
					$Tipdocxperdat['Tipdocxper']['persona_id']=$this->id;
					$Tipdocxperdat['Tipdocxper']['usuariocrea']=$data['Persona']['username'];
					$Tipdocxperdat['Tipdocxper']['ipcrea']=$data['Persona']['ip'];
					if($Tipdocxper->save($Tipdocxperdat)){ 
						$dataSource->commit($this);
						$dataSource->commit($this);
						return true;
					}else{
						$dataSource->rollback($this);	
						$dataSource->rollback($this);	
						return false;
					}

				}else{
					$dataSource->rollback($this);	
					return false;				
				}
			}else{
				$dataSource->rollback($this);
				return false;
			}
		}
	}
	
	function GuardarPersonaExterna($data = null){
		if(!empty($data)){
			$dataSource = $this->getDataSource();
			ClassRegistry::init('Tipdocxper'); 
			ClassRegistry::init('Domicilio'); 
			ClassRegistry::init('Persxgrupsociale'); 
			ClassRegistry::init('Archivo');
			$Archivo = new Archivo();
			$Tipdocxper = new Tipdocxper();
			$this->create();
			$dataSource->begin($this);
			//GUARDO PERSONA
			if($this->Save($data)){
				$Tipdocxperdat['Tipdocxper']['tipodoc_id']=$data['Tipdocxper']['tipodoc_id'];
				$Tipdocxperdat['Tipdocxper']['nrodoc']=$data['Tipdocxper']['nrodoc'];
				$Tipdocxperdat['Tipdocxper']['persona_id']=$this->id;
				$Tipdocxperdat['Tipdocxper']['usuariocrea']=$data['Persona']['username'];
				$Tipdocxperdat['Tipdocxper']['ipcrea']=$data['Persona']['ip'];
				if($Tipdocxper->Save($Tipdocxperdat)){
					
						//SI CONTIENE UNA IMAGEN DEBEMOS GUARDARLA Y VINCULARLA
						if(!empty($data['Persona']['foto'])){
							$archivo['Archivo']['usuariocrea']=$data['Persona']['username'];
							$archivo['Archivo']['ipcrea']=$data['Persona']['ip'];
							$archivo['Archivo']['tiparchivo_id']=$data['Persona']['tiparchivo_id'];
							$archivo['Archivo']['persona_id']=$this->id;
							$archivo['Archivo']['descgeneral']='FOTO PERSONAL';
							$archivo['Archivo']['descrip']='FOTO PERSONAL';
							$archivo['Archivo']['archivo']=$data['Persona']['foto'];
							$Archivo->validator()->remove('archivo');
							if($Archivo->guardarArchivo($archivo)){
							}else{
								$dataSource->rollback($this);
								$dataSource->rollback($this);
								$dataSource->rollback($this);
								return false;
							}
						}
						
						//VINCULO GRUPOSOCXPERS
						if(!empty($data['Persona']['grupsociale_id'])){
							$Persxgrupsociale = new Persxgrupsociale();
							$Persxgrupsociale->create();
							$persxgrupsociales['Persxgrupsociale']['grupsociale_id'] = $data['Persona']['grupsociale_id'];
							$persxgrupsociales['Persxgrupsociale']['persona_id'] = $this->id;
							$persxgrupsociales['Persxgrupsociale']['usuariocrea'] = $data['Persona']['username'];
							$persxgrupsociales['Persxgrupsociale']['ipcrea'] = $data['Persona']['ip'];
							if($Persxgrupsociale->Save($persxgrupsociales)){
								$dataSource->commit($this);
								$dataSource->commit($this);
								$dataSource->commit($this);
								return true;								
							}else{
								$dataSource->rollback($this);	
								$dataSource->rollback($this);	
								$dataSource->rollback($this);	
								return false;								
							}
						}else{
							$dataSource->commit($this);
							$dataSource->commit($this);
							return true;
						}
				}else{
					$dataSource->rollback($this);
					$dataSource->rollback($this);					
					return false;							
				}
			}else{
				$dataSource->rollback($this);
				return false;			
			}
		}
	}
	
	/*
	* Funcion: permite validar que el correo electrnico sea unico
	*/
	function mailunico(){
		return $this->isUnique(array('email'=>$this->data['Persona']['email']));
	}
	
}
