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

//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
	cargarEventoFilas();})

function cargarEventoFilas(){
	$('#cancelar').click(function(){window.history.back()})
	showmessage();
	$('#buscar').click(function(){ reloadList(link) });	
	reloadList(link)
}


function showmessage(){
	var message = $('#message').text();
	if(typeof(message) != 'undefined' && message.trim() != ''){
		$().toastmessage('showToast', {
				text     : message,
				sticky   : false,
				position : 'top-right',
				type     : 'success',
				closeText: '',
				close    : function () {
				}
			});	
	}
}

function reloadList(rlink){
	serialize=$('#persxoficinas').serialize()
	$('#cargandodatos').show(1)
	$.post(rlink,serialize,
			function(data) {
				$('#listpersxoficina').html(data);
				var divPaginationLinks = '#listpersxoficina'+" .pagination a,.sort a";
			    $(divPaginationLinks).click(function(){
			        var thisHref = $(this).attr("href");
			        reloadList(thisHref);
			        //recarmamos el proceso de carga
			        return false;
			    });
	}).always(function() {
		$('#cargandodatos').hide(1)
	});
}

