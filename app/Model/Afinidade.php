<?php
App::uses('AppModel', 'Model');
/**
 * Afinidade Model
 *
 * @property Grupsociale $Grupsociale
 */
class Afinidade extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar Descripción'
			),
			'equalTo' => array(
				'rule' => 'isUnique',
				'message' => 'Ya existe una Descripción Identica Cargada'
			),
		),
		'definicion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar una definición'
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
		'Grupsociale' => array(
			'className' => 'Grupsociale',
			'foreignKey' => 'afinidade_id',
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
