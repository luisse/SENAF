<?php
/*
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>
*    @author Luis Sebastian oppe
*    @Fecha 15/12/2010
*    @use Librerias de AJAX para seleccion de usuarios
*/

class AccesorapidosController extends AppController{
	var $name='Accesorapidos';
	var $components=array('RequestHandler','Paginator');
	var $uses=array('Accesorapido');

	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	function index(){
		//$tallercito = $this->Session->read('tallercito');
		$this->set('title_for_layout','Sistema - SENAF');
		/*Totales de Bicicleta a reparar*/
		$filter='';
		$filtermensajesmant='';
		$mensajeservicependientes=0;
		$bicienespera=0;
		$bicientaller=0;
		$biciconfirmar=0;
		$mensajesmant=0;
		$this->set('mensajesmant',$mensajesmant);
		$this->set('bicienespera',$bicienespera);
		$this->set('bicientaller',$bicientaller);
		$this->set('biciconfirmar',$biciconfirmar);
	}
	
	function ejemplobootstrap(){
		$this->layout='bootstrap3';
	
	}
	
	function listarclientes(){
		$this->layout='bootstrap3';
		$this->set('clientes',$this->Cliente->find('all'));
	}
	
	function beforeFilter(){
	   parent::beforeFilter();
	   $this->Auth->allow('index', 'view');
	}
}
?>