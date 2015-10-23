<?php
class Sale extends AppModel {
	var $name = 'Sale';
	var $validate = array(
		'saledate' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'La Fecha de Compra debe Tener Fecha y Hora'
			)
		),
		'totalsale' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'No se Encontro el total de la venta'
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'El total no puede ser vacio'
			)
		),
		'totaliva' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'El Total del Iva es invalido'
			),
		),
		'tipofactura' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Seleccionar el Tipo de Factura'
			)
		),
		'nrofactura' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El Nro de Factura solo permite números'
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar el Numero de Factura'
			),
		),
		'negocio_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'El negocio debe ser indicado'
			),
		),
		'fecha' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'La Fecha de Compra es Invalida'
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe Ingresar Fecha de Pago'
			),
		),
		'client_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Debe Ingresar el cliente'
			)
		),
	);
	
	var $hasMany = array(
		'Salesdetail' => array(
			'className' => 'Salesdetail',
			'foreignKey' => 'sale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Negocio' => array(
			'className' => 'Negocio',
			'foreignKey' => 'negocio_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	
	function beforeValidate($options = array()){
		$this->data['Sale']['fecha'] =  $this->formatDate($this->data['Sale']['fecha']);
	}
	
	/*
	 * Funcion: permite insertar una nueva venta
	 * */
	function savesale($data = null,$negocio_id = null){
		if(!empty($data)){
			$dataSource = $this->getDataSource();
			ClassRegistry::init('Numeradore');
			$Numeradore = new Numeradore();
			ClassRegistry::init('Movimiento'); 
			$Movimiento = new Movimiento();
			
			$this->create();
			//Save the head of de sale
			$result = $this->saveAssociated($data,array('atomic'=>true));
			if($result == 1){
				$result = $Numeradore->incrementarNumeradore($negocio_id,'FACTURA');
				//Generamos el movimiento si sale cliente_id no es nulo y tiene una deuda
				if(!empty($data['Sale']['cliente_id']) && $data['Sale']['cliente_id'] != 0 && 
					!empty($data['Sale']['montodeuda']) && $data['Sale']['montodeuda'] > 0 ){
					
					$Movimientos = array();
					$Movimientos['Movimiento']['cliente_id']	= $data['Sale']['cliente_id'];
					$Movimientos['Movimiento']['nrocomprobante'] = $data['Sale']['nrofactura'];
					$Movimientos['Movimiento']['importemov'] =  $data['Sale']['montodeuda'];
					$Movimientos['Movimiento']['typemovent_id'] = 1; //movimiento de credito
					$Movimientos['Movimiento']['negocio_id'] =$negocio_id;
   				    $Movimientos['Movimiento']['cliente_id'] =$data['Sale']['cliente_id'];
   				    $Movimientos['Movimiento']['fechahoramov'] =date('Y-m-d H:i:s');
   				    $mov = $Movimiento->GenerarMovimiento($Movimientos);
   				    if($mov != ''){
   				    	$dataSource->rollback($this);
   				    	return false;
   				    } 
				}	
				if($result == 0){
					$dataSource->commit($this);
					return true;
				}
			}
			$dataSource->rollback($this);
			return false;
		}
	}
	
	function totalsales($data = nul){
		ClassRegistry::init('Cliente');
		$cliente = new Cliente();
		$ls_filtro='1 = 1 ';
		$fieldName = 'Sale.fecha';
		if(!empty($data)){
			if($data['fecdesde'] != null && $data['fecdesde'] != '' && 
				$data['fechasta'] != null &&  $data['fechasta'] != ''){
				$ls_filtro = $ls_filtro.' AND ( '.$fieldName.' >= "'.
						$this->formatDate($data['fecdesde']).'" AND '.
						$fieldName.' <= "'.$this->formatDate($data['fechasta']).'" )'; 
			}
			//filtro por tipo de factura
			if($data['tipofactura'] != null && 
				$data['tipofactura']!=''){
				$ls_filtro = $ls_filtro.' AND tipofactura = "'.$data['tipofactura'].'"';	
			}
			//filtro por nombre de cliente
			if($data['clientenombre']!= '' && $data['clientenombre']!= null){
				$ls_filtro = $ls_filtro.' AND cliente_id = '.$cliente->ReadClientForName($data['clientenombre']);
			}
		}
		return $this->find('all',array('fields'=>array('sum(totalsale) AS totalsales'),'conditions'=>$ls_filtro));		
	}
	
}
?>