<?php
App::uses('AppModel', 'Model');
/**
 * Oficina Model
 *
 * @property Persxoficina $Persxoficina
 */
class Oficina extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Descripción'
			),
			'oficinaUnique' => array(
				'rule' => array('oficinaUnique'),
				'message' => 'La Oficina ya Existe',
				'on' => 'create' // Limit validation to 'create' or 'update' operations
			),
		),
		'codofiexpe' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El Código de Oficina debe ser Numerico'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Código de Oficina'
			),
			'codofiexpeUnique' => array(
				'rule' => array('codofiexpeUnique'),
				'message' => 'Código ya asignado',
				'on' => 'create' // Limit validation to 'create' or 'update' operations
			),
			'rango' => array(
					'rule'    => array('range',1, 9999),
					'message' => 'El Código debe estar comprendido entre 1 y 9999'
				)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Persxoficina' => array(
			'className' => 'Persxoficina',
			'foreignKey' => 'oficina_id',
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
	public function oficinaUnique(){
		$count = $this->find('count',array('conditions'=>array("Upper(descrip) like Upper('%".$this->data['Oficina']['descrip']."%')")));
		if($count > 0)
			return false;
		else
			return true;
	}
	
	public function codofiexpeUnique(){
		return $this->isUnique(array('codofiexpe'=>$this->data['Oficina']['codofiexpe']));
	}
}
