<?php
App::uses('AppModel', 'Model');
/**
 * Fallecidosccr Model
 *
 * @property Persona $Persona
 */
class Ccrfallecido extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	/***
	public $validate = array(
		'idservicio' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Servicio'
			),
		),
		'fallecido' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Fallecido'
			),
		),
		'solicitante' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Solicitante'
			),
		),
		'empresa' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Empresa'
			),
		),
	);****/

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'persona_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function saveallccrfallecidos($array_insert_ccrfallecidos=null,$array_uptade_ccrfallecidos,$ccrcabfallec = null){
		$datasource = $this->getDataSource();
		ClassRegistry::init('Ccrcabfallec');
		$ccrcabfallecs = new Ccrcabfallec();
		$this->create();
		$datasource->begin($this);
		//Datos del header del archivo
		$data['Ccrcabfallec']['fdde']=$ccrcabfallec['Ccrcabfallec']['fdde'];
		$data['Ccrcabfallec']['fhta']=$ccrcabfallec['Ccrcabfallec']['fhta'];
		$data['Ccrcabfallec']['nombarch']=$ccrcabfallec['Ccrcabfallec']['nombarch'];
		$data['Ccrcabfallec']['cantreg']=$ccrcabfallec['Ccrcabfallec']['cantreg'];
		$data['Ccrcabfallec']['usuariocrea']=$ccrcabfallec['Ccrcabfallec']['usuariocrea'];
		$data['Ccrcabfallec']['ipcrea']=$ccrcabfallec['Ccrcabfallec']['ipcrea'];
		//Fin del Header
		
		if($ccrcabfallecs->Save($data)){
			$id_cab = $ccrcabfallecs->id;
			$ccrfallecidos = $array_insert_ccrfallecidos;
			$i=0;
			foreach($ccrfallecidos as $ccrfallecido){
				$array_insert_ccrfallecidos[$i]['ccrcabfallec_id']=$id_cab;
				$i++;
			}
			unset($array_insert_ccrfallecidos['Ccrfallecido']);
			if($this->SaveAll($array_insert_ccrfallecidos)){
				
				
				if(!empty($array_uptade_ccrfallecidos)){
					if($this->saveAll($array_uptade_ccrfallecidos['Ccrfallecido'])){
						$datasource->commit($this);
						return true;
					}
				}else{
						$datasource->commit($this);
						return true;
				}
			}else{
				//print_r($this->validationErrors);
				//print_r($array_insert_ccrfallecidos);
			}
		}
		$datasource->rollback($this);			
		return false;
	}
}
