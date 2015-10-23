<?php
App::uses('AppModel', 'Model');
/**
 * Grupopersona Model
 *
 * @property Grupxpersona $Grupxpersona
 */
class Grupopersona extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descripcion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar Descripción del Grupo'
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Grupxpersona' => array(
			'className' => 'Grupxpersona',
			'foreignKey' => 'grupopersona_id',
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
