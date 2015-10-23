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
*    @author oppeluis@gmail.com
*    @Fecha 27/10/2014
*    @use Funcion de agregar eventos para asociar personas
*/
var oId = 6;


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
	$('#modalview').on('hidden.bs.modal', function () {
		//$(this).removeData('bs.modal');
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
		
	})			
	showmessage();
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	EliminarFilasSinDatos()
	$('form#VinculoperAddForm').submit()	
}

function filaNueva(){
	$.ajax({type:'GET',
			url:'/vinculopers/agregarfila/'+oId,
			datatype:'html',
			success:function(data){
					var strHtml = "<tr id='vinculoper_"+oId+"'></tr>"
					$("#vinculopers").append(strHtml)
					$("#vinculoper_"+oId).append(data)
					$('.id').attr('readonly',true)
					$('.documento').attr('readonly',true)
					$('.nomape').attr('readonly',true)
					
					//inicializamos el filtro para la nueva fila
					oId++
				}
			})
}

function eliminarFila(fila){
	$("#vinculoper_" +fila).remove();	
	return false;
}

function buscarpersonamodal(row,donde){
	$('#modalview').modal({
		show: true,
		remote: '/personas/seleccionarpersonasvinculos/'+row+'/'+donde
	});	
}

function EliminarFilasSinDatos(){
	var i=0;
	for(i = 0;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	idizq = $('#Vinculoper'+i+'PersonaizqId').val()
    	  	iddcha = $('#Vinculoper'+i+'PersonadchaId').val()
    	  	if((typeof(idizq) == 'undefined' || idizq == '') &&
  	  			(typeof(iddcha) == 'undefined' || iddcha == '')){
				eliminarFila(i)
    	  	}
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

function validarregistro(personaizq_id,parentesco_id,personadcha_id){
	var i=0;
	for(i = 0;i<=oId;i++){
			//incrementamos el producto en uno para la cantidad
    	  	idizq = $('#Vinculoper'+i+'PersonaizqId').val()
    	  	iddcha = $('#Vinculoper'+i+'PersonadchaId').val()
    	  	parentesco_ida = $('#Vinculoper'+i+'ParentescoId').val()
    	  	if(idizq == personaizq_id && iddcha == personadcha_id && parentesco_ida == parentesco_id){
    	  		return true	
    	  	}
	}
	return false
}


