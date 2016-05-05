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
*    @author <author>
*    @Fecha <fecha>
*    @use <USE DESCRIPCION>
*/

//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	cargarEventoFilas();})

function cargarEventoFilas(){
	var docper=$('#PersonaNrodoc').val()
	$('#cancelar').click(function(){window.history.back()})
	showmessage();
	//$('#PersonaNrodoc').mask('99.999.999',{placeholder:" "});
	$('#PersonaNrodoc').numeric()
	$('#buscar').click(function(){ reloadList(link,1) });	
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})	
	$('#personasel').click(function(){buscarpersonamodal('')});
	if(typeof(docper)!='undefined' && docper!=''){
		reloadList(link,1)
	}
	
}


function showmessage(){
	var message = $('#message').text();
	if(typeof(message) != 'undefined' && message.trim() != ''){
		$().toastmessage('showToast', {
				text     : message,
				sticky   : false,
				position : 'top-right',
				type     : 'success',
				closeText: '',
				close    : function () {
				}
			});	
	}
}

function reloadList(rlink,tipofiltro){
	serialize=$('#personafilter').serialize()
	$('#cargandodatos').show(1)
	$.post(rlink,serialize,
			function(data) {
				$('#seguimiento').html(data);
				var divPaginationLinks = '#seguimiento'+" .pagination a,.sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	}).always(function() {
		$('#cargandodatos').hide(1)
	});
}

function verDomicilio(id){
	$('#modalview').modal({
			show: true,
			remote: '/domicilios/view/'+id
	});			
	return false
}

function verPersona(id){
	$('#modalview').modal({
			show: true,
			remote: '/personas/view/'+id
	});			
	return false

}

function borrarDomicilio(gruposocxdomi_id){
	if(typeof(gruposocxdomi_id) != 'undefined'){
	    $.ajax({
	        url:'/grupsocxdomis/delete/'+gruposocxdomi_id, //URL del archivo php que procesa la petición. Se explica mas adelante
	        type:'post', // Los datos se envían mediante el método POST
	        dataType:'html', // La respuesta se obtiene como JSON
	    }).done(function(respuesta){
	        //Condición para verificar si se guardaron o no los datos
	        if( respuesta == '' ){
	            //alert("Se Elimino la persona del grupo");
	    		$().toastmessage('showToast', {
					text     : 'Domiclio Eliminado Satisfactoriamente',
					sticky   : false,
					position : 'top-right',
					type     : 'success',
					closeText: '',
					close    : function () {}
				});
	    		//sacamos el div del domicilio si eliminamos correctamente
	    		$('#dom'+gruposocxdomi_id).hide(1)
	        }else
	    		$().toastmessage('showToast', {
					text     : respuesta,
					sticky   : false,
					position : 'top-right',
					type     : 'success',
					closeText: '',
					close    : function () {}
	    		});				
	    	});
	}
}

function buscarpersonamodal(row){
	$('#modalview').modal({
		show: true,
		remote: '/senayf/personas/seleccionapersona/'+row
	});	
}
