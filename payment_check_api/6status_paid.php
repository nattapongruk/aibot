<?php

// ข้อมูลสำหรับการเรียกใช้ API
$partner_id = "PTR1051673";
$partner_secret = "d4bded59200547bc85903574a293831b";
$merchant_id = "KB102057149704";
$access_token = "eQXbjngis28PnlMIYFEnE9ioWGyA"; // ใส่ Access Token ที่ได้รับจากการทำ OAuth 2.0

// กำหนด URL ของ API
$url = "https://openapi-sandbox.kasikornbank.com/v1/qrpayment/v4/inquiry";

// ข้อมูลที่จะส่งไปยัง API
$data = array(
    "partnerTxnUid" => "PARTNERTEST0004",
    "partnerId" => $partner_id,
    "partnerSecret" => $partner_secret,
    "requestDt" => "2024-03-10T12:24:00+07:00",
    "merchantId" => $merchant_id,
    "origPartnerTxnUid" => "PARTNERTEST0007"
);

// กำหนด Header
$headers = array(
    "Authorization: Bearer $access_token",
    "x-test-mode: true",
    "env-id: QR006",
    "Content-Type: application/json"
);

// เรียกใช้งาน API ด้วย cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
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