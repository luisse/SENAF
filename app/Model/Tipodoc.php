<?php
App::uses('AppModel', 'Model');
/**
 * Tipodoc Model
 *
 */
class Tipodoc extends AppModel {

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
				'rule' => array('maxLength',55),
				'message' => 'La descripción debe tener menos de 55 caracteres'
			),
		),
		'descred' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el Sintetico'
			),
			'maxLength' => array(
				'rule' => array('maxLength',15),
				'message' => 'El sintetico debe tener menos de 15 caracteres'
			),
		),
	);
}
