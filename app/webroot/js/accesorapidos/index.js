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
*    @author Oppe Luis Sebastian
*    @Fecha 23/04/2014
*    @use Librerias de AJAX  user control library
*/

$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	$('#buscar').click(function(){
		BuscarPersona(peopleseach)
	});
	$('#PersonaBuscar').keypress(function (event) {
	      if (event.keyCode == 10 || event.keyCode == 13) {
    	    BuscarPersona(peopleseach)
	        event.preventDefault();
	      }
	});
	/****$('#modalview').on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})	
	$('#centaller').hide(1);
	$('#cespera').hide(1);
	$('#cconfirma').hide(1);
	$('#mensajesmant').hide(1);
	$('#viewinformation').hide(1);
	
	$('#modalview').on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})
	
	$('#confirmar').click(function(){
							$('#viewinformation').show(1)
							$('#centaller').hide(1);
							$('#cespera').hide(1);
							$('#cconfirma').show(1);
							$('#mensajesmant').hide(1);
							$('#mensajeservice').hide(1);
							CargarBicicletas('informacion',2);
							return false;})
							
	$('#entaller').click(function(){
			$('#viewinformation').show(1)		
			$('#centaller').show(1);
			$('#cespera').hide(1);
			$('#cconfirma').hide(1);
			$('#mensajesmant').hide(1);
			$('#mensajeservice').hide(1);
			CargarBicicletas('informacion',1);
			return false;})
			
	$('#espera').click(function(){
		$('#viewinformation').show(1)		
		$('#centaller').hide(1);
		$('#cespera').show(1);
		$('#cconfirma').hide(1);
		$('#mensajesmant').hide(1);
		$('#mensajeservice').hide(1);
		CargarBicicletas('informacion',0); 
		return false;})
		
		$('#mantenimiento').click(function(){
			$('#viewinformation').show(1)
			$('#centaller').hide(1);
			$('#cespera').hide(1);
			$('#cconfirma').hide(1);
			$('#mensajesmant').show(3);
			$('#mensajeservice').show(3);
			CargarMensajes(rmensajesmantenimiento);
			//mensajes de servicio tecnico			
			MostrarMensajes();
			return false;})****/
}


function BuscarPersona(rlink){
	var serialize=$('#buscarpersona').serialize()
	//alert(serialize)
	$('#cargandodatos').show(1)
	$.post(rlink,serialize,
			function(data) {
			$('#resultsearch').html(data);
			var divPaginationLinks = '#resultsearch '+" .pagination a"; 
			$(divPaginationLinks).click(function(){
				var thisHref = $(this).attr("href");
				BuscarPersona(thisHref);
				//recarmamos el proceso de carga
				return false;
			});
	}).always(function() {
		$('#cargandodatos').hide(1)
	});
}

/**function verBicicleta(id){
	$('#modalview').modal({
			show: true,
			remote: '/bicicletas/view/'+id
	});			
	return false
}

function CargarBicicletas(iddiv,estado){
	var serialize = null;
	$.post(rbicicletaslink+'/'+estado,serialize,
			function(data) {
				$('#'+iddiv).html(data);
	})
}

function CargarMensajes(rlink){
	var serialize
	$.post(rlink,serialize,
			function(data) {
		$('#informacion').html(data);
		var divPaginationLinks = '#informacion '+" .pagination a"; 
		$(divPaginationLinks).click(function(){
			var thisHref = $(this).attr("href");
			CargarMensajes(thisHref);
			//recarmamos el proceso de carga
			return false;
		});
	})
	
}

function MostrarMensajes(){
	var serialize = null;
	if($('#mensajes').length){
		$.post('/mensajeservices/mostrarmensajecliente/',serialize,
				function(data) {
					$('#mensajes').html(data);
		})
	}
}

function verCliente(id){
		$('#modalview').modal({
			show: true,
			remote: '/clientes/view/'+id
		});			
		return false
}***/