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
	$('#buscar').click(function(){ Ajaxcargarpersonas() });
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
	var oficina_id = $('#PersxoficinaOficinaId').val()
	ExistePersonaEnOficina(oficina_id,personaId,fila)
}

function ExistePersonaEnOficina(oficina_id,persona_id,fila){
			$.ajax({type:'GET',
				  url:'/persxoficinas/existepersonagrupo/'+oficina_id+'/'+persona_id,
				  datatype:'html',
				  success:function(data){
					if(data == 1){
						alert('Ya Existe la Persona Asociada')
					}else{
						var personaId = $('#PersonaId'+fila).val()
						var personaDocumento = $('#PersonaDocumento'+fila).val()
						var personaNomApe = $('#PersonaNomApe'+fila).val()
						if(typeof(personaId) != 'undefined' && typeof(personaDocumento) != 'undefined'){
							if(!validaclienteid(personaId)){
							$('#Persxoficina'+rowpos+'Documento').val(personaDocumento)
							$('#Persxoficina'+rowpos+'PersonaId').val(personaId)
							$('#Persxoficina'+rowpos+'Nombreapellido').val(personaNomApe)
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
