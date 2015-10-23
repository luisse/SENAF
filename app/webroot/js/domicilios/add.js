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
var map;
var usermarker;

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

	$('#DomicilioLatitude').attr('readonly',true)
	$('#DomicilioLongitude').attr('readonly',true)	
	
	$("#DomicilioCallenombre").typeahead({
		  items:8,
		  minLength:3,
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
	MostrarPosicion()	
	$('#DomicilioPiso').numeric()
	$('#DomicilioNro').numeric()
	$('#guardar').click(guardardatos)
	$('#gpsubi').click(ubicarmapa)
	$('#cancelar').click(function(){window.history.back()})
}

function guardardatos(){
	$('form#DomicilioAddForm').submit()	
}


function MostrarPosicion(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(ShowPosition,showError);
	}else{
		alert('No se pudo establecer la ubicación. El track del GPS no se realizara');
	}	
}


function ShowPosition(position){
	  if(navigator.onLine){
	  	geocoder = new google.maps.Geocoder();
		 //Set the height of the div containing the Map to rest of the screen
				if(navigator.geolocation){
						var mapOptions = {
											zoom: 16,
											center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
											mapTypeId: google.maps.MapTypeId.ROADMAP
											};
						$('#DomicilioLatitude').val(position.coords.latitude)
						$('#DomicilioLongitude').val(position.coords.longitude)
											
				}else{
						//Argentina por defecto
						$('#DomicilioLatitude').val('-26.816750')
						$('#DomicilioLongitude').val('-65.226801')
						var latlng = new google.maps.LatLng(-26.816750, -65.226801);
						var mapOptions = {
										zoom: 16,
										center: latlng
										}	
				}
			map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);	
			//Permite guardar la posición seleccionada por el usuario
			google.maps.event.addListener(map, 'click', function(event) {
				if(typeof(usermarker) !='undefined') usermarker.setMap(null);
				usermarker = new google.maps.Marker({
						position: event.latLng,
						
						map: map
						})
				$('#DomicilioLatitude').val(event.latLng.lat())
				$('#DomicilioLongitude').val(event.latLng.lng())
			  });		
	  }
}

function showError(error)
{
switch(error.code) 
  {
  case error.PERMISSION_DENIED:
    alert("El usuario Denego el acceso para localización")
    break;
  case error.POSITION_UNAVAILABLE:
    alert("La información de la localización es invalida")
    break;
  case error.TIMEOUT:
    alert("El tiempo de para localización demoro demasiado tiempo")
    break;
  case error.UNKNOWN_ERROR:
    alert("No se pudo determinar el error de localización")
    break;
  }
}

function ubicarmapa() {
	  var address = $('#DomicilioUbicacionmanual').val()
	  geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      map.setCenter(results[0].geometry.location);
	      var marker = new google.maps.Marker({
	          map: map,
	          position: results[0].geometry.location
	      });
	    } else {
	      alert('No se pudo ubicar el mapa por el siguiente motivo: ' + status);
	    }
	  });
}
