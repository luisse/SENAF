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
*    @Fecha 14/05/2015 
*    @use Librerias de AJAX para posicionamiento GPS de Domicilio 
*/ 
 
//Variables Gloables para localización 
var geocoder; 
var map; 
var usermarker; 
 
$(document).ready(function(){ 
    IniciarEventos();} 
); 
 
 
function IniciarEventos(){ 
	$("#CoordFecha").datetimepicker({pickTime: false,language:'es'});
	fechaactual('CoordFecha');

    $('#CoordLatitude').attr('readonly',true) 
    $('#CoordLongitude').attr('readonly',true) 
    MostrarPosicion() 
    $('#guardar').click(guardardatos) 
    $('#cancelar').click(function(){window.history.back()}) 
} 
 
function guardardatos(){ 
    var lat=$('#CoordLatitude').val() 
    var lng=$('#CoordLongitude').val() 
    if((typeof(lat)=='undefined' || lat=='') || 
        (typeof(lng)=='undefined' || lng=='')){ 
        alert('Debe Ingresar latitud y longitud'); 
    }else{ 
        $('form#DomicilioGetlocalizeForm').submit() 
    } 
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
        //Si estamos en un dispositivo portatil miramos si el GPS esta activo 
        if(navigator.geolocation){ 
                var mapOptions = { 
                                    zoom: 16, 
                                    center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude), 
                                    mapTypeId: google.maps.MapTypeId.ROADMAP 
                                    }; 
                $('#CoordLatitude').val(position.coords.latitude) 
                $('#CoordLongitude').val(position.coords.longitude) 
                                     
        }else{ 
                //Argentina por defecto en algún lugar de tucuman... 
                $('#CoordLatitude').val('-26.809579993033672') 
                $('#CoordLongitude').val('-65.24819898884743') 
                var latlng = new google.maps.LatLng(-26.809579993033672, -65.24819898884743); 
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
            $('#CoordLatitude').val(event.latLng.lat()) 
            $('#CoordLongitude').val(event.latLng.lng()) 
          });         
          
        //Ubicaciónes actuales
        var coordgps=0;
        if(typeof(arraycoord)!='undefined')
        	coordgps = arraycoord.length;
        var infowindow = new google.maps.InfoWindow();     
		var ptoini;
		var ptofin;
        if(typeof(coordgps)!='undefined' && coordgps > 0){ 
            for(i=0; i <coordgps; i++){ 
					//carga coordenadas iniciales para tener los dos primeros puntos de referencia
				if(typeof(ptoini) != 'undefined' && typeof(ptofin) != 'undefined'){
					ptoini = ptofin
					ptofin =  new google.maps.LatLng(arraycoord[i].clat,arraycoord[i].clng)
				}
				
				if(i == 0)
					ptoini = new google.maps.LatLng(arraycoord[i].clat,arraycoord[i].clng)
				if(i == 1)	
					ptofin =  new google.maps.LatLng(arraycoord[i].clat,arraycoord[i].clng)		

				//si tenemos puntos cargamos lo asignamos en el mapa
				if(typeof(ptoini) != 'undefined' && typeof(ptofin) != 'undefined'){
					var linea=[ptoini,ptofin];
					var flightPath = new google.maps.Polyline({
						path: linea,
						geodesic: true,
						strokeColor: 'blue',
						strokeOpacity: 1.0,
						strokeWeight: 2
					  });
					  flightPath.setMap(map);
						console.debug('Trazabilidad GPS: '+i) 					  
				}
				
				


				
                if(i == 0){ 
                    gpsicon =  '../../img/gps_blue.png' 
                }else{ 
                    gpsicon='../../img/informacion.png' 
                } 
                
                var marker = new google.maps.Marker({ 
                        position: new google.maps.LatLng(arraycoord[i].clat, arraycoord[i].clng), 
                        icon: gpsicon, 
                        map: map,     
                        title: arraycoord[i].fecha+' - '+arraycoord[i].desc 
                    }); 
                 
                google.maps.event.addListener(marker, 'click', function() { 
                    infowindow.setContent(this.title); 
                    infowindow.open(map,this); 
                  });         
            } 
            map.setCenter(marker.getPosition()); 
        } 
    }else{ 
        alert('No existe conexión a internet no se muestran los mapas') 
    } 
} 
 
 
function GoogleMapsRun(){ 
    MapsShow() 
    $('#cancelar').click(function(){window.history.back()}) 
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