<?php 
if(!empty($personas))
	echo $this->element('retornaxml',array('datos'=>$personas,'modelo'=>'personas'))
?>