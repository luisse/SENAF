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
	$('#TipdocxperNrodoc').change(function(){existedoc()})
}

function guardardatos(){
	$('form#TipdocxperEditForm').submit()	
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
			$('#TipdocxperNrodoc').val($('#TipdocxperNrodocant').val())
	    }
	    	
		});

	$.ajax({
	    url:'/tipdocxpers/existetipdocper/0/'+tipodoc_id+'/'+nrodoc, //URL del archivo php que procesa la petición. Se explica mas adelante
	    type:'post', // Los datos se envían mediante el método POST
	    dataType:'html', // La respuesta se obtiene como JSON
	}).done(function(respuesta){
	    //Condición para verificar si se guardaron o no los datos
	    if( respuesta == '1' ){
	        //alert("Se Elimino la persona del grupo");
			$().toastmessage('showToast', {
				text     : 'El Documento Existe asociado a otra persona',
				sticky   : false,
				position : 'top-right',
				type     : 'error',
				closeText: '',
				close    : function () {}
			});
			$('#TipdocxperNrodoc').val($('#TipdocxperNrodocant').val())
	    }
	    	
		});
		
}


