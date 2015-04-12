var ori = 0;
var lat = 0;
var lon = 0;
var lat2 = 0;
var lon2 = 0;
var angle = 0;
function init() {
  var compass = document.getElementById('compassContainer');
  if(window.DeviceOrientationEvent) {
    window.addEventListener('deviceorientation', function(event) {
      var dir='';
      var alpha;
      if(event.webkitCompassHeading) {
        alpha = event.webkitCompassHeading;
        dir='-';
      }
      else alpha = event.alpha;
      if (alpha != null) {
        ori = Math.floor(alpha);
        var temp = alpha + angle;
        compass.style.Transform = 'rotate(' + temp+  'deg)';
        compass.style.WebkitTransform = 'rotate(' + temp + 'deg)';
        compass.style.MozTransform = 'rotate(' + temp + 'deg)'; 
        $("#orientation").text(ori + ' deg');
      }

    }  , false);
  }

  if (navigator.geolocation)
    var watchId = navigator.geolocation.watchPosition(successCallback, errorCallback, {enableHighAccuracy:true});
  else
    alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");

  function successCallback(position){
    if (position.coords.latitude != null) {
      lat = position.coords.latitude;
    }
    if (position.coords.longitude !=null) {
      lon = position.coords.longitude;
    }

    var depart   = new google.maps.LatLng(lat,lon);
    var arrivee  = new google.maps.LatLng(lat2,lon2);
    angle    = google.maps.geometry.spherical.computeHeading( depart, arrivee);
    $('#angle').text(angle);
    $('#latlng').html(position.coords.latitude + "</br>" + position.coords.longitude)
  }

  function errorCallback(error){
    switch(error.code){
      case error.PERMISSION_DENIED:
      alert("L'utilisateur n'a pas autorisé l'accès à sa position");
      break;      
      case error.POSITION_UNAVAILABLE:
      alert("L'emplacement de l'utilisateur n'a pas pu être déterminé");
      break;
      case error.TIMEOUT:
      alert("Le service n'a pas répondu à temps");
      break;
    }
  }

  function stopWatch(){
    navigator.geolocation.clearWatch(watchId);
  }
}//fin init

var temp = 0;
var first = true;
function findThisBuddy(id){
  $.post( "request_buddy.php", { id: id }, function( data ) {
    $("#orientation2").html(data.name+"</br>"+data.orientation+" deg");
    $("#latlng2").html(data.name+"</br>"+data.latitude+"</br>"+data.longitude);
    lat2 = data.latitude;
    lon2 = data.longitude;
    var depart   = new google.maps.LatLng(lat,lon);
    var arrivee  = new google.maps.LatLng(lat2,lon2);
    angle    = google.maps.geometry.spherical.computeHeading( depart, arrivee);

    $('#angle').text(angle);
  }, "json");


  if(temp == id){
    $("#"+id+"").addClass('disabled');
    finder = setTimeout("findThisBuddy("+id+")", 200);
  }else if(!first){
    $("#"+temp+"").removeClass('disabled');
    clearTimeout(finder);
    first = true;
  }    
  if(first){
    temp = id;
    $("#"+id+"").addClass('disabled');
    first = false;
    finder = setTimeout("findThisBuddy("+id+")", 200);
  }

}

function mapsToDeviceOrientation(angle){
  if(angle < 0){
    return (angle+360);
  }
  return angle;
}

function storeInformationAboutMe(id){
  $.post( "request_store.php", { id:id, latitude: lat, longitude: lon, orientation: ori }, function(data) {
    $("#users").html("");
    data.forEach(function(entry) {
      if(entry.connected){
        class_btn = "btn-success";
      }
      else{
        class_btn = "btn-primary";
      }
      $("#users").append("<a class='btn "+class_btn+" btn-xs space-around' id='"+entry.id+"' onclick='findThisBuddy("+entry.id+")'>"+entry.name+"</a>");
    });
    
  }, "json");

  setTimeout("storeInformationAboutMe("+id+")", 200);
}

jQuery(document).ready(function($) {
  $.get('request_id.php', function(data) {
    storeInformationAboutMe(data);
  });
});