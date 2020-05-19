<?php

// ClientID and Secret
$clientId = 'xxxxxx';
$clientSecret = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

// Authentication URL
$url = 'https://www.deribit.com/api/v2/public/auth?client_id=' . $clientId . '&client_secret=' . $clientSecret . '&grant_type=client_credentials';

// Get response
$auth = json_decode(file_get_contents($url));
$accessToken = $auth->result->access_token;

// Init curl
$curl = curl_init();

// Perform a request to a random private endpoint using the access token
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.deribit.com/api/v2/private/get_account_summary?currency=BTC&extended=true",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $accessToken"
  ),
));

$response = curl_exec($curl);

// Close curl
curl_close($curl);

// Printout response
print_r(json_decode($response));