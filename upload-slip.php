
<?php
session_start();

// Connect to the database
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if start_date and end_date are set in the URL parameters
    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
        // Get start_date and end_date from URL parameters
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $total_com = $_GET['total_com'];
        
        // Check if $_SESSION is set
        if (isset($_SESSION['portnumber'])) {
            // Calculate or set $total_profit
          
            // Insert data into the database
            $payment_date = date('Y-m-d H:i:s'); // Get the current time in the format Y-m-d H:i:s
            $status = 'pending'; // Status 'pending'
            
            // Insert data into the database
            $sql = "INSERT INTO payment (portnumber, total, start_date, end_date, payment_date, status) 
                    VALUES ('" . $_SESSION['portnumber'] . "', '$total_com', '$start_date', '$end_date', '$payment_date', '$status')";

            if ($conn->query($sql) === TRUE) {
                // Get the ID of the last inserted row
                $payment_id = $conn->insert_id;

                // Redirect to payment-confirm.php with the necessary parameters
              
                header("Location:payment/index.php");

                exit();
            } else {
                echo "<script>alert('Error saving data: " . $conn->error . "');</script>";
            }
        } else {
            echo "Session portnumber is not set.";
        }
    } else {
        echo "start_date and/or end_date are not set in the URL parameters.";
    }
}
?>
