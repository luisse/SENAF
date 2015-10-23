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
*    @Fecha 23/11/2013
*    @use Librerias de AJAX para inicio de sesion
*/
//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
	$('#myTab a:last').tab('show')
	$('#PersonaNrodoc').numeric()
	$('#buscarpersonas').click(function(){ Ajaxcargarpersonas() });
}

function reloadListpersona(rlink){
	var serialize=$('#filterpersona').serialize()
	$('#cargandodatosp').show(1)
	$.post(rlink,serialize,
			function(data) {
				$('#listarpersonas').html(data);
				var divPaginationLinks = '#listarpersonas'+" .pagination a,.sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadListpersona(thisHref);
			        return false;
			    });
	}).always(function() {
		$('#cargandodatosp').hide(1)
	});
}

function Ajaxcargarpersonas(){
	reloadListpersona(personaslink)
}

function seleccionarpersona(fila){
	var personaId = $('#PersonaId'+fila).val()
	var personaDocumento = $('#PersonaDocumento'+fila).val()
	var personaNom = $('#PersonaNombre'+fila).val()
	var personaApe = $('#PersonaApellido'+fila).val()
	if(typeof(personaId) != 'undefined' && typeof(personaDocumento) != 'undefined'){
		$('#Persona'+rowpos+'Nrodoc').val(personaDocumento)
		$('#Persona'+rowpos+'PersonaId').val(personaId)
		$('#Persona'+rowpos+'Apellido').val(personaApe)
		$('#Persona'+rowpos+'Nombre').val(personaNom)
		$('#Persona'+rowpos+'Id').val(personaId)
		$('#modalview').modal('hide');							
	}							

}

function ExistePersonaEnOficina(oficina_id,persona_id,fila){
			$.ajax({type:'GET',
				  url:'/persxoficinas/existepersonagrupo/'+oficina_id+'/'+persona_id,
				  datatype:'html',
				  success:function(data){
					if(data == 1){
						alert('Ya Existe la Persona Asociada')
					}else{
						if(typeof(personaId) != 'undefined' && typeof(personaDocumento) != 'undefined'){
							if(!validaclienteid(personaId)){
							$('#Persona'+rowpos+'Documento').val(personaDocumento)
							$('#Persona'+rowpos+'PersonaId').val(personaId)
							$('#Persona'+rowpos+'Nombreapellido').val(personaNomApe)
							}
							$('#modalview').modal('hide');							
						}							
					}
				  },
				  error:function(xtr,fr,ds){
						  alert('No se pudieron cargar los datos del Producto. Verifique la conexión al server')
				  }
		  })//close ajax
}
