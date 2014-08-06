<?php
App::uses('AppModel', 'Model');
/**
 * Parentesco Model
 *
 * @property Parentesco $ParentParentesco
 * @property Parentesco $ChildParentesco
 * @property Perparentesco $Perparentesco
 */
class Parentesco extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descripcion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la descripción'
			),
			'maxLength' => array(
				'rule' => array('maxLength',30),
				'message' => 'La Descripción debe tener menos de 30 catacteres'
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	/**public $belongsTo = array(
		'ParentParentesco' => array(
			'className' => 'Parentesco',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);**/

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Perparentesco' => array(
			'className' => 'Perparentesco',
			'foreignKey' => 'parentesco_id',
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
