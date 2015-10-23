<?php
App::uses('AppModel', 'Model');
/**
 * Archivo Model
 *
 * @property Tiparchivo $Tiparchivo
 * @property Archxpersona $Archxpersona
 */
class Archivo extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tiparchivo_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar el tipo de Archivo'
			),
		),
		'archivo' => array(
						'fileSize' => array(
									'rule' => array('fileSize', '<=', '2MB'),
									'message' => 'El Archivo debe ser menor igual a un 2MB'
								),
						'extension' => array(
								'rule' => array('extension',array('jpg','doc','docx','png','gif','pdf')),
								'message' => 'Solo se pueden subir archivos jpg,doc,docx,png,gif,pdf'
						),	
						'upload-file' => array(
									'rule' => array('uploadFile'),
									'message' => 'Error al Cargar el Archivo'
							),
						),
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la descripción del archivo',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength',100),
				'message' => 'La descripción debe contener menos de 100 caracteres'
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tiparchivo' => array(
			'className' => 'Tiparchivo',
			'foreignKey' => 'tiparchivo_id',
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
		'Archxpersona' => array(
			'className' => 'Archxpersona',
			'foreignKey' => 'archivo_id',
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

	public function uploadFile(){
		$fileinfo['File']=$this->data['Archivo']['archivo'];
		$file = new File($fileinfo['File']['tmp_name']);
		
		if($file->exists()){
			$binfile = $file->read(true,'rb');
		}else
			return false;
		$this->data['Archivo']['archivo']=base64_encode($binfile);
		$this->data['Archivo']['extension']=$fileinfo['File']['type'];
		return true;
	}

	public function guardarArchivo($data=null){
		if(!empty($data)){
			ClassRegistry::init('Archxpersona');
			$Archxpersona = new Archxpersona();
			$datasource = $this->getDataSource();
			$this->create();
			$datasource->begin($this);
			if($this->Save($data)){
				//Guardamos el vinculo
				$archxpersona['Archxpersona']['persona_id']=$data['Archivo']['persona_id'];
				$archxpersona['Archxpersona']['archivo_id']=$this->id;;
				$archxpersona['Archxpersona']['permiso_id']=1;//ver permisos
				$archxpersona['Archxpersona']['observ']=$data['Archivo']['descgeneral'];//ver permisos
				$archxpersona['Archxpersona']['usuariocrea']=$data['Archivo']['usuariocrea'];//ver permisos
				$archxpersona['Archxpersona']['ipcrea']=$data['Archivo']['ipcrea'];//ver permisos
				if($Archxpersona->save($archxpersona)){
					$datasource->commit($this);
					$datasource->commit($this);
					return true;
				}else{
					$datasource->rollback($this);
					$datasource->rollback($this);
					return false;
				}
			}else{
				$datasource->rollback($this);
				return false;
			}
		}
	}
	
	function getfotopersonal($persona_id = null){
		ClassRegistry::init('Tiparchivo');
		$Tiparchivo = new Tiparchivo();
		$tiparchivo = $Tiparchivo->find('first',array('conditions'=>array('Tiparchivo.descrip'=>'FOTO PERSONAL')));
		$archivoimagen=array();
		if(!empty($tiparchivo)){
			$archivoimagen=$this->find('first',array('conditions'=>array('Archxpersona.persona_id'=>$persona_id,'Archivo.tiparchivo_id'=>$tiparchivo['Tiparchivo']['id']),
					'order'=>array('Archivo.created DESC'),
					'joins'=>array(array('table'=>'archxpersonas',
							'alias'=>'Archxpersona',
							'type'=>'LEFT',
							'conditions'=>array('Archxpersona.archivo_id = Archivo.id')
					))));
		}
		return $archivoimagen;
	}
}
