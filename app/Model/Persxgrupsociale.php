<?php
App::uses('AppModel', 'Model');
/**
 * Persxgrupsociale Model
 *
 * @property Persona $Persona
 * @property Grupsociale $Grupsociale
 * @property Persxoficina $Persxoficina
 */
class Persxgrupsociale extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Persona' => array(
			'className' => 'Persona',
			'foreignKey' => 'persona_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Grupsociale' => array(
			'className' => 'Grupsociale',
			'foreignKey' => 'grupsociale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	public function actualizargruposocial($grupoborrar=null,$grupoagregar=null){
		$datasource = $this->getDataSource();
		$this->create();
		$datasource->begin($this);
		//borramos los cambios anteriores
		if(!empty($grupoborrar)){
			foreach($grupoborrar as $grupo){
				$persxgruposociale = $this->find('first',array('conditions'=>array('Persxgrupsociale.grupsociale_id'=>$grupo['Grupsociale']['id'],
															'Persxgrupsociale.persona_id'=>$grupo['Grupsociale']['persona_id'])));
				if(!empty($persxgruposociale)){		
					if(!$this->delete($persxgruposociale['Persxgrupsociale']['id'])){
						$datasource->rollback($this);
						return false;
					}				
				}
			}
		}
		//agregamos los cambios
		if(!empty($grupoagregar)){
			foreach($grupoagregar as $grupo){
				$this->create();
				$persxgrupsociale['Persxgrupsociale']['grupsociale_id']=$grupo['Grupsociale']['id'];
				$persxgrupsociale['Persxgrupsociale']['persona_id']=$grupo['Grupsociale']['persona_id'];
				$persxgrupsociale['Persxgrupsociale']['usuariocrea']=$grupo['Grupsociale']['usuariocrea'];
				$persxgrupsociale['Persxgrupsociale']['ipcrea']=$grupo['Grupsociale']['ipcrea'];
				if(!$this->save($persxgrupsociale)){
					$datasource->rollback($this);
					return false;
				}
			}
		}	
		$datasource->commit($this);
		return true;
	}
}
