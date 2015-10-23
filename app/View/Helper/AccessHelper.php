<?php 
App::uses('AppHelper', 'View/Helper');


class AccessHelper extends AppHelper{ 
   public $helpers = array("Session");
  
    public function isLoggedin(){
        App::import('Component', 'Auth');
        $auth = new AuthComponent();
        $auth->Session = $this->Session;
        $user = $auth->user();
        return !empty($user);
    }   
} 
?>