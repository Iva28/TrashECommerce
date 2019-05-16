<!DOCTYPE html>
<html>
<head>
	<title>Laravel 5 - Multiple markers in google map using gmaps.js</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="http://maps.google.com/maps/api/js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>


  	<style type="text/css">
    	#mymap {
      		border:1px solid red;
      		width: 800px;
      		height: 500px;
    	}
  	</style>


</head>
<body>


  <h1>Laravel 5 - Multiple markers in google map using gmaps.js</h1>


  <div id="mymap"></div>

  <script type="text/javascript">
    console.log('{!!$trash!!}');
    var trash = '{!! json_encode($trash) !!}';

    var mymap = new GMaps({
      el: '#mymap',
      lat: 40.3754434,
      lng: 49.8326748,
      zoom:6
    });
 
	mymap.addMarker({
        lat: 40.3754434,
      lng: 49.8326748,
	  title: trash.city,
	  click: function(e) {
	    alert('This is '+trash.city+', gujarat from India.');
      }
    });
	   
 
  </script>


</body>
</html>