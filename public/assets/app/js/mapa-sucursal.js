var lat = -12.055323;
var lng = -77.0539402;

var draggable ;

function initMap() {
  lat = ($("#lat").val()) ?$("#lat").val() :lat;
  lng = ($("#lng").val()) ?$("#lng").val() :lng;

    $("#lat").val(lat);
    $("#lng").val(lng);
  var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lng)};
  var autocomplete;
  var input = (document.getElementById('search'));
  var directionsDisplay;
  var geocoder;
  var myZoom = 15;


  directionsDisplay = new google.maps.DirectionsRenderer();
  geocoder = new google.maps.Geocoder();

  // Create a map object and specify the DOM element for display.
  var map = new google.maps.Map(document.getElementById('mapa-sucursal'), {
    center: myLatLng,
    scrollwheel: false,
    zoom: myZoom/*,
    styles: [
      {"featureType":"landscape","stylers":[
        {"saturation":-100},
        {"lightness":65},
        {"visibility":"on"}
      ]},
      {"featureType":"poi","stylers":[
        {"saturation":-100},
        {"lightness":51},
        {"visibility":"simplified"}
      ]},
      {"featureType":"road.highway","stylers":[
        {"saturation":-100},
        {"visibility":"simplified"}
      ]},
      {"featureType":"road.arterial","stylers":[
        {"saturation":-100},
        {"lightness":30},
        {"visibility":"on"}
      ]},
      {"featureType":"road.local","stylers":[
        {"saturation":-100},
        {"lightness":40},
        {"visibility":"on"}
      ]},
      {"featureType":"transit","stylers":[
        {"saturation":-100},
        {"visibility":"simplified"}
      ]},
      {"featureType":"administrative.province","stylers":[
        {"visibility":"off"}
      ]},
      {"featureType":"water","elementType":"labels","stylers":[
        {"visibility":"on"},
        {"lightness":-25},
        {"saturation":-100}
      ]},
      {"featureType":"water","elementType":"geometry","stylers":[
        {"hue":"#ffff00"},
        {"lightness":-25},
        {"saturation":-97}
      ]}
    ]*/
  });

  directionsDisplay.setMap(map);

  // Create a marker and set its position.
  var marker = new google.maps.Marker({
    map: map,
    position: myLatLng,
    draggable: true
  });

  google.maps.event.addListener(marker, 'dragend', function(){
    insertData(marker.getPosition());
  });

  autocomplete = new google.maps.places.Autocomplete(input,
      { types: ['geocode']});
  autocomplete.bindTo('bounds', map);

    google.maps.event.addDomListener(input, 'keydown', function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
        }
    });
    autocomplete.addListener('place_changed', function(){
    var address = $('#search').val();
    geocoder.geocode({'address': address}, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

        map.setCenter(results[0].geometry.location);
        map.setZoom(15);

        var marker1 = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location,
          draggable: true
        });

        marker.setMap(null);
        marker = marker1;


        insertData(marker.getPosition());

        google.maps.event.addListener(marker, 'dragend', function(){
          insertData(marker.getPosition());
        });
      }
    });
  });
}

function insertData(latLng){
  $("#lat").val(latLng.lat().toFixed(6));
  $("#lng").val(latLng.lng().toFixed(6));
}

var form = $('#frmSucursal');
form.validate({
    // define validation rules
    rules: {
        pais: {
            required: true
        },

        ciudad: {
            required:true
        }
    },
    messages: {
        titulo: {
            required: 'El campo pais es obligatorio.'
        },
        ciudad: {
            required: 'El campo ciudad es obligatorio.'
        }
    },

    //display error alert on form submit
    invalidHandler: function(event, validator) {
        var alert = form;
        alert.removeClass('m--hide').show();
    }
});

$('#enviar-mapa').click(function (e) {
  e.preventDefault();
  if (form.valid()) {
    form[0].submit();
    /*
    var url = form.attr('action');
    var data = form.serialize();
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: url,
      async: false,
      data: data,
      success: function (data) {
        if (!data.error) {
          location.reload();
        }
      },
      error: function () {
        console.log('error');
      }
    });*/
  }
});
