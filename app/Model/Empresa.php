<?php
App::uses('AppModel', 'Model');
/**
 * Empresa Model
 *
 * @property Tipoempresa $Tipoempresa
 * @property Contactoxempresa $Contactoxempresa
 */
class Empresa extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tipoempresa_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'De Ingresar el Tipo de Empresa'
			),
		),
		'denominacion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Denominación'
			),
		),
		'cuit' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el CUIT'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El CUIT debe tener solo numeros'
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Tipoempresa' => array(
			'className' => 'Tipoempresa',
			'foreignKey' => 'tipoempresa_id',
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
		'Contactoxempresa' => array(
			'className' => 'Contactoxempresa',
			'foreignKey' => 'empresa_id',
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

}
