<?php 
App::uses('Component', 'Controller');
class AccessComponent extends Component{ 
    var $components = array('Acl', 'Auth'); 
    var $user; 
  
    function startup(Controller $controller){ 
        $this->user = $this->Auth->user(); 
    } 

	function check($aco, $action='*'){ 
		if(!empty($this->user) && 		
				$this->Acl->check(array(
				'model' => 'Group',       # The name of the Model to check agains
				'foreign_key' => $this->user['group_id'] # The foreign key the Model is bind to
				),$aco.'/'.$action)){ 
			return true; 
		} else { 
			return false; 
		} 
	}
} 
?>