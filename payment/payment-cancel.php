<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Payment Cancel</title>
<meta charset="utf-8">

<!-- Stylesheet file -->
<link href="css/style.css" rel="stylesheet">
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
    <div class="status">
        <h1 class="error">Your transaction was canceled!</h1>
        
    </div>
    <p>Wait a minute</p>

    <script>
        setTimeout(function() {
            window.location.href = "../payment.php";
        }, 3000); // Redirect after 3 seconds (3000 milliseconds)
    </script>
</div>
</body>
</html>