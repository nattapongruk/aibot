<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/register-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&family=IBM+Plex+Sans+Thai&family=Prompt&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <img src="img/logo.png" alt="">
        <h2>Register</h2>
        <form id="registerForm" action="insert-register.php" method="post" onsubmit="return validateForm()">
            <p>Port number</p>
            <br><input type="text" name="portnumber" required class="inputbox"><br><br>
            <p>Password</p>
            <br><input type="password" name="password" required class="inputbox"><br><br>
            <p>ID card</p>
            <br><input type="text" name="idcard" required class="inputbox"><br><br>
            <p>Phone</p>
            <br><input type="text" name="phone" id="phone" required class="inputbox"><br><br>
        </form>
            <input type="button" value="Send OTP" onclick="sendOTP()" class="loginbut">
            <div id="otpInput" style="display: none;">
            <p>Enter OTP</p>
            <br><input type="text" id="otp" class="inputbox"><br><br>
            <input type="button" value="Verify OTP" onclick="verifyOTP()" class="loginbut">
        </div>
        <br><input type="submit" value="Register" class="loginbut" id="registerButton" disabled>
        <br>
        <a href="index.php">Login</a>
    </div>

    <script>
            function sendOTP() {
                var phone = document.getElementById('phone').value;
                fetch('http://localhost:3000/send-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ phone }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert('OTP ถูกส่งไปที่เบอร์โทรศัพท์ของคุณแล้ว');
                    document.getElementById('otpInput').style.display = 'block'; // Show OTP input field
                })
                .catch(error => {
                    console.error(error);
                    alert('เกิดข้อผิดพลาดในการส่ง OTP');
                });
            }

        function verifyOTP() {
            var pin = document.getElementById('otp').value; // Get the pin from your application logic

            fetch('http://localhost:3000/verify-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ pin }),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server after OTP verification
                console.log(data);
                // Example: If verification is successful, enable the register button
                if (data.status == 'success') {
                    //แก้ตรงนี้
                    console.log("SECCESS");
                }
            })
            .catch(error => {
                console.error(error);
                alert('An error occurred while verifying OTP');
            });
        }
    </script>
</body>
</html>