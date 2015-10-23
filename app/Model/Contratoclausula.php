<?php
App::uses('AppModel', 'Model');
/**
 * Contratoclausula Model
 *
 */
class Contratoclausula extends AppModel {

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
		'activa' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Solo se admite datos booleando true/false'
			),
		),
		'orden' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar el Orden'
			),
		),
		'letra' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Letra'
			),
		),
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Descripción'
			),
		),
		'monto' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el monto'
			),
		),
		'cantmax' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar la Cantidad Máxima'
			),
		),
	);
}
