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
var oId = 6;
var existepers=false;
$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$('#agregarfila').click(function(){
			filaNueva()
			});
	$('.id').attr('readonly',true)
	$('.documento').attr('readonly',true)
	$('.nomape').attr('readonly',true)
	$('#guardar').click(guardardatos)
	$('#modalview').on('hidden.bs.modal', function () {
		//$(this).removeData('bs.modal');
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
		
	})			
	
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	EliminarFilasSinDatos()
	$('form#PersxoficinaAddForm').submit()	
}


function eliminarFila(fila){
	$("#persxoficina_" +fila).remove();	
	return false;
}


function filaNueva(){
	$.ajax({type:'GET',
			url:'/persxoficinas/agregarfila/'+oId,
			datatype:'html',
			success:function(data){
					var strHtml = "<tr id='vinculopers_"+oId+"'></tr>"
					$("#persxoficinas").append(strHtml)
					$("#persxoficina_"+oId).append(data)
					$('.id').attr('readonly',true)
					$('.documento').attr('readonly',true)
					$('.nomape').attr('readonly',true)
					
					//inicializamos el filtro para la nueva fila
					oId++
				}
			})
}

function buscarpersonamodal(row){
	$('#modalview').modal({
		show: true,
		remote: '/personas/seleccionarpersonasgrupo/'+row
	});	
}

function validaclienteid(idd){
	var i=0;
	for(i = 0;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	id = $('#Persxoficina'+i+'PersonaId').val()
    	  	if(id == idd){
				return true
    	  	}
	}
	return false
}

function EliminarFilasSinDatos(){
	var i=0;
	for(i = 0;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	id = $('#Persxoficina'+i+'PersonaId').val()
    	  	if((typeof(id) == 'undefined' || id == '')){
				eliminarFila(i)
    	  	}
	}
}

