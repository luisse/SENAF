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
var encontrado = false;
var oid=0;
$(document).ready(function(){
	cargarEventoFilas();})

function cargarEventoFilas(){
	$('#cancelar').click(function(){window.history.back()})
	showmessage();
	$('#PersonaNrodoc').numeric()
	$('#PersonaNrodoc').change(function(){buscarpersona()})
	$('#buscar').click(function(){ buscarpersona() });	
	$('#ejecexiste').click(function(){ ejecexiste() });
	$('#PersonaApellido').attr('readonly',true)
	$('#PersonaNombre').attr('readonly',true)	
	$('#ejecutarconsulta').hide(1)
	$('#modalview').on('hidden.bs.modal', function () {
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
	})	
	$('#personasel').click(function(){buscarpersonamodal('')});
}

function ejecexiste(){
	if(!validarexistepersona()){
		$().toastmessage('showToast', {
			text     : 'Debe Seleccionar Personas para la Busqueda',
			sticky   : false,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {}
		});				
		return
	}
	reloadList(link)
	
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


function buscarpersona(){
	var personanrodoc = $('#PersonaNrodoc').val()
	if(typeof(personanrodoc)!='undefined' && personanrodoc != '' ){
		serialize=$('#personafilter').serialize()
		$('#cargandodatos').show(1)
		$.ajax({type:'GET',
			  url:'/senayf/personas/getpersona',
			  type:'POST',
			  data:serialize,
			  datatype:'xml',
			  success:function(data){
					  var xml;
					  var options = '';
					  var encontrado = false;	
					  xml = data;
					  $(xml).find('datos').each(function(){
							  //Cargamos el drow dow con las provincias
								var li_id = $(this).find('id').text()
								var ls_apellido = $(this).find('apellido').text()
								var ls_nombre =$(this).find('nombre').text()
								var li_sexo = $(this).find('sexo').text()
								var docper = $('#PersonaNrodoc').val()
								encontrado = true
								if(!existeasignada(li_id)){
									var row ='<td><input type="hidden" id="Asigper'+oid+'PersonaId" name="data[Asigper]['+oid+'][persona_id]" value="'+li_id+'"><code><strong>'+docper+'-'+ls_apellido+', '+ls_nombre+'</strong></code></td><td>&nbsp;</td><td><button type="button" class="btn btn-danger btn-lw" title="Borrar Fila" onclick="eliminarFila('+oid+')"><span class="glyphicon  glyphicon-remove-circle"></span></button></td>'
									var strHtml = "<tr id='personas_"+oid+"'></tr>"
									$("#personas").append(strHtml)
									$("#personas_"+oid).append(row)
										$('#ejecutarconsulta').show(1)
								}else{
						    		$().toastmessage('showToast', {
										text     : 'Ya se encuentra asignada la persona',
										sticky   : false,
										position : 'top-right',
										type     : 'error',
										closeText: '',
										close    : function () {}
						    		});				
								}
								$('#PersonaNrodoc').val('')
								$('#PersonaApellido').val('')
								$('#PersonaNombre').val('')
								$('#PersonaNrodoc').focus()
								oid++
								
								//$().toastmessage('showSuccessToast', "Producto Agregado...");
					  });//close each
					  
					  if(!encontrado){
				    		$().toastmessage('showToast', {
								text     : 'No se encontro la persona en el sistema',
								sticky   : false,
								position : 'top-right',
								type     : 'success',
								closeText: '',
								close    : function () {}
				    		});				
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
		}).always(function() {
			$('#cargandodatos').hide(1)
		});//close ajax
	}else{
		$().toastmessage('showToast', {
			text     : 'Debe Ingresar el Documento.',
			sticky   : false,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {}
		});				
		
	}

}

/*
 * Funcion: permite cargar el proceso de seguimiento de las personas cargadas
 * */

function reloadList(rlink){
	serialize=$('#personaexiste').serialize()
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
	})
}

/*
 * Funcion: permite visualizar el detalle de un domicilio
 * */

function verDomicilio(id){
	$('#modalview').modal({
			show: true,
			remote: '/domicilios/view/'+id
	});			
	return false
}

/*
 * Funcion: permite visualizar el detalle de una personas
 * */

function verPersona(id){
	$('#modalview').modal({
			show: true,
			remote: '/personas/view/'+id
	});			
	return false

}

/*
 * Funcion: permite eliminar una fila
 * */
function eliminarFila(row){
	$("#personas_" +row).remove();
	reloadList(link)
	return false;
}

/*
 * Funcion: permite determinar si existen cargadas personas
 * */

function validarexistepersona(){
	for(i = 0;i<=oid;i++){
		//incrementamos el producto en uno para la cantidad
	  	persona_id = $('#Asigper'+i+'PersonaId').val()

	  	if((typeof(persona_id) != 'undefined' && persona_id != '')){
	  		return true	
	  	}
	}
	return false
}

/*
 * Funcion: permite determinar si la persona esta asignada
 * */
function existeasignada(apersona_id){
	for(i = 0;i<=oid;i++){
		//incrementamos el producto en uno para la cantidad
	  	persona_id = $('#Asigper'+i+'PersonaId').val()

	  	if((typeof(persona_id) != 'undefined' && persona_id == apersona_id)){
	  		return true	
	  	}
	}
	return false
}

function buscarpersonamodal(row){
	$('#modalview').modal({
		show: true,
		remote: '/personas/seleccionapersona/'+row
	});	
}

/******
function buscarpersona(){
	var personanrodoc = $('#PersonaNrodoc').val()
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
								var li_nrodoc = $(this).find('nrodoc').text()
								var ls_apellido = $(this).find('apellido').text()
								var ls_nombre =$(this).find('nombre').text()
								var li_cper = $(this).find('cper').text()
								var docper = $('#PersonaNrodoc').val()
								

									encontrado = true
									$('#PersonaFnac').focus()
									
									$('#PersonaId').val(li_id)
									$('#PersonaApellido').attr('readonly',true)
									$('#PersonaNombre').attr('readonly',true)
									$('#PersonaApellido').val(ls_apellido)
									$('#PersonaNombre').val(ls_nombre)

					  });//close each
					  if(!encontrado){
							$('#PersonaId').val('')
							$('#PersonaApellido').attr('readonly',false)
							$('#PersonaNombre').attr('readonly',false)
							//$('#PersonaFnac').attr('readonly',false)
							//$('#PersonaSexo').attr('readonly',false)
							//$('#PersonaEstcivileId').attr('readonly',false)						  
							//$('#PersonaApellido').val('')
							//$('#PersonaNombre').val('')
							//$('#PersonaFnac').val('')
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
		$('#PersonaId').val('')
		$('#PersonaApellido').attr('readonly',false)
		$('#PersonaNombre').attr('readonly',false)
		//$('#PersonaFnac').attr('readonly',false)
		//$('#PersonaSexo').attr('readonly',false)
		//$('#PersonaEstcivileId').attr('readonly',false)
	}

}****/
