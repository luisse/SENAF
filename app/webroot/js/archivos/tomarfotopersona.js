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
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
		
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
			$("#ArchivoArchivo").val(dataUrl/*.substr(22,dataUrl.lenght)*/)
		});		
	}
	$('#ArchivoImage').change(function(){mostrarVistaPrevia()})
}

//Permite ejecutar el submit del formulario
function guardardatos(){
	var personafoto = $('#ArchivoArchivo').val()
	if(typeof(personafoto) == 'undefined' || personafoto == ''){
		$().toastmessage('showToast', {
			text     : 'Debe realizar una captura para guardar la imagen',
			sticky   : true,
			position : 'top-center',
			type     : 'error',
			closeText: '',
			close    : function () {
			}
		});	
		
	}else{
		$('form#ArchivoTomarfotopersonaForm').submit()
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

    Archivos = $('#ArchivoImage')[0].files;
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
				$( "#gallery" ).html('');
				$( "#gallery" ).append( '<img width="250px" height="250px" src="' + origen.result + '" >');
				//alert(origen.result)
				$("#ArchivoArchivo").val(origen.result/*.substr(22,origen.result.lenght)*/)
				//$("#ArchivoArchivo").val(origen.result)
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