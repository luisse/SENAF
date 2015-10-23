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
*    @Fecha 24/01/2014
*    @use Librerias de AJAX para administrar alta de usuarios
*/


$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	var fnac=$('#PersonaFnac').val()
	$("#PersonaFnac").datetimepicker({pickTime: false,language:'es'});

	if(typeof($('#PersonaFnac').val())=='undefined' ||
		$('#PersonaFnac').val()=='')
		fechaactual('PersonaFnac');
	else
		$('#PersonaFnac').val(fnac)	
	fechaactual('PersonaFechaactual');	

	//$('#PersonaNrodoc').mask('99.999.999',{placeholder:" "});
	$('#PersonaNrodoc').numeric()
	$('#PersonaNrodoc').change(function(){buscarpersona()})
	$('#ocultar').hide(1)
	//errores en form si tiene el usuario inhabilitamos datos del usuario
	buscarpersona()
	persona_id=$('#PersonaId').val()
	if(typeof(persona_id)!='undefined' && persona_id!=''){
		$('#PersonaApellido').attr('readonly',false)
		$('#PersonaNombre').attr('readonly',false)
		$('#PersonaFnac').attr('readonly',false)
		$('#PersonaSexo').attr('readonly',false)
		$('#PersonaEstcivileId').attr('readonly',false)	
	}
	
	$('#PersonaNombre').change(function(){
		var nombre = $('#PersonaNombre').val()
		var apellido = $('#PersonaApellido').val()
		var nombre_array = nombre.split(' ')
		var cicly = nombre_array.length
		var username=''
		for(i=0;i < cicly;i++){
			username = username+nombre_array[i][0]
		}
		
		if(typeof(apellido)!='undefined' && apellido != ''){
			username = username+apellido
			$('#UserUsername').val(username.toLowerCase())
		}
		
	})
	
	//$('#ClienteDocumento').numeric()
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	var result = validafechas('#PersonaFnac','#PersonaFechaactual')
	var edad = diasfecha($('#PersonaFnac').val())/365
	if(result == -5){
			$().toastmessage('showToast', {
				text     : 'La Fecha de Nacimiento debe ser menor a la fecha actual.',
				sticky   : true,
				position : 'top-center',
				type     : 'error',
				closeText: '',
				close    : function () {}
			});			

			return false
		
	}
	if(edad < 18){
			$().toastmessage('showToast', {
				text     : 'El Alta de Usuario es posible para personas mayores de 18 años',
				sticky   : true,
				position : 'top-center',
				type     : 'error',
				closeText: '',
				close    : function () {}
			});			
			return false
	}
	$('form#UserAddusuarioForm').submit()
}

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
								var ld_fnac = $(this).find('fnac').text()
								var ls_apellido = $(this).find('apellido').text()
								var ls_nombre =$(this).find('nombre').text()
								var li_sexo = $(this).find('sexo').text()
								var li_estcivile_id=$(this).find('estcivile_id').text()
								var li_cper = $(this).find('cper').text()
								
								var docper = $('#PersonaNrodoc').val()
								

								if(parseInt(li_cper) == 0){
									encontrado = true
									$('#PersonaFnac').focus()
									ld_fnac=formateafechastr(ld_fnac)
									
									$('#PersonaId').val(li_id)
									$('#PersonaApellido').attr('readonly',true)
									$('#PersonaNombre').attr('readonly',true)
									$('#PersonaFnac').attr('readonly',true)
									$('#PersonaSexo').attr('readonly',true)
									$('#PersonaEstcivileId').attr('readonly',true)
									
									$('#PersonaApellido').val(ls_apellido)
									$('#PersonaNombre').val(ls_nombre)
									$('#PersonaFnac').val(ld_fnac)
									$('#PersonaSexo').val(li_sexo).attr("selected", "selected");
									$('#PersonaEstcivileId').val(li_estcivile_id).attr("selected", "selected");
									$('#PersonaNrodoc').focus()
									$('#PersonaFnac').focus()
								}else{
						    		$().toastmessage('showToast', {
										text     : 'La Persona ya posee un usuario en el sistema.',
										sticky   : false,
										position : 'top-center',
										type     : 'error',
										closeText: '',
										close    : function () {}
									});	
						    		$('#PersonaNrodoc').val('')
						    		$('#PersonaNrodoc').focus()
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
		$('#PersonaId').val('')
		$('#PersonaApellido').attr('readonly',false)
		$('#PersonaNombre').attr('readonly',false)
		$('#PersonaFnac').attr('readonly',false)
		$('#PersonaSexo').attr('readonly',false)
		$('#PersonaEstcivileId').attr('readonly',false)
	}

}

