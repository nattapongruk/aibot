<?php
// การเชื่อมต่อฐานข้อมูล
include('connect.php');

// ตรวจสอบว่ามีข้อมูลที่เกี่ยวข้องที่ส่งมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ารหัสผ่านและการยืนยันรหัสผ่านตรงกันหรือไม่
    if ($_POST['password'] == $_POST['confirm_password']) {
        // เก็บรหัสผ่านใหม่
        $password = $_POST['password'];
        // เก็บเบอร์โทรศัพท์จากฟอร์ม (ที่ส่งมากับการร้องขอ)
        $phone = $_GET["phone"];
        
        // สร้างคำสั่ง SQL สำหรับการอัปเดตรหัสผ่าน
        $sql = "UPDATE infouser SET password='$password' WHERE phone='$phone'";
        
        // ส่งคำสั่ง SQL ไปยังฐานข้อมูล
        if ($conn->query($sql) === TRUE) {
            // ถ้าอัปเดตรหัสผ่านสำเร็จ
            echo "<script>alert('รหัสผ่านของคุณถูกอัปเดตเรียบร้อยแล้ว'); window.location.href = 'index.php';</script>";
            exit; // Ensure script execution stops after redirection
        } else {
            // ถ้ามีข้อผิดพลาดในการอัปเดตรหัสผ่าน
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดตรหัสผ่าน: " . $conn->error . "');</script>";
        }
    } else {
        // ถ้ารหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน
        echo "<script>alert('รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน');</script>";
    }
}
?>
