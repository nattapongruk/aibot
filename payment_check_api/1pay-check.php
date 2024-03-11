<?php

// ข้อมูลสำหรับการเรียกใช้ API
$consumer_id = "oV81uL3bu1WJqwwXxZGiCF8pGXAu8P8r";
$consumer_secret = "eZmxP5AiXI7WGoDk";
$grant_type = "client_credentials";

// กำหนด URL ของ API
$url = "https://openapi-sandbox.kasikornbank.com/v2/oauth/token";

// ข้อมูลที่จะส่งไปยัง API
$data = array(
    "grant_type" => $grant_type
);

// จัดรูปแบบข้อมูล Basic Authentication
$auth_data = base64_encode("$consumer_id:$consumer_secret");

// กำหนด Header
$headers = array(
    "Content-Type: application/x-www-form-urlencoded",
    "Authorization: Basic $auth_data",
    "x-test-mode: true",
    "env-id: OAUTH2"
);

// เรียกใช้งาน API ด้วย cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// ตรวจสอบการเรียกใช้ API ว่าเป็นคำสั่งที่ถูกต้องหรือไม่
if ($response === false) {
    echo "Error calling API";
} else {
    // แสดงผลลัพธ์การเรียกใช้ API
    echo $response;
}

?>
