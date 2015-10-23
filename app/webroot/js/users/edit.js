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
*    @author
*    @Fecha 18/12/2011
*    @use Librerias de AJAX para administrar alta de usuarios
*/


$(document).ready(function(){
	IniciarEventos();})

//Inicalizamos los eventos ajax
function IniciarEventos(){
	$('#myTab a:last').tab('show')
	$('#PersonaDocumento').attr('readonly',true)
	$('#PersonaNombre').attr('readonly',true)
	$('#PersonaFnac').attr('readonly',true)
	$('#PersonaEmail').attr('readonly',true)
	$('#PersonaApellido').attr('readonly',true)
	$('#PersonaTelefono').attr('readonly',true)
	$('#PersonaDomicilio').attr('readonly',true)
	$('#PersonaDpto').attr('readonly',true)
	$('#PersonaPiso').attr('readonly',true)	
	$('#PersonaBlock').attr('readonly',true)
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
	$('#actualizarfoto').click(function(){
		$('form#UserEditimageForm').submit()
	})	
	
    $('#UserPasswordc').keyup(function(){
        $('#mensajecontrola').html(validarpassword($('#UserPasswordc').val(),'mensajecontrola'))
    })	
	
	$('#actualizarpswd').click(function(){
		var passwordc	= $('#UserPasswordc').val()
		var passwordr	= $('#UserPasswordrepit').val()
		var contraseniafortaliza = validarpassword($('#UserPasswordc').val(),'mensajecontrola')
		if(contraseniafortaliza == 'Debil'){
			$().toastmessage('showToast', {
					text     : 'La Contraseña debe tener una fortaleza superior a Debil. para ello debe Ingresar letras y números',
					sticky   : true,
					position : 'top-center',
					type     : 'error',
					closeText: '',
					close    : function () {
						//console.log("toast is closed ...");
					}
				});	
		
			return;
		}		
		if(passwordc != passwordr){
			$().toastmessage('showToast', {
					text     : 'Las Contraseñas ingresadas no coinciden',
					sticky   : false,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {
						//console.log("toast is closed ...");
					}
				});	
			return;
		}
		$('form#UserCambiarcontraseniaForm').submit()
	})
	showmessage()
	$('#myTab li:eq(0) a').tab('show')
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
					//console.log("toast is closed ...");
				}
			});	
	}
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	$('form#UserEditForm').submit()
}