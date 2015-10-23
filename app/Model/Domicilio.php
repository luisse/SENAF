<?php
App::uses('AppModel', 'Model');
/**
 * Domicilio Model
 *
 * @property Paise $Paise
 * @property Provincia $Provincia
 * @property Depto $Depto
 * @property Municipio $Municipio
 * @property Localidade $Localidade
 * @property Barrio $Barrio
 * @property Calle $Calle
 */
class Domicilio extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'paise_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el País'
			),
		),
		'provincia_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar la Provincia'
			),
		),
		'depto_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar el Departamento'
			),
		),
		'municipio_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar el Municipio'
			),
		),
		'localidade_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar la Localidad'
			),
		),
		'barrio_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar el Barrio'
			),
		),
		'calle_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Calle'
			),
		)/***,
		'piso' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El Piso debe ser Numérico'
			),
		)****/
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Paise' => array(
			'className' => 'Paise',
			'foreignKey' => 'paise_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Provincia' => array(
			'className' => 'Provincia',
			'foreignKey' => 'provincia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Depto' => array(
			'className' => 'Depto',
			'foreignKey' => 'depto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Municipio' => array(
			'className' => 'Municipio',
			'foreignKey' => 'municipio_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Localidade' => array(
			'className' => 'Localidade',
			'foreignKey' => 'localidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Barrio' => array(
			'className' => 'Barrio',
			'foreignKey' => 'barrio_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Calle' => array(
			'className' => 'Calle',
			'foreignKey' => 'calle_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function guardarasocgroup($data){
		if(!empty($data)){
			$datasource = $this->getDataSource();
			ClassRegistry::init('Grupsocxdomi');
			ClassRegistry::init('Coord');
			$Coord = new Coord();
			$Grupsocxdomi = new Grupsocxdomi();
			$this->create();
			$datasource->begin($this);

			if($this->save($data)){
				$grupsocxdomis['Grupsocxdomi']['grupsociale_id']=$data['Domicilio']['grupsociale_id'];
				$grupsocxdomis['Grupsocxdomi']['domicilio_id']=$this->id;
				print_r($data);
				$Grupsocxdomi->create();
				if($Grupsocxdomi->save($grupsocxdomis)){
					
					if(!empty($data['Domicilio']['latitude']) && $data['Domicilio']['latitude']!='' &&
						!empty($data['Domicilio']['longitude']) && $data['Domicilio']['longitude']!=''){
						$coord['Coord']['latitud']=$data['Domicilio']['latitude'];
						$coord['Coord']['longitud']=$data['Domicilio']['longitude'];
						$coord['Coord']['domicilio_id']=$this->id;
						$coord['Coord']['fecha']=date('Y-m-d H:i:s');
						$coord['Coord']['descrip']=$data['Domicilio']['detallecoord'];
						$result = $Coord->guardarcoordom($coord);
						print_r($result);
						if(!$result){
							$datasource->rollback($this);
							$datasource->rollback($this);
							return false;
						}
					}
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
}
