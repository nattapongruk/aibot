<?php
// Start session
session_start();

// Connect to the database
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    // Check if start_date and end_date are set in the URL parameters
    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
        // Get start_date and end_date from URL parameters
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];

        // Check if $_SESSION is set
        if (isset($_SESSION['portnumber'])) {
            // Calculate or set $total_profit
            $total_profit = 0; // Placeholder, you should calculate this value

            // Check if the image file is uploaded successfully
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Set necessary variables for database insertion
                $payment_date = date('Y-m-d H:i:s'); // Current time
                $status = 'pending'; // Status 'pending'

                // Set image variables
                $image_name = $_FILES['image']['name'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $upload_directory = "uploads/slip/";
                $target_file = $upload_directory . basename($image_name);

                // Upload image file
                if (move_uploaded_file($image_tmp, $target_file)) {
                    // Insert data into the database
                    $sql = "INSERT INTO payment (portnumber, total, start_date, end_date, image_name, payment_date, status) 
                            VALUES ('" . $_SESSION['portnumber'] . "', '$total_profit', '$start_date', '$end_date', '$image_name', '$payment_date', '$status')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Data saved successfully'); window.location.href = 'payment.php';</script>";
                    } else {
                        echo "<script>alert('Error saving data: " . $conn->error . "');</script>";
                    }
                } else {
                    echo "Error uploading image file";
                }
            }
        } else {
            echo "Session portnumber is not set.";
        }
    } else {
        echo "start_date and/or end_date are not set in the URL parameters.";
    }
}
?>