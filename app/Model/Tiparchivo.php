<?php
App::uses('AppModel', 'Model');
/**
 * Tiparchivo Model
 *
 */
class Tiparchivo extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'extension' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la extension'
			),
		),
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la descripción'
			),
			'maxLength' => array(
				'rule' => array('maxLength',100),
				'message' => 'Debe Tener menos de 100 caracteres'
			),
		),
	);
}
