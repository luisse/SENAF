<?php
App::uses('AppModel', 'Model');
/**
 * Grupsocxdomi Model
 *
 * @property Grupsociale $Grupsociale
 * @property Domicilio $Domicilio
 */
class Grupsocxdomi extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'grupsociale_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'domicilio_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		'Grupsociale' => array(
			'className' => 'Grupsociale',
			'foreignKey' => 'grupsociale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Domicilio' => array(
			'className' => 'Domicilio',
			'foreignKey' => 'domicilio_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
