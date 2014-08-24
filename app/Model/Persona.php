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
			),
		),
		'nn' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'NN debe ser un valor tipo booleano'
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

}
