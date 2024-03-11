<?php
include('connect.php'); // เชื่อมต่อกับฐานข้อมูล
    $phone = $_GET["phone"];
    //$phone = $_POST['phone']; // รับค่าเบอร์โทรศัพท์จากฟอร์ม
    // ค้นหาเบอร์โทรศัพท์ในฐานข้อมูล
    $sql = "SELECT * FROM infouser WHERE phone='$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // ถ้าพบข้อมูลเบอร์โทรศัพท์ในฐานข้อมูล
        // while($row = $result->fetch_assoc()) {
        //     $phone = $row["phone"];
        //     echo $phone;
        // }
        echo json_encode(array("exists" => true));
    } else {
        // ถ้าไม่พบข้อมูลเบอร์โทรศัพท์ในฐานข้อมูล
        echo json_encode(array("exists" => false));
    }
?>