<!DOCTYPE html>
<html lang="en" dir="ltr">  
  <head>
    <title>Random Shawarma Generator</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
	<!-- Loaded jQuery, google maps API, and scripts -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
	<script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBRxqAVz0d3Dux4JJkEmb6NDCl96ASbZNQ&sensor=false">
    </script>
	<script type="text/javascript" src="js/json2.js"></script>
	<script type="text/javascript" src="js/search.js"></script> 
	<h1>Random Shawarma Generator</h1>
	<img src="http://media1.ak.yelpcdn.com/static/201206263498344258/img/developers/Powered_By_Yelp_Black.png"/>
  </head>
  
  <body>
  
	<!-- Search form-->
	<div id="searchForm">
		<h2>Find a random place to eat shawarma or anything else...</h2>
		<!-- Displays Search status and errors -->
		<div id='searchError'></div>
		<form method='post' action='./index.php' name='searchForm'>
		<h3>What do you want?</h3>
		<input type='text' name='term' value='shawarma'/><br />
		<h3>City:</h3>
		<input type='text' name='location' value='dc'/><br />
		<input type='submit' name='search' value='Search'/>
		</form>
	</div>
	<div id="map_canvas" style="height:60%;width:60%;top:30px"></div>
	
  
  </body>
</html>