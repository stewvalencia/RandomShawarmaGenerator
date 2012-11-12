
var geocoder;
var map;
//Google Maps initializer
function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(38.898748, -77.037684);
    var myOptions = {
      zoom: 18,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map($('[id=map_canvas]')[0], myOptions);
}

function codeAddress(address, business) {
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location
        });
		
		//Sets up restaurant information
		var infowindow = new google.maps.InfoWindow(
			{ 	content: "<html><h2>" +business.name +"</h2>"
					+"<img src=\"" + business.image_url + "\" /> "
					+"<img src=\"" + business.rating_img_url + "\" /> "
					+"<h3>Yelp reviews: " + business.review_count + " </br>"
					+ address + " </br>"
					+"<p>Description: " + business.snippet_text + " </p></br>"
					+"Phone: " + business.display_phone + " </br>"
					+"<a href=\"" + business.url + "\">"+ business.url + "</a></h3>"
					+"</html>",
				size: new google.maps.Size(50,50)
			});
		
		infowindow.open(map,marker);
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
});
}

$(document).ready(function() {
	initialize();
	//Search form action: Sends search query to search.php
	$('form[name=searchForm]').submit(function() {
		
		//Sets up api url query
		var term = $('[name=term]').val().replace(/\s/g, "+"),
		location = $('[name=location]').val().replace(/\s/g, "+");
		//alert(term+ "   " +location);
		
		//Sends url to search.php to get JSON data
		$.getJSON( "./search.php", {term: term, location: location}, function(data){
			
			var obj = jQuery.parseJSON(JSON.stringify( data, null, 2 ));
			
			var array = obj.businesses;
			var num = Math.floor(Math.random() * (array.length));
			
			//Will store results of where to get Shawarma
			var address = array[num].location.address[0] + " " + array[num].location.city
				+ ", " + array[num].location.state_code + " " + array[num].location.postal_code;
			
			codeAddress(address, array[num]);
			
			
		});
		
		return false;
	});
	
});