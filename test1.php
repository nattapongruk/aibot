<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aibot";

try {
  
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM template";
  
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
   
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
        }
    } else {
        echo "ไม่พบข้อมูลในตาราง template";
    }
} catch(PDOException $e) {
    echo "การเชื่อมต่อล้มเหลว: " . $e->getMessage();
}
?>



