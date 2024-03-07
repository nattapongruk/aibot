<?php
session_start();
if (!isset($_SESSION["portnumber"])) {
    header("location: index.php");
    exit();
}

include('connect.php');
if(isset($_FILES['h5_file'])){
    $file_name = $_FILES['h5_file']['name'];
    $file_tmp = $_FILES['h5_file']['tmp_name'];

    // เคลื่อนย้ายไฟล์ไปยังโฟลเดอร์ที่ต้องการบันทึก
    move_uploaded_file($file_tmp,"uploads/".$file_name);

   
    // รับค่าจากฟอร์ม
    $model_name = $_POST['model_name'];
    $timeframe = $_POST['timeframe'];
    $model_date = date("Y-m-d H:i:s");

    // บันทึกข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO model (model_name,  timeframe, model_date) VALUES ('$model_name',  '$timeframe', '$model_date')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location.href='admin.php';</script>";
    } else{
        echo "<script>alert('ผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn) . "'); window.location.href='admin.php';</script>";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
}
?>
