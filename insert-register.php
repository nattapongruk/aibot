<?php
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $portnumber = $_POST['portnumber'];
    $idcard = $_POST['idcard'];
    $phone = $_POST['phone'];
    $pass = $_POST['password'];
    
    // เก็บวันที่และเวลาปัจจุบัน
    $register_date = date('Y-m-d H:i:s');

    // ตรวจสอบว่า portnumber และ idcard ไม่ซ้ำ
    $checkDuplicate = "SELECT * FROM infouser WHERE portnumber='$portnumber' OR idcard='$idcard'";
    $result = $conn->query($checkDuplicate);

    if ($result->num_rows > 0) {
        // ถ้ามีข้อมูลซ้ำในฐานข้อมูล
        echo "<script>alert('Error: Portnumber or ID Card already exists');</script>";
    } else {
        // ถ้าไม่มีข้อมูลซ้ำในฐานข้อมูล ทำการเพิ่มข้อมูล
        $sql = "INSERT INTO infouser (portnumber, idcard, phone, password, register_date)
                VALUES ('$portnumber', '$idcard', '$phone', '$pass', '$register_date')";
        header("Location: index.php");

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        }
    }
}

$conn->close();
?>