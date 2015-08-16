<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Rich Marker</title>

    <style type="text/css">

      #map {
        width: 600px;
        height: 400px;
        float: left;
        margin: 0 5px;
      }
      .my-marker {
        background: red;
        border: 2px solid #fff;
        padding: 3px;
      }

      .my-other-marker {
        background: blue;
        border: 2px solid #fff;
        padding: 3px;
      }

      #log {
        clear: both;
      }

      #content {
        padding-left: 5px;
      }

      #marker-content {
        width: 350px;
        height: 150px;
      }

    </style>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
      var script = '<script type="text/javascript" src="richmarker';
      if (document.location.search.indexOf('compiled') !== -1) {
        script += '-compiled';
      }
      script += '.js"><' + '/script>';
      document.write(script);
    </script>


    <script type="text/javascript">
      /**
       * Called on the intiial page load.
       */

      var map;
      var marker, marker2;
      function init() {
        var mapCenter = new google.maps.LatLng(0, 0);
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 1,
          center: mapCenter,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        marker = new RichMarker({
          position: mapCenter,
          map: map,
          draggable: false,
          content: '<div class="my-marker"><div>HELLO 1</div></div>'
          });
        
         marker2 = new RichMarker({
          position: new google.maps.LatLng(7.97, 98.3359),
          map: map,
          draggable: false,
          content: '<div class="my-marker" id="marker-1"><div>HELLO 2</div></div>'
          });
         
        var div = document.createElement('DIV');

        google.maps.event.addDomListener(document.getElementById('toggle-draggable'),
          'click', function() {
          //marker.setDraggable(!marker.getDraggable());
          //marker2.setDraggable(!marker2.getDraggable());
        });
      }


      google.maps.event.addDomListener(window, 'load', init);
    </script>
  </head>
  <body>
    <div id="map"></div>    
  </body>
</html>
