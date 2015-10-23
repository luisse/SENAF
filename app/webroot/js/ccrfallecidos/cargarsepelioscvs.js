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
*    @author Luis Sebastian oppe
*    @Fecha 18/12/2011
*    @use Librerias de AJAX para administrar datos de negocio
*/


$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$('#CcrcabfallecFdde').datetimepicker({pickTime: false,language:'es'});
	$('#CcrcabfallecFhta').datetimepicker({pickTime: false,language:'es'});
	fechaactual('CcrcabfallecFdde');		
	fechaactual('CcrcabfallecFhta');	

	// the selector will match all input controls of type :checkbox
	// and attach a click event handler 
	$("input:checkbox").on('click', function() {
	  // in the handler, 'this' refers to the box clicked on
	  var $box = $(this);
	  if ($box.is(":checked")) {
	    // the name of the box is retrieved using the .attr() method
	    // as it is assumed and expected to be immutable
	    var group = "input:checkbox[name='" + $box.attr("name") + "']";
	    // the checked state of the group/box on the other hand will change
	    // and the current value is retrieved using .prop() method
	    $(group).prop("checked", false);
	    $box.prop("checked", true);
	  } else {
	    $box.prop("checked", false);
	  }
	});	
	
	$('#guardar').click(function(){
		guardardatos()
	})
	
	$('#guardardatos').click(function(){
		$('form#CcrfallecidoGuardarccrfallecidosForm').submit()
	})
	$('#cancelar').click(function(){
		window.history.back()
	})
	showmessagesepelios();
	
	/***$(document).ready(function(){
	    var button = $('#upload_button'), interval;
	    new AjaxUpload('#upload_button', {
	        action: 'subtypeproducts/cargarsubtypeprodcvs',
	        onSubmit : function(file , ext){
	        if (! (ext && /^(cvs|txt)$/.test(ext))){
	            // extensiones permitidas
	            alert('Solo se pueden Ingresar archivos con formato CVS(cvs,txt)');
	            // cancela upload
	            return false;
	        } else {
	            //Cambio el texto del boton y lo deshabilito
	            button.text('Cargando');
	            this.disable();
	        }
	        },
	        onComplete: function(file, response){
	            button.text('Cargar');
	            // habilito upload button                      
	            this.enable();         
	            // Agrega archivo a la lista
	            $('#lista').appendTo('.files').text(file);
	        }  
	    });
	});***/
}

function guardardatos(){
	var result = validafechas('#CcrcabfallecFdde','#CcrcabfallecFhta')
	if(result != 0){
		switch(result){
		case -1:
			msg='Fecha desde no Definida'
		case -2:
			msg='Fecha hasta no Definida'
		case -3:
			msg='Fecha desde invalida'
		case -4:
			msg='Fecha final invalida'
		case -5:
			msg='La fecha Inicial debe ser menor a la Fecha Final'
		break;
	}		
		$().toastmessage('showToast', {
			text     : msg,
			sticky   : false,
			position : 'top-right',
			type     : 'error',
			closeText: '',
			close    : function () {
			}
		});
		return;
	}
	$('form#CcrfallecidoCargarsepelioscvsForm').submit()	
}

function showmessagesepelios(){
	var message = $('#message').text();
	if(typeof(message) != 'undefined' && message.trim() != ''){
		$().toastmessage('showToast', {
				text     : message,
				sticky   : true,
				position : 'top-center',
				type     : 'error',
				closeText: '',
				close    : function () {
				}
			});	
	}
}


