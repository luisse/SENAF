<?php
App::uses('AppModel', 'Model');
/**
 * Tipofamilia Model
 *
 * @property Grupxfamilia $Grupxfamilia
 */
class Tipofamilia extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descripcion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar una descripción'
			),
			'maxLength' => array(
				'rule' => array('maxLength',45),
				'message' => 'Máxima Cantidad de Caracteres es de 45'
			),
		),
		'detalle' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar el detalle'
			),
			'maxLength' => array(
				'rule' => array('maxLength',255),
				'message' => 'Máxima Cantidad de Caracteres 255'
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Grupxfamilia' => array(
			'className' => 'Grupxfamilia',
			'foreignKey' => 'tipofamilia_id',
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
