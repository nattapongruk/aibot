<?php
// Include configuration file  
require_once 'config.php'; 

// Include database connection file  
include_once 'dbConnect.php'; 

$payment_id = $statusMsg = ''; 
$status = 'error'; 

// Check whether stripe checkout session is not empty 
if(!empty($_GET['session_id'])){ 
    $session_id = $_GET['session_id']; 
    
    // Fetch transaction data from the database if already exists 
    $sqlQ = "SELECT * FROM transactions WHERE stripe_checkout_session_id = ?"; 
    $stmt = $db->prepare($sqlQ);  
    
    // Check if the prepare statement was successful
    if ($stmt !== false) {
        $stmt->bind_param("s", $db_session_id); 
        $db_session_id = $session_id; 
        $stmt->execute(); 
        $result = $stmt->get_result(); 

        if($result->num_rows > 0){ 
            // Transaction details 
            $transData = $result->fetch_assoc(); 
            $portnumber = $transData['portnumber']; 
            $payment_id = $transData['id']; 
            $transactionID = $transData['txn_id']; 
            $paidAmount = $transData['paid_amount']; 
            $paidCurrency = $transData['paid_amount_currency']; 
            $payment_status = $transData['payment_status']; 
            
            $customer_name = $transData['customer_name']; 
            $customer_email = $transData['customer_email']; 
            
            $status = 'success'; 
            $statusMsg = 'Your Payment has been Successful!'; 

            $start_date ;
            $end_date ; 
            
          

            
        } else { 
            // Include the Stripe PHP library 
            require_once 'stripe-php/init.php'; 
            
            // Set API key 
            $stripe = new \Stripe\StripeClient(STRIPE_API_KEY); 
            
            // Fetch the Checkout Session to display the JSON result on the success page 
            try { 
                $checkout_session = $stripe->checkout->sessions->retrieve($session_id); 
            } catch(Exception $e) {  
                $api_error = $e->getMessage();  
            } 
            
            if(empty($api_error) && $checkout_session){ 
                // Get customer details 
                $customer_details = $checkout_session->customer_details; 

                // Retrieve the details of a PaymentIntent 
                try { 
                    $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent); 
                } catch (\Stripe\Exception\ApiErrorException $e) { 
                    $api_error = $e->getMessage(); 
                } 
                 
                if(empty($api_error) && $paymentIntent){ 
                    // Check whether the payment was successful 
                    if(!empty($paymentIntent) && $paymentIntent->status == 'succeeded'){ 
                        // Transaction details  
                        $transactionID = $paymentIntent->id; 
                        $paidAmount = $paymentIntent->amount; 
                        $paidAmount = ($paidAmount); 
                        $paidCurrency = $paymentIntent->currency; 
                        $payment_status = $paymentIntent->status; 
                        
                        // Customer info 
                        $customer_name = $customer_email = ''; 
                        if(!empty($customer_details)){ 
                            $customer_name = !empty($customer_details->name)?$customer_details->name:''; 
                            $customer_email = !empty($customer_details->email)?$customer_details->email:''; 
                        } 
                        
                        // Check if any transaction data is exists already with the same TXN ID 
                        $sqlQ = "SELECT id FROM transactions WHERE txn_id = ?"; 
                        $stmt = $db->prepare($sqlQ);  
                        $stmt->bind_param("s", $transactionID); 
                        $stmt->execute(); 
                        $result = $stmt->get_result(); 
                        $prevRow = $result->fetch_assoc(); 
                        
                        if(!empty($prevRow)){ 
                            $payment_id = $prevRow['id']; 
                        } else { 
                            // Insert transaction data into the database 
                            $sqlQ = "INSERT INTO transactions (portnumber, payment_id, customer_name, customer_email, item_name, item_number, item_price, item_price_currency, paid_amount, paid_amount_currency, txn_id, payment_status, stripe_checkout_session_id, created, modified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

                            $stmt = $db->prepare($sqlQ);
                            
                            // Assuming portnumber, payment_id, item_number, and item_price are strings, and paid_amount is a double/float
                            $stmt->bind_param("ssssssdssssss", $portnumber, $payment_id, $customer_name, $customer_email, $productName, $productID, $productPrice, $currency, $paidAmount, $paidCurrency, $transactionID, $payment_status, $session_id);
                            
                            $insert = $stmt->execute();
                            if($insert){ 
                                $payment_id = $stmt->insert_id; 
                            } 
                        } 
                        
                        $status = 'success'; 
                        $statusMsg = 'Your Payment has been Successful!'; 
                       
                        
                    
                        $sqlUpdate = "UPDATE payment SET status = 'paid' WHERE payment_id = ?";
                        $stmtUpdate = $db->prepare($sqlUpdate);
                        $stmtUpdate->bind_param("i", $productID);
                        $stmtUpdate->execute();
                        
                        // อัพเดตตาราง 'history'
                        $sqlUpdateHistory = "UPDATE history SET stats = 1 WHERE portnumber = ? AND date BETWEEN ? AND ?";
                        $stmtUpdateHistory = $db->prepare($sqlUpdateHistory);
                        $stmtUpdateHistory->bind_param("iss", $portnumber, $start_date, $end_date);
                        $stmtUpdateHistory->execute();
                    } else { 
                        $statusMsg = "Transaction has been failed!"; 
                    } 
                } else { 
                    $statusMsg = "Unable to fetch the transaction details! $api_error";  
                } 
            } else { 
                $statusMsg = "Invalid Transaction! $api_error";  
            } 
        } 
    } else { 
        $statusMsg = "Prepare statement failed!";  
    }
} else { 
    $statusMsg = "Invalid Request!"; 
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: "Prompt", sans-serif;
            margin: 0px;
            box-sizing:border-box ;
            padding: 0;
            text-decoration: none; 
            list-style-type: none;
        }
        body{
            background:#0C0F14 ;
        }
        h1.success {
            color: white;
        }

        /* Error message style */
        h1.error {
            color: red;
        }

        /* Additional styling for the container */
        .container {
            
            max-width: 600px;
            margin: 0 auto;
            padding: 24px;
            text-align: center;
           
            border-radius: 5px;
           
            margin-top: 20rem;
        }

        /* Optional: Additional styling for paragraphs */
        p {
        color: white;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php if(!empty($payment_id)){ ?>
        <h1 class="<?php echo $status; ?>">Payment Success!</h1>
        <p>Wait a minute</p>
        <script>
            setTimeout(function() {
                window.location.href = "../payment.php";
            }, 3000); // Redirect after 3 seconds (3000 milliseconds)
        </script> 
    <?php } else { ?>
        <h1 class="error">Your Payment has been failed!</h1>
        <p class="error"><?php echo $statusMsg; ?></p>
    <?php } ?>   
    </div>
   
</body>
</html>


