<?php

// รายละเอียดของ API credentials
$partner_id = "PTR1051673";
$partner_secret = "d4bded59200547bc85903574a293831b";
$merchant_id = "KB102057149704";
$access_token = "OJ5kmWGGpSEyvfE39fnen8NAS6xh"; // ใส่ Access Token ของคุณที่นี่

// URL ของ API
$url = "https://openapi-sandbox.kasikornbank.com/v1/qrpayment/void";

// ข้อมูลที่จะส่งใน API request
$data = array(
    "partnerTxnUid" => "PARTNERTEST0010",
    "partnerId" => $partner_id,
    "partnerSecret" => $partner_secret,
    "requestDt" => "2024-03-10T12:24:00+07:00", // วันที่และเวลาปัจจุบันใน ISO8691 format
    "merchantId" => $merchant_id,
    "origPartnerTxnUid" => "PARTNERTEST0017"
);

// Headers
$headers = array(
    "Authorization: Bearer $access_token",
    "x-test-mode: true",
    "env-id: QR014",
    "Content-Type: application/json"
);

// เรียกใช้งาน API โดยใช้ cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

// ตรวจสอบว่าเรียกใช้งาน API สำเร็จหรือไม่
if ($response === false) {
    echo "เกิดข้อผิดพลาดในการเรียกใช้งาน API";
} else {
    // แสดงผลลัพธ์จาก API
    echo $response;
}

?>
