<?php

// ข้อมูลสำหรับการเรียกใช้ API
$partner_id = "PTR1051673";
$partner_secret = "d4bded59200547bc85903574a293831b";
$merchant_id = "KB102057149704";
$access_token = "eQXbjngis28PnlMIYFEnE9ioWGyA"; // ใส่ Access Token ที่ได้รับจากการทำ OAuth 2.0

// กำหนด URL ของ API
$url = "https://openapi-sandbox.kasikornbank.com/v1/qrpayment/request";
// ข้อมูลที่จะส่งไปยัง API
$data = array(
    "partnerTxnUid" => "PARTNERTEST0001", // แก้ไขค่านี้ให้ไม่ซ้ำกับครั้งก่อน
    "partnerId" => $partner_id,
    "partnerSecret" => $partner_secret,
    "requestDt" => "2024-03-09T05:24:00+07:00", // ระบุวันที่และเวลาใน ISO 8601 format
    "merchantId" => $merchant_id,
    "qrType" => 3,
    "txnAmount" => 100.50, // จำนวนเงินต้องเป็นจำนวนบวก
    "txnCurrencyCode" => "THB",
    "reference1" => "INV001",
    "reference2" => "HELLOWORLD",
    "reference3" => "INV001",
    "reference4" => "INV001"
);
// กำหนด Header
$headers = array(
    "Authorization: Bearer $access_token",
    "x-test-mode: true",
    "env-id: QR002",
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