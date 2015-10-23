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
*    @Fecha 02/09/2014 
*    @use Librerias de AJAX para inicio de sesion y posicionamiento GPS 
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
    $('#dibujarArea').click(dibujarArea)
    $('#cancelar').click(function(){window.history.back()}) 
} 
 
function guardardatos(){ 
    var lat=$('#CoordLatitude').val() 
    var lng=$('#CoordLongitude').val() 
    if((typeof(lat)=='undefined' || lat=='') || 
        (typeof(lng)=='undefined' || lng=='')){ 
        alert('Debe Ingresar latitud y longitud'); 
    }else{ 
        $('form#PersonaGetlocalizeForm').submit() 
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
        var coordgps = arraycoord.length; 
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



function getCoordenadas(lt,ln){
	  const M_PI = 3.14159265359;
	  const meters = 100; //Numeros de metros para calcular el radio de los puntos
	  const equator_circumference = 6371000; //metros
	  const polar_circumference = 6356800; //metros
	  
	  var m_per_deg_long = 360 / polar_circumference;
	  var rad_lat = (lt * M_PI / 180);
	  var m_per_deg_lat = 360 / (Math.cos(rad_lat) * equator_circumference);
	  var deg_diff_long = meters * m_per_deg_long; 
	  var deg_diff_lat = meters * m_per_deg_lat; 
	  var coordenadas = [];
	  var coord_north_lat = lt + deg_diff_long;
	  var coord_north_long = ln;
	  var north = {
	    "lt": coord_north_lat,
	    "ln": coord_north_long
	  }
	  coordenadas.push(north);
	 
	  var coord_east_lat = lt;
	  var coord_east_long = ln + deg_diff_lat;  
	  var east = {
	    "lt": coord_east_lat,
	    "ln": coord_east_long
	  }
	  coordenadas.push(east);
	 
	  var coord_south_lat = lt - deg_diff_long;
	  var coord_south_long = ln;
	  var south = {
	    "lt": coord_south_lat,
	    "ln": coord_south_long
	  }
	  coordenadas.push(south);
	 
	  var coord_west_lat = lt;
	  var coord_west_long = ln - deg_diff_lat;
	  var west = {
	    "lt": coord_west_lat,
	    "ln": coord_west_long
	  }
	  coordenadas.push(west);
	 
	  return coordenadas;
}

function dibujarArea(){
	  //Definimos una Variable de tipo array para almacenar los objetos new google.maps.LatLng
	  var poligGMCoords = [];
	  //Obtenemos las coordenadas dinámicas de los 4 puntos cardinales que definen un cuadrante de 1000 m cuadrados
	  var lat=parseFloat($('#CoordLatitude').val())
	  var ln=parseFloat($('#CoordLongitude').val())
	  var coordPolig = getCoordenadas(lat,ln);
	  //Iteramos sobre el arreglo de coordenadas obtenido en el paso anterior 
	  for (i=0; i < coordPolig.length; i++) {
	     var coord = coordPolig[i];	
	     var latlong = new google.maps.LatLng(coord.lt, coord.ln);
	     poligGMCoords.push(latlong);
	  }
	 
	  //Definimos el poligono instanciando un objeto google.maps.Polygon
	  var poligono = new google.maps.Polygon({
	      paths: poligGMCoords,
	      strokeColor: '#FF0000',
	      strokeOpacity: 0.8,
	      strokeWeight: 2,
	      fillColor: '#FF0000',
	      fillOpacity: 0.35
	   });
	   poligono.setMap(map);
	
}
