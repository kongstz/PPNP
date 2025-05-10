<?php
// URL Google Apps Script Web App
$apiUrl = "https://script.google.com/macros/s/AKfycbwwrOIyt0onOCY7xZnOhUaNqQUAoNSqdLlPY2u234UhELMa05sEVU6YXZmzmzDtmTS8/exec"; // << เปลี่ยนตรงนี้

// รับข้อความจาก Tawk.to (POST JSON)
$input = file_get_contents("php://input");
$payload = json_decode($input, true);

// ดึงข้อความ
$message = $payload['message'] ?? '';

// ส่งต่อไปยัง Google Apps Script
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['message' => $message]));

$response = curl_exec($ch);
curl_close($ch);

// ตอบกลับกลับไปที่ Tawk.to
header('Content-Type: application/json');
echo $response;
?>
