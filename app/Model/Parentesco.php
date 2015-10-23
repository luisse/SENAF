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
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la descripción'
			),
			'maxLength' => array(
				'rule' => array('maxLength',50),
				'message' => 'La Descripción debe tener menos de 50 catacteres'
			),
			'descrUnique' => array(
				'rule' => array('descrUnique'),
				'message' => 'La Descripción ya Existe',
				'on' => 'create' // Limit validation to 'create' or 'update' operations
			)
		),
		'definicion' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Definición'
			),
			'maxLength' => array(
				'rule' => array('maxLength',700),
				'message' => 'La Definición debe tener menos de 700 catacteres'
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
	/**public $hasMany = array(
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
	);**/
	
	
	public function descrUnique(){
		$count = $this->find('count',array('conditions'=>array("Upper(descrip) like Upper('%".$this->data['Parentesco']['descrip']."%')")));
		if($count > 0)
			return false;
		else
			return true;
	}
}
