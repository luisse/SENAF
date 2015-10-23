<?php 
if(!empty($persona))
	$personas[0]=$persona;
	echo $this->element('retornaxml',array('datos'=>$personas,'modelo'=>'personas'))
?>