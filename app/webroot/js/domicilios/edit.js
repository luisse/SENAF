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
	$('#DomicilioPaiseId').change(function(){
		cargardropdown('DomicilioPaiseId','/provincias/retornalxmlprovincias/','DomicilioProvinciaId')
	})
	
	$('#DomicilioProvinciaId').change(function(){
		cargardropdown('DomicilioProvinciaId','/deptos/retornalxmldeptos/','DomicilioDeptoId','S')
	})

	$('#DomicilioDeptoId').change(function(){
		cargardropdown('DomicilioDeptoId','/municipios/retornalxmldeptos/','DomicilioMunicipioId','S')
	})	
	
	$('#DomicilioMunicipioId').change(function(){
		cargardropdown('DomicilioMunicipioId','/localidades/retornalxmllocalidades/','DomicilioLocalidadeId','S')
	})	
	
	$('#DomicilioLocalidadeId').change(function(){
		//cargardropdown('DomicilioLocalidadeId','/barrios/retornalxmlbarrios/','DomicilioBarrioId')
	})		

	$("#DomicilioCallenombre").typeahead({
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
	$('#DomicilioPiso').numeric()
	$('#DomicilioNro').numeric()
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	$('form#DomicilioEditForm').submit()	
}