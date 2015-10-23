<?php
App::uses('AppModel', 'Model');
/**
 * Tipoempresa Model
 *
 */
class Tipoempresa extends AppModel {

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
		),
	);
}
