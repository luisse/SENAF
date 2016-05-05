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
	$("#PersonaFnac").datetimepicker({pickTime: false,language:'es'});
	fechaactual('PersonaFnac');
	$('#PersonaNrodoc').numeric();
	$('#PersonaNn').change(function(){
		if($(this ).val() == 1){
			fechaactual('PersonaFnac');		
			$('#PersonaTipodocId').val('0')
			$('#PersonaApellido').val('--')
			$('#PersonaNombre').val('--')
			$('#PersonaNrodoc').val('0')
			$('#PersonaEmail').val('nn@gmail.com')
			$('#PersonaTipodocId').attr('readonly',true)
			$('#PersonaNrodoc').attr('readonly',true)
			$('#PersonaEmail').attr('readonly',true)
		}else{
			$('#PersonaNrodoc').attr('readonly',false)
			$('#PersonaEmail').attr('readonly',false)
			$('#PersonaTipodocId').attr('readonly',false)
		}
	})
	$('#DomicilioPaiseId').change(function(){
		cargardropdown('DomicilioPaiseId','/provincias/retornalxmlprovincias/','DomicilioProvinciaId')
	})
	
	$('#DomicilioProvinciaId').change(function(){
		cargardropdown('DomicilioProvinciaId','/deptos/retornalxmldeptos/','DomicilioDeptoId')
	})

	$('#DomicilioDeptoId').change(function(){
		cargardropdown('DomicilioDeptoId','/municipios/retornalxmldeptos/','DomicilioMunicipioId')
	})	
	
	$('#DomicilioMunicipioId').change(function(){
		cargardropdown('DomicilioMunicipioId','/localidades/retornalxmllocalidades/','DomicilioLocalidadeId')
	})	
	
	$('#DomicilioLocalidadeId').change(function(){
		//cargardropdown('DomicilioLocalidadeId','/barrios/retornalxmlbarrios/','DomicilioBarrioId')
	})		

	$("#DomicilioCalleId").typeahead({
		   source: function (query, process) {
				return $.getJSON(
					'/calles/autocompletarcalle/'+query,
					function (data) {
						var newData = [];
						$.each(data, function(){
							newData.push(this.name);
						});
						return process(newData);
					});
			}

		})
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
	$('#PersonaImage').change(function(){mostrarVistaPrevia()})	
	if(!hasGetUsermedia()){
		alert('El Navegador no soporta la web Cam');
	}else{
		$('#example').photobooth()
		$('#sacarfoto').click(function(){
			$('.trigger').click()
		})
		$('#example').on("image",function( event, dataUrl ){
			$( "#gallery" ).html('');
			$( "#gallery" ).append( '<img src="' + dataUrl + '" >');
			//$("#PersonaFoto").val(dataUrl.substr(22,dataUrl.lenght))
			$("#PersonaFoto").val(dataUrl)
		});		
	}
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	var fechanac = $("#PersonaFnac").val()
	var fechaactual = new Date();
	var st_fechaactual = fechaactual.getDate()+'/'+(fechaactual.getMonth()+1)+'/'+fechaactual.getFullYear()
	var isnn = $('#PersonaNn').val()
	var personadetalle = $('#PersonaDetalle').val()
	//SOLO VALIDA CUANDO LA PERSONA ES UN NN
	if(isnn == 1){
		if(personadetalle == '' || typeof(personadetalle)=='undefined'){
			$().toastmessage('showToast', {
					text     : 'Debe Ingresar el Detalle de la persona para personas NN',
					sticky   : true,
					position : 'top-center',
					type     : 'error',
					closeText: '',
					close    : function () {
					}
				});				
			return
		}
	}
	
	if(validafechasAll(fechanac,st_fechaactual) < 0){
		$().toastmessage('showToast', {
			text     : 'La Fecha de Nacimiento debe ser menor o igual a la Fecha Actual '+st_fechaactual,
			sticky   : true,
			position : 'top-center',
			type     : 'error',
			closeText: '',
			close    : function () {
			}
		});	
		return
	}else{
		$('form#PersonaAddForm').submit()
	}
	
}

function hasGetUsermedia(){
	return !!(navigator.getUserMedia || 
				navigator.webkitGetUserMedia  || 
				navigator.mozGetUserMedia || 
				navigator.msGetUserMedia);
}


function mostrarVistaPrevia() {
    var Archivos, Lector;
	//Para navegadores antiguos
    if (typeof FileReader !== "function") {
		$().toastmessage('showToast', {
			text     : 'Vista Previa no disponible',
			sticky   : true,
			position : 'top-center',
			type     : 'error',
			closeText: '',
			close    : function () {
			}
		});	
        return;
    }

    Archivos = $('#PersonaImage')[0].files;
    if (Archivos.length > 0) {
        Lector = new FileReader();
        Lector.onloadend = function(e) {
            var origen, tipo;
            //Envia la imagen a la pantalla
            origen = e.target; //objeto FileReader
            //Prepara la información sobre la imagen
            tipo = obtenerTipoMIME(origen.result.substring(0, 30));
            //Si el tipo de archivo es válido lo muestra, 
            //sino muestra un mensaje 
            if (tipo !== 'image/jpeg' && tipo !== 'image/png' && tipo !== 'image/gif') {
				$().toastmessage('showToast', {
					text     : 'El formato de imagen no es válido: debe seleccionar una imagen JPG, PNG o GIF.',
					sticky   : true,
					position : 'top-center',
					type     : 'error',
					closeText: '',
					close    : function () {
					}
				});	
            } else {
				$( "#getfoto" ).html('');
				$( "#getfoto" ).append( '<img width="250px" height="250px" src="' + origen.result + '" >');
				$("#PersonaFoto").val(origen.result)
            }
        };
        Lector.onerror = function(e) {
            console.log(e)
        }
        Lector.readAsDataURL(Archivos[0]);

    } else {
    };
}

function obtenerTipoMIME(cabecera) {
    return cabecera.replace(/data:([^;]+).*/, '\$1');
}
