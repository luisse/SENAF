<?php
App::uses('AppModel', 'Model');
/**
 * Contactoxempresa Model
 *
 */
class Contactoxempresa extends AppModel {

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
		'empresa_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar la Empresa'
			),
		),
	);
}
