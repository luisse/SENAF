<?php
App::uses('AppModel', 'Model');
/**
 * Permiso Model
 *
 * @property Archxpersona $Archxpersona
 */
class Permiso extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la descripción'
			),
			'maxLength' => array(
				'rule' => array('maxLength',50),
				'message' => 'La descripción debe contener menos de 50 caracteres'
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
		'Archxpersona' => array(
			'className' => 'Archxpersona',
			'foreignKey' => 'permiso_id',
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
