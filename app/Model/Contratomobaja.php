<?php
App::uses('AppModel', 'Model');
/**
 * Contratomobaja Model
 *
 */
class Contratomobaja extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Derbe Ingresar la descripción'
			),
		),
	);
}
