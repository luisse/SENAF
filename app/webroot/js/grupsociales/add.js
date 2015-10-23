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
var result=false

$(document).ready(function(){
	IniciarEventos();
})

function IniciarEventos(){
	$('#guardar').click(guardardatos)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	validagruposocial();
}


function validagruposocial(){
	var afinidad_id = $('#GrupsocialeAfinidadeId').val()
	var persona_id = $('#GrupsocialePersonaId').val()
	if(typeof(afinidad_id)!='undefined' && afinidad_id != ''){
				$.ajax({
				url:'/persxgrupsociales/existepersgruposoc/'+afinidad_id+'/'+persona_id,
				datatype:'html',
				success:function(data){
					data=data.trim()
					if(typeof(data)!='undefined' && data != '' && data != '0'){
						$().toastmessage('showToast', {
								text     : 'La Persona ya existe asociada a este grupo',
								sticky   : true,
								position : 'top-center',
								type     : 'error',
								closeText: '',
								close    : function () {
								}
							});			
					}else{
						$('form#GrupsocialeAddForm').submit()	
					}
				},
				error:function(){
					alert('Error Mother of God');
				}
			});
	}
}