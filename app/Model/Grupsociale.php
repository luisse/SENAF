<?php
App::uses('AppModel', 'Model');
/**
 * Grupsociale Model
 *
 * @property Afinidade $Afinidade
 * @property Grupsocxdomi $Grupsocxdomi
 * @property Persxgrupsociale $Persxgrupsociale
 */
class Grupsociale extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'afinidade_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'La Afinidad debe ser un valor numerico'
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Debe Ingresar la Afinidad'
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Afinidade' => array(
			'className' => 'Afinidade',
			'foreignKey' => 'afinidade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Grupsocxdomi' => array(
			'className' => 'Grupsocxdomi',
			'foreignKey' => 'grupsociale_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Persxgrupsociale' => array(
			'className' => 'Persxgrupsociale',
			'foreignKey' => 'grupsociale_id',
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
	


	public function savegroupsociale($data=null){
		if(!empty($data)){
			ClassRegistry::init('Persxgrupsociale'); 
			$datasource = $this->getDataSource();
			$this->create();
			$datasource->begin($this);
			if($this->save($data)){
				$Persxgrupsociale = new Persxgrupsociale();
				$Persxgrupsociale->create();
				$persxgrupsociales['Persxgrupsociale']['grupsociale_id'] = $this->id;
				$persxgrupsociales['Persxgrupsociale']['persona_id'] = $data['Grupsociale']['persona_id'];
				$persxgrupsociales['Persxgrupsociale']['usuariocrea'] = $data['Persxgrupsociale']['usuariocrea'];
				$persxgrupsociales['Persxgrupsociale']['ipcrea'] = $data['Persxgrupsociale']['ipcrea'];
				if($Persxgrupsociale->Save($persxgrupsociales)){
					$datasource->commit($this);				
					return $this->id;
				}else{
					$datasource->rollback($this);
					return 0;		
				}
			}else{
				$datasource->rollback($this);
				return 0;		
			}
		}	
	}
}
