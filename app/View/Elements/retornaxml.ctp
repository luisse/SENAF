<?php
//$content='xml version="1.0" encoding="iso-8859-1"';		
//header("Content-type: ".$content);
header("Content-type: text/xml");

?>
 <<?php echo $modelo?>>
 	<?php foreach($datos as $datos):?>
   <datos id='1' added="0">
 	<?php foreach($datos as $clave => $dato):?>
 		<?php foreach($dato as $clavev => $values):?>
	   	<<?php echo $clavev?>><?php echo $values ?></<?php echo $clavev?>>
	<?php endforeach;?><?php endforeach;?>	   	
   </datos>
   <?php endforeach;?>
</<?php echo $modelo?>>