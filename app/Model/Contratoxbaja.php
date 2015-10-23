<?php
App::uses('AppModel', 'Model');
/**
 * Contratoxbaja Model
 *
 */
class Contratoxbaja extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'contrato_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar el Contrato'
			),
		),
		'contratomobaja_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el motivo'
			),
		),
	);
}
