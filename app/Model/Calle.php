<?php
App::uses('AppModel', 'Model');
/**
 * Calle Model
 *
 */
class Calle extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar una Descripción'
			),
		)
	);
}
