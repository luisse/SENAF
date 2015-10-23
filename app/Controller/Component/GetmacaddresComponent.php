<?php 
App::uses('Component', 'Controller');
class GetmacaddresComponent extends Component{
	
    function startup(Controller $controller){ 
       // $this->user = $this->Auth->user(); 
    } 
	
	
	public function getmacaddress($ip_cliente=null){
		$macaddres='';
		if(!empty($ip_cliente)){
			$arp=`arp -n`;
			$lines=explode("\n", $arp);
			echo $ip_cliente;
			
			#look for the output line describing our IP address
			foreach($lines as $line)
			{
			   $cols=preg_split('/\s+/', trim($line));
			   if ($cols[0]==$ip_cliente)
			   {
			       $macaddres=$cols[2];
			   }
			}
		}
		return $macaddres;
	}

} 
?>