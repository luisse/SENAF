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
*    @Fecha 16/09/2014
*    @use Edicion de grupos por medio de arrastre de objetos AJAX
*/

$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$('#agregarfila').click(function(){
			filaNueva()
			});

	$('#modalview').on('hidden.bs.modal', function () {
		//$(this).removeData('bs.modal');
		$('#content').empty();
		$(this).data('bs.modal', null); //<---- empty() to clear the modal
		
	})
	//$(listname).dragsort({ dragSelector: "div", dragBetween: true, dragEnd: saveOrder, placeHolderTemplate: "<li class='placeHolder'><div></div></li>" });	
	$(listname).draggable({appendTo: "body",
							helper: 'clone',})
	
	$(objname).droppable({
			accept:'li',
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
 
			drop: function( event, ui ) {
				ui.draggable.appendTo(this).fadeIn();
			}
	});		
	$('#borrar').click(borrar);
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	    //Funcion para obtener los valores del formulario se explica mas adelante
	    datos = obtenerDatos();
	    $.ajax({
	        url:'/persxgrupsociales/editgrupsave', //URL del archivo php que procesa la petición. Se explica mas adelante
	        type:'post', // Los datos se envían mediante el método POST
	        dataType:'html', // La respuesta se obtiene como JSON
	        data:datos // Los datos del formulario
	    }).done(function(respuesta){
	        //Condición para verificar si se guardaron o no los datos
	        if( respuesta == '' )
	    		$().toastmessage('showToast', {
					text     : "La información se guardó correctamente",
					sticky   : false,
					position : 'top-right',
					type     : 'success',
					closeText: '',
					close    : function () {}
				});
	        else
	    		$().toastmessage('showToast', {
					text     : respuesta,
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {}
				});

	    });
}


function obtenerDatos(){
    //Se crea la variable para la lista de idiomas seleccionados
    var grupxpersonas ="";
    //Se obtiene todos los elementos li de la lista con id="idiomasseleccionados" y se recorren
    // utilizando el método .each
    $(objname).each(function(indice,elemento){
    	var ul=this;
    	grupxpersonas +='&'+$(this).attr('id')+'|'
    	if(typeof(ul)!='undefined'){
    		$(ul).children('li').each(function(listItemIndex){
    			grupxpersonas +=$(this).attr('id')+','
    		})
    		
    	}
    })
    datos = [{name:"accion",value:"guardar"},{name:"grupxpersonas", value:grupxpersonas}];    
    return datos;
}

function borrarpersonagrupo(persxgrupsociale_id,persona_id){
	if(typeof(persona_id) != 'undefined'){
	    $.ajax({
	        url:'/persxgrupsociales/borrarpersona/'+persona_id+'/'+persxgrupsociale_id, //URL del archivo php que procesa la petición. Se explica mas adelante
	        type:'post', // Los datos se envían mediante el método POST
	        dataType:'html', // La respuesta se obtiene como HTML
	    }).done(function(respuesta){
	        //Condición para verificar si se guardaron o no los datos
	        if( respuesta == '' ){
	        	$('#det'+persxgrupsociale_id).hide(1)
	    		$().toastmessage('showToast', {
					text     : 'Persona Eliminada Satisfactoriamente del Grupo',
					sticky   : false,
					position : 'top-right',
					type     : 'success',
					closeText: '',
					close    : function () {}
				});	        	
	        }else
	    		$().toastmessage('showToast', {
					text     : respuesta,
					sticky   : true,
					position : 'top-right',
					type     : 'error',
					closeText: '',
					close    : function () {}
				});	        	
	    });		
	}
	
}
