<?php
session_start();
if (!isset($_SESSION["portnumber"])) {
    header("location: index.php");
    exit();
}
?>
<?php 

include('connect.php');

// Connect to the database

// Get the latest payment_id for the given portnumber
$portnumber = isset($_SESSION['portnumber']) ? $_SESSION['portnumber'] : null;

if ($portnumber) {
    $sql = "SELECT payment_id, total,start_date,end_date FROM payment WHERE portnumber = '$portnumber' ORDER BY payment_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();

        // Assign values to the variables
        $payment_id = $row['payment_id'];
        $total = $row['total'];
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];

        // Assign values to product details
        $productName = "Confirm Payment";
        $productID = $payment_id;
        $productPrice = $total;
        $currency = "usd";
       
    } else {
        echo "No payment found for the current portnumber.";
    }
} else {
    echo "Session portnumber is not set.";
}

// Close the database connection
$conn->close();




// Check if payment_id is passed through the URL





// Product Details  

// Include configuration file   



/* 
 * Stripe API configuration 
 * Remember to switch to your live publishable and secret key in production! 
 * See your keys here: https://dashboard.stripe.com/account/apikeys 
 */ 
define('STRIPE_API_KEY', 'sk_test_51OWOL0ETrVas1RYlzjkEZxwNt9ydqtUPjObbBM3HbAdJ7mycEq7QH3bZPuDmoVJtIHMWxwpbHpHIGXwb9nt2sucg00HkaMA4Aa'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51OWOL0ETrVas1RYljIuAPNKbtdQ5Bqln8OOAZ5iSszf6h8YHvKtaWHC9zBhqg1uYqD0CFLP3iRTRggEpZTN4uaZI006GZHcpg2'); 
define('STRIPE_SUCCESS_URL', 'https://localhost/aibot/payment/payment-success.php'); //Payment success URL 
define('STRIPE_CANCEL_URL', 'https://localhost/aibot/payment/payment-cancel.php'); //Payment cancel URL 
    
// Database configuration    
define('DB_HOST', 'localhost');   
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', '');   
define('DB_NAME', 'aibot'); 
 
?>