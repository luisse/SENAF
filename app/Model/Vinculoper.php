<?php
App::uses('AppModel', 'Model');
/**
 * Vinculoper Model
 *
 * @property Personaizq $Personaizq
 * @property Parentesco $Parentesco
 * @property Personadcha $Personadcha
 * @property Persxoficina $Persxoficina
 */
class Vinculoper extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'personaizq_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar la persona de la Izd.'
			),
		),
		'parentesco_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar el parentesco'
			),
		),
		'personadcha_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar Persona Derecha'
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	/**public $belongsTo = array(
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'personaizq_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Parentesco' => array(
			'className' => 'Parentesco',
			'foreignKey' => 'parentesco_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Personadcha' => array(
			'className' => 'Personadcha',
			'foreignKey' => 'personadcha_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
			
	);*/
}
