<?php
App::uses('AppModel', 'Model');
/**
 * Persxoficina Model
 *
 * @property Persona $Persona
 * @property Oficina $Oficina
 * @property Persxgrupsociale $Persxgrupsociale
 */
class Persxoficina extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'persona_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar una persona'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar un valor numerico'
			),
		),
		'oficina_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar la oficina'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar un valor numerico'
			),
		)/**,
		'activo' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Debe Ingresar un valor tipo Verdadero/False'
			),
		)***/
	);

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
		),
		'Oficina' => array(
			'className' => 'Oficina',
			'foreignKey' => 'oficina_id',
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
	/**public $hasMany = array(
		'Persxgrupsociale' => array(
			'className' => 'Persxgrupsociale',
			'foreignKey' => 'persxoficina_id',
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
	);****/

}
