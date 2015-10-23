<?php
App::uses('AppModel', 'Model');
/**
 * Tipdocxper Model
 *
 * @property Tipodoc $Tipodoc
 * @property Persona $Persona
 */
class Tipdocxper extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tipodoc_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el tipo de documento'
			),
		),
		'persona_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar una persona'
			),
		),
		'nrodoc' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Número de Documento debe ser numerico'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el número de documento'
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
		'Tipodoc' => array(
			'className' => 'Tipodoc',
			'foreignKey' => 'tipodoc_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'persona_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
