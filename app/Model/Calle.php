<?php
App::uses('AppModel', 'Model');
/**
 * Calle Model
 *
 */
class Calle extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'descrip' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar una Calle'
			),
			'calleUnique' => array(
				'rule' => array('calleUnique'),
				'message' => 'La Calle ya Existe',
				'on' => 'create' // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength',55),
				'message' => 'La Definición debe tener menos de 55 catacteres'
			)
		)
	);
	
	public function calleUnique(){
		$count = $this->find('count',array('conditions'=>array("Upper(descrip) like Upper('%".$this->data['Calle']['descrip']."%')")));
		if($count > 0)
			return false;
		else
			return true;
	}
	
	public function retornaidcalle($callenombre = null){
		if(!empty($callenombre)){
			$calle = $this->find('first',array('conditions'=>array('Calle.descrip'=>$callenombre)));
			if(!empty($calle)){
				return $calle['Calle']['id'];
			}
		}
		return 0;
	}
	
}
