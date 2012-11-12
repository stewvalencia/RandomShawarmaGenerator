<?php
if(!isset($_GET['term']))
	$_GET['term'] = ""; 

if(!isset($_GET['location']))
	$_GET['location'] = ""; 

//
// From http://non-diligent.com/articles/yelp-apiv2-php-example/
//


// Enter the path that the oauth library is in relation to the php file
require_once ('lib/OAuth.php');


$unsigned_url = "http://api.yelp.com/v2/search?term=" . $_GET['term'] . "&location=" . $_GET['location'];


// Set your keys here
$consumer_key = "XXX";
$consumer_secret = "XXX";
$token = "XXX";
$token_secret = "XXX";

// Token object built using the OAuth library
$token = new OAuthToken($token, $token_secret);

// Consumer object built using the OAuth library
$consumer = new OAuthConsumer($consumer_key, $consumer_secret);

// Yelp uses HMAC SHA1 encoding
$signature_method = new OAuthSignatureMethod_HMAC_SHA1();

// Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
$oauthrequest = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);

// Sign the request
$oauthrequest->sign_request($signature_method, $consumer, $token);

// Get the signed URL
$signed_url = $oauthrequest->to_url();

// Send Yelp API Call
$ch = curl_init($signed_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$data = curl_exec($ch); // Yelp response
curl_close($ch);

// Print it for debugging
print($data);

?>
