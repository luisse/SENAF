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


$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
	$('#TipdocxperNrodoc').numeric();
	showmessage();
}

function guardardatos(){
	existedoc();
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

function existedoc(){
	var persona_id=$('#TipdocxperPersonaId').val()
	var tipodoc_id=$('#TipdocxperTipodocId').val()
	var nrodoc=$('#TipdocxperNrodoc').val()
	$.ajax({
	    url:'/tipdocxpers/existetipdocper/'+persona_id+'/'+tipodoc_id+'/'+nrodoc, //URL del archivo php que procesa la petición. Se explica mas adelante
	    type:'post', // Los datos se envían mediante el método POST
	    dataType:'html', // La respuesta se obtiene como JSON
	}).done(function(respuesta){
	    //Condición para verificar si se guardaron o no los datos
	    if( respuesta == '1' ){
	        //alert("Se Elimino la persona del grupo");
			$().toastmessage('showToast', {
				text     : 'Ya Existe el Documento para la persona',
				sticky   : false,
				position : 'top-right',
				type     : 'error',
				closeText: '',
				close    : function () {}
			});
	    }else
	    	$('form#TipdocxperAddForm').submit()				
		});
}


function buscarpersona(){
	var personanrodoc = $('#TipdocxperNrodoc').val()
	if(typeof(personanrodoc)!='undefined' && personanrodoc != '' ){
		$.ajax({type:'GET',
			  url:'/personas/getperdoc/'+personanrodoc,
			  type:'POST',
			  datatype:'xml',
			  success:function(data){
					  var xml;
					  var options = '';
					  var encontrado = false;	
					  xml = data;
					  $(xml).find('datos').each(function(){
							  //Cargamos el drow dow con las provincias
								var li_id = $(this).find('id').text()
								var li_cper = $(this).find('cper').text()
								if(parseInt(li_cper) <> 0){
						    		$().toastmessage('showToast', {
										text     : 'La Persona ya posee un usuario en el sistema.',
										sticky   : false,
										position : 'top-center',
										type     : 'error',
										closeText: '',
										close    : function () {}
									});	
						    		$('#TipdocxperNrodoc').val('')
						    		$('#TipdocxperNrodoc').focus()
								}
								//$("#PersonaEstcivileId").val(li_estcivile_id).attr("selected", "selected");
								

					  });//close each
					  if(!encontrado){
							$('#PersonaId').val('')
							$('#PersonaApellido').attr('readonly',false)
							$('#PersonaNombre').attr('readonly',false)
							$('#PersonaFnac').attr('readonly',false)
							$('#PersonaSexo').attr('readonly',false)
							$('#PersonaEstcivileId').attr('readonly',false)						  
							$('#PersonaApellido').val('')
							$('#PersonaNombre').val('')
							$('#PersonaFnac').val('')
					  }
			  },
			  error:function(xtr,fr,ds){
		    		$().toastmessage('showToast', {
						text     : 'No se encontro la persona en el sistema. Verifique conexion al servidor.',
						sticky   : false,
						position : 'top-right',
						type     : 'error',
						closeText: '',
						close    : function () {}
		    		});				
	
			  }
		})//close ajax
	}else{
	}

}