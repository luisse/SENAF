<?php
App::uses('AppShell', 'Console');
?>

<?php class CorreoShell extends AppShell {
    var $uses = array('Mensajesmantenimiento');
    
    function startup() {
        App::import('Core', 'Controller');
        App::import('Component', 'Email');
		$this->Controller = new Controller();
        $this->Email =new EmailComponent(null);
        $this->Email->initialize($this->Controller);
        
    }
            
    function main() {
         $mensajesmantenimientos = $this->Mensajesmantenimiento->find('all',array('joins'=>array(array('table'=>'clientes',
																							'alias'=>'Cliente',
																							'type'=>'LEFT',
																							'conditions'=>array('Mensajesmantenimiento.cliente_id = Cliente.id')),
																							array('table'=>'users',
																							'alias'=>'User',
																							'type'=>'LEFT',
																							'conditions'=>array('Cliente.user_id = User.id'))),
																							'conditions'=>array('Mensajesmantenimiento.fechacontrol >= '."'".date('Y-m-d 00:00:00'),
																														'Mensajesmantenimiento.fechacontrol <= '."'".date('Y-m-d 23:59:59'),'Mensajesmantenimiento.enviarcorreo'=>1),
																							'fields'=>array('Mensajesmantenimiento.objetorevisar','Mensajesmantenimiento.observaciones',
																												'Cliente.nombre','Cliente.apellido','Cliente.sexo','User.email')
																							)
												);   
		foreach ($mensajesmantenimientos as $mensajesmantenimiento){
			if($mensajesmantenimiento['Mensajesmantenimiento']['enviarcorreo'] == 1){
				$this->Email->to = $mensajesmantenimiento['User']['email'];        
				$this->Email->subject = 'SENAyF  - Secretaria de Estado';
				$this->Email->from = 'tallercitobike@gmail.com';        
				$this->Email->template = 'prueba'; 
				$this->Email->sendAs = 'both';
				$this->Email->send();
			}
		}
    }	
?>