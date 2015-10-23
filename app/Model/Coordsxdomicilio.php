<?php
App::uses('AppModel', 'Model');
/**
 * Coordsxdomicilio Model
 *
 * @property Coord $Coord
 * @property Domicilio $Domicilio
 */
class Coordsxdomicilio extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'coord_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Coord' => array(
			'className' => 'Coord',
			'foreignKey' => 'coord_id',
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
