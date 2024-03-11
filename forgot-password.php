<!DOCTYPE html>


<html>

<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/forgot.css">
</head>

<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form>
            <p>Please enter your phone number to reset your password:</p>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" onkeyup="send()">
            <div id="result"></div>
            <br><br>
            <input type="button" value="Send OTP" onclick="sendOTP()" class="loginbut">
        </form>
        <div id="otpInput" style="display: none;">
            <p>Enter OTP</p>
            <br><input type="text" id="otp" class="inputbox"><br><br>
            <input type="button" value="Verify OTP" onclick="verifyOTP()" class="loginbut">

        </div>
        <script>
        function send() {
            request = new XMLHttpRequest();
            request.onreadystatechange = showResult;
            var phone = document.getElementById("phone").value;
            var url = "reset-password.php?phone=" + phone;
            request.open("GET", url, true);
            request.send();
        }

        function showResult() {
            if (request.readyState == 4) {
                if (request.status == 200)
                    document.getElementById("result").innerHTML = request.responseText;
            }
        }

        function sendOTP() {
            var phone = document.getElementById('phone').value;
            fetch('http://localhost:3000/send-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        phone
                    }),
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
            var phone = document.getElementById("phone").value;
            fetch('http://localhost:3000/verify-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        pin
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status == 'success') {
                        alert('ยืนยัน OTP สำเร็จ');
                        window.location.href = "update-password.php?phone="+phone;
                    }
                    if (data.code == 400) {
                        alert('OTP ผิด');
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