<!DOCTYPE html>
 <html lang="en">
    <head>
        <!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Merideando</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">  
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <link href="css/hover.css" rel="stylesheet" media="all"> 
       
         <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        width:100%;
        height: 600px;
       
      }
      /* Optional: Makes the sample page fill the window. */
      
    </style>
    </head>
     
     
  <body>
    <?php include "php/navbar.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="slider_text text-center">
                    <h2 class="titulo-mapa">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-map fa-stack-1x fa-inverse"></i>
                        </span> Mapa de Merideando
                    </h2>
                        
                                     <!---<a class="btn-light-bg " href="#">Purchase Now</a> -->
                </div>
            </div>
        </div>
      </div>
      
      <div id="map"></div>

      <!-- Incluimos el footer o pie de página -->       
      <?php include "php/footer.php"; ?>
        
     <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
     <script type="text/javascript" src="js/main.js"></script>   
    
      
   <script>
      var customLabel = {
        comybeb: {
           icon: { url: "images/markers/png/restaurant.png" }
        },
        motor: {
          icon: { url:"images/markers/png/car.png"}
        },
        profyemp:{
            icon: { url:"images/markers/png/company.png"}
        },
        depyocio:{
            icon: { url:"images/markers/png/summercamp.png" }
        },
        comercio:{
            icon: { url:"images/markers/png/departmentstore.png"}
        },
        salybel:{
            icon: { url:"images/markers/png/aed-2.png"}
        },
        formacion:{
            icon: { url:"images/markers/png/school.png"}
        },
        turismo:{
            icon: { url:"images/markers/png/temple-2.png"}
        },
        
      };

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 15});
            var geocoder = new google.maps.Geocoder;
            var latlng = new google.maps.LatLng(38.91795,-6.34146);
            geocoder.geocode({'latLng': latlng }, function(results, status) {
              if (status === 'OK') {
                map.setCenter(results[0].geometry.location);

              } else {
                window.alert('El mapa no pudo mostrarse por la siguiente razón: ' +
                    status);
              }
            });
            var infoWindow = new google.maps.InfoWindow;

              // Change this depending on the name of your PHP or XML file
              downloadUrl('php/maps.php', function(data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) {
                  var name = markerElem.getAttribute('name');
                  var address = markerElem.getAttribute('address');
                  var type = markerElem.getAttribute('type');
                  var enlace = markerElem.getAttribute('enlace');

                  var point = new google.maps.LatLng(
                      parseFloat(markerElem.getAttribute('lat')),
                      parseFloat(markerElem.getAttribute('lng')));

                  var infowincontent = document.createElement('div');
                  var strong = document.createElement('strong');
                  strong.textContent = name
                  infowincontent.appendChild(strong);
                  infowincontent.appendChild(document.createElement('br'));

                  var text = document.createElement('text');
                  text.textContent = address
                  infowincontent.appendChild(text);
                    infowincontent.appendChild(document.createElement('br'));

                  var a = document.createElement('a');
                    a.textContent = "Ver Anuncio"
                    a.href = enlace;
                    infowincontent.appendChild(a);


                  var icon = customLabel[type].icon || {};

                  var marker = new google.maps.Marker({
                    map: map,
                    animation: google.maps.Animation.DROP,
                    position: point,
                   icon: icon.url
                  });
                  marker.addListener('click', function() {
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                  });
                });
              });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
      
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC516yYGBDQeQIHcm7W1KhWJ_NDL8iUT8s&region=ES&callback=initMap">
    </script>
      
  </body>
</html>