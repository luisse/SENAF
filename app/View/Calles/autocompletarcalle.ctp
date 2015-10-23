<?php
	$autocompletar = array();
	$i=0;
	foreach($calles as $calle){
		$autocompletar[$i]['id'] = $calle['Calle']['id'];
		$autocompletar[$i]['name'] = utf8_encode($calle['Calle']['descrip']);
		$i=$i+1;
	}
	echo json_encode($autocompletar);
?>