<?php

// API credentials
$partner_id = "PTR1051673";
$partner_secret = "d4bded59200547bc85903574a293831b";
$merchant_id = "KB102057149704";
$access_token = "eQXbjngis28PnlMIYFEnE9ioWGyA"; // Your access token here

// API endpoint
$url = "https://openapi-sandbox.kasikornbank.com/v1/qrpayment/void";

// Data to be sent in the API request
$data = array(
    "partnerTxnUid" => "PARTNERTEST0009",
    "partnerId" => $partner_id,
    "partnerSecret" => $partner_secret,
    "requestDt" => "2024-03-10T12:24:00+07:00", // Current datetime in ISO8691 format
    "merchantId" => $merchant_id,
    "origPartnerTxnUid" => "PARTNERTEST0011"
);

// Headers
$headers = array(
    "Authorization: Bearer $access_token",
    "x-test-mode: true",
    "env-id: QR012",
    "Content-Type: application/json"
);

// Call the API using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// Check if API call was successful
if ($response === false) {
    echo "Error calling API";
} else {
    // Display API response
    echo $response;
}

?>
