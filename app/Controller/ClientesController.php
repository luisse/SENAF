<?php
class ClientesController extends AppController {

	var $name = 'Clientes';
	var $uses = array('Cliente','Movimiento');
	var $components = array('Paginator','Session','Cimage');
	var $helpers = array('Html','Form','Time');

	public function index() {
		$this->layout = 'bootstrap3';
		$this->Cliente->recursive = 0;
		$this->paginate=array('limit' => 2,
						'page' => 1,
						'order'=>array('Cliente.nombre'=>'desc'),
						'conditions'=>'');				
		
		$this->set('clientes', $this->paginate());
	}

	public function view($id = null) {
		$this->layout = 'bmodalbox';
		if (!$id) {
			$this->Session->setFlash(__('Cliente Invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		$js_funciones=array('view');
		$this->set('js_funciones',$js_funciones);
		$this->set('cliente', $this->Cliente->read(null, $id));
	}

	public function add() {
		$this->layout='bootstrap3';
		if (!empty($this->data)) {
			$this->Cliente->create();
				$this->request->data['Cliente']['tallercito_id']=$this->Session->read('tallercito_id');
				$this->request->data['Cliente']['user_id']=$this->Session->read('user_id');
				$result = $this->Cliente->GuardarCliente($this->request->data);
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash(__('No se pudo Guardar el Cliente ', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Cliente no se pudo grabar. Intente nuevamente.', true));
			}
		}
	}

	public function edit($id = null) {
		$this->layout='bootstrap3';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Cliente invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			$this->request->data['Cliente']['documento']=str_replace('.', '', $this->request->data['Cliente']['documento']);;
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('Actualización de Datos del Cliente correcta', true));
				$this->redirect(array('controller' => 'users','action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar el Cliente. Por favor intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cliente->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Cliente Invalido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cliente->delete($id)) {
			$this->Session->setFlash(__('Cliente Borrado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('No se pudo borrar el Cliente', true));
		$this->redirect(array('action' => 'index'));
	}
	
	public function getclient($documento= null){
		$this->layout='';
		$documento = str_replace('.','',$documento);
		$clientes=$this->Cliente->find('all',array('conditions'=>array('documento'=>$documento),
																'fields'=>array('id','documento','nomape','User.email','telefono','domicilio')));
		$this->set('clientes',$clientes);
	}
	
	public  function seleccionarcliente(){
		$this->layout = 'bmodalbox';
	}
	
	public function seleccionarclientemov(){
		$this->layout = 'bmodalbox';
	}

	public function seleccionarclientegrupo($rowpos = null){
		$this->layout = 'bmodalbox';
		$this->set('rowpos',$rowpos);
	}
	
	public function listarclientes(){
			$this->layout = '';
			$ls_filtro = '1=1 ';
			if(!empty($this->request->data)){
				if($this->request->data['Cliente']['Documento']!= null &&
					$this->request->data['Cliente']['Documento']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.documento = '.str_replace('.', '', $this->request->data['Cliente']['Documento']);
				if($this->request->data['Cliente']['Nombre']!= null &&
					$this->request->data['Cliente']['Nombre']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.nombre like "%'.$this->request->data['Cliente']['Nombre'].'%"';
				if($this->request->data['Cliente']['Apellido']!= null &&
					$this->request->data['Cliente']['Apellido']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.apellido  like "%'.$this->request->data['Cliente']['Apellido'].'%"';
			}
			$clientes = $this->Cliente->find('all',array('conditions'=>$ls_filtro));
			$this->paginate=array('limit' => 6,
						'page' => 1,
						'order'=>array('Cliente.apellido,Cliente.nombre'=>'desc'),
						'conditions'=>array($ls_filtro,'Cuenta.tallercito_id'=>$this->Session->read('tallercito_id')),
						'fields'=>array('Cliente.id','Cliente.documento','Cliente.fechanac','Cliente.nombre','Cliente.apellido','Cuenta.id'),
						'joins'=>array(array('table'=>'cuentas',
													'alias'=>'Cuenta',
													'type'=>'LEFT',
													'conditions'=>array('Cuenta.cliente_id=Cliente.id'))));				
			$this->set('clientes', $this->paginate());
	}
	
	/*
	 * @funcion: permite grabar siempre el lugar dónde es llamado el objeto
	 * */
	public function beforeRender(){
			$this->Session->Write('LLAMADO_DESDE','clientes');
		
	}
	
	public function editimage(){
		if ($this->request->is(array('post', 'put'))) {
			$cliente = $this->Cliente->read(null, $this->request->data['Cliente']['id']);
			$cimage = new CimageComponent(new ComponentCollection());			
			/*imagen tamanio normal*/
			$fileData = $cimage->ImagenToBlob($this->request->data['Cliente']['imgcliente']['tmp_name'],200,400);
			if($fileData != -1){
				$cliente['Cliente']['foto'] = $fileData;
			}
			if ($this->Cliente->save($cliente)) {
				$this->Session->setFlash(__('Los Datos han sido guardado.'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
			}
			$this->redirect(array('controller' => 'users','action'=>'edit',$this->request->data['Cliente']['user_id']));
		}			
	}
	
	public function mostrarfoto($id=null){
		$cliente = $this->Cliente->find("first",array('fields'=>
												array('Cliente.foto'),
												'conditions'=>array('Cliente.id'=>$id)));
		if(!empty($cliente)){
			$cimage = new CimageComponent(new ComponentCollection());	
			$cimage->view($cliente['Cliente']['foto'],'jpg');
		}
	}
	
	public function clientedeuda(){
		$this->set('title_for_layout','Listado de Deudas de Clientes');
		
	}
	
	public function listarclientedeuda(){
			$this->layout = '';
			$ls_filtro = '1=1 ';
			if(!empty($this->request->data)){
				if($this->request->data['Cliente']['documento']!= null &&
					$this->request->data['Cliente']['documento']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.documento = '.str_replace('.', '', $this->request->data['Cliente']['documento']);
				if($this->request->data['Cliente']['nombre']!= null &&
					$this->request->data['Cliente']['nombre']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.nombre like "%'.$this->request->data['Cliente']['nombre'].'%"';
				if($this->request->data['Cliente']['apellido']!= null &&
					$this->request->data['Cliente']['apellido']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.apellido  like "%'.$this->request->data['Cliente']['apellido'].'%"';
			}
			$clientes = $this->Cliente->find('all',array('conditions'=>$ls_filtro));
			$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('Cliente.apellido,Cliente.nombre'=>'desc'),
						'conditions'=>$ls_filtro,
						'fields'=>array('Cliente.id','Cliente.documento','Cliente.fechanac','Cliente.nombre','Cliente.apellido','Cuenta.id'),
						'joins'=>array(array('table'=>'cuentas',
													'alias'=>'Cuenta',
													'type'=>'LEFT',
													'conditions'=>array('Cuenta.cliente_id=Cliente.id'))));				
			$clientes = $this->paginate();
			$i=0;
			foreach($clientes as $cliente){
				$saldo = $this->Movimiento->GetTotalCuenta($cliente['Cliente']['id']);
				$clientes[$i]['Cliente']['saldo']=$saldo;
				$i++;
			}
			$this->set('clientes', $clientes);
	}
}
?>