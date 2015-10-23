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

// in your app create uploader as soon as the DOM is ready
// don't wait for the window to load
window.onload = createUploader;


function IniciarEventos(){
	//$('#guardar').click(guardardatos)
	//$('#cancelar').click(function(){window.history.back()})
	//showmessages()
	createUploader()
}

function createUploader(){
    var uploader = new qq.FileUploader({
        element: document.getElementById('file-uploader-demo1'),
        action: '/archivos/addfileupload',
        allowedExtensions: ['jpg', 'jpeg', 'png','gz','pdf'],
        debug: true,
        extraDropzones: [qq.getByClass(document, 'qq-upload-extra-drop-area')[0]],
        onComplete: function(id, fileName, responseJSON){
            console.log("id",id);
            console.log("filename",fileName);
            console.log("responseJSON",responseJSON);
        },
        showMessage: function(message){
            //alert(message);
    		$().toastmessage('showToast', {
				text     : message,
				sticky   : true,
				position : 'top-center',
				type     : 'warning',
				closeText: '',
				close    : function () {
					//console.log("toast is closed ...");
				}
			});	

        },
        messages: {
            typeError: "No se puede subir el archivo seleccionado. Solo archivo {extensions} están permitidos.",
            sizeError: "{file} el archivo es muy grande, tamaño máximo {sizeLimit}.",
            minSizeError: "{file} es demasiado pequeño, el tamaño mínimo es {minSizeLimit}.",
            emptyError: "{file} el archivo esta vacio, por favor selecciona archivos.",
            onLeave: "El archivo comenzo a subirce, si lo deseas puedes cancelar la carga."            
        },
        dragText: 'Mueve los archivo aquí para subir',      
        uploadButtonText: 'Subir Archivos',        
        cancelButtonText: 'Cancelar',        
        failUploadText: 'Carga fallida',
        template: 
        	'<div class="qq-uploader">' + 
	        	'<div class="qq-upload-drop-area"><span>{dragText}</span></div>' +
	        	'<div class="qq-upload-button"><button type="button" class="btn btn-success btn-lw"><span class="glyphicon glyphicon-upload"></span> {uploadButtonText}</button></div><br>'+
	        	'<ul class="qq-upload-list"></ul>' + 
	        '</div>',
	     classes: {
	            // used to get elements from templates
	            button: 'qq-upload-button',
	            drop: 'qq-upload-drop-area',
	            dropActive: 'qq-upload-drop-area-active',
	            dropDisabled: 'qq-upload-drop-area-disabled',
	            list: 'qq-upload-list',
	            progressBar: 'qq-progress-bar',
	            file: 'qq-upload-file',
	            spinner: 'qq-upload-spinner',
	            size: 'qq-upload-size',
	            cancel: 'qq-upload-cancel',

	            // added to list item <li> when upload completes
	            // used in css to hide progress spinner
	            success: 'qq-upload-success',
	            fail: 'qq-upload-fail'
	        }
    });
}



function showmessages(){
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

function guardardatos(){
	$('form#ArchivoAddForm').submit()	
}