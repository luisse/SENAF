<?php
App::uses('AppModel', 'Model');
/**
 * Contrato Model
 *
 */
class Contrato extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tipocontrato_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Seleccionar el tipo de Contraro'
			),
		),
		'celebrado' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'La Fecha no es Correcta'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Fecha de Celebrado'
			),
		),
		'caduca' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'La Fecha no es Correcta'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Fecha de Caducidad'
			),
		),
		'titulo' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el título'
			),
		),
		'encabezado' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el encabezado'
			),
		),
		'pie' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el pie'
			),
		),
	);
}
