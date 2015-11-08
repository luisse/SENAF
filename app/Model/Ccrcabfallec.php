<?php
App::uses('AppModel', 'Model');
/**
 * Ccrcabfallec Model
 *
 * @property Ccrfallecido $Ccrfallecido
 */
class Ccrcabfallec extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
 /***
	public $hasMany = array(
		'Ccrfallecido' => array(
			'className' => 'Ccrfallecido',
			'foreignKey' => 'ccrcabfallec_id',
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
	***/
	/*
	* Funcion: antes de guardar es importante convertir la fecha al formato Unix/Mysql
	*/
	function beforeSave($options=array())
	{
		if(!empty($this->data['Ccrcabfallec']['fdde']))
			$this->data['Ccrcabfallec']['fdde'] = $this->formatDate($this->data['Ccrcabfallec']['fdde']);
		if(!empty($this->data['Ccrcabfallec']['fhta']))
			$this->data['Ccrcabfallec']['fhta'] = $this->formatDate($this->data['Ccrcabfallec']['fhta']);

		return true;
	}

}
