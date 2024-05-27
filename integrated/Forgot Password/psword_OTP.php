<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="css/style_OTP.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>
<body>
<?php include '../header-footer/header.php' ?>
    <div class="wrapper">
        <div class="form">
            <form id="otpForm" action="backend/process_forgot.php" method="post" onsubmit="return verifyOTP(event)">
                <h1 class="title">ENTER OTP</h1>
                <hr>
                <p>
                    <label>Verification Code:</label><br>
                    <input type="text" name="otp" id="otp" required>
                </p>
                <p class="prompt">Please check your email address for the required OTP to verify your account.</p>
                <div id="error_message" style="color:red;"></div> <!-- Error message display -->
                <div class="button-container">
                    <input type="button" value="RESEND OTP" onclick="resendOTP()">
                    <input type="submit" value="VERIFY">
                </div>
                
            </form>
        </div>
    </div>
    <?php include '../header-footer/footer.php' ?>

    <script>
        function verifyOTP(event) {
            event.preventDefault(); // Prevent the form from submitting immediately
            var otp = document.getElementById('otp').value;
            console.log("OTP:", otp); // Debugging

            if (otp) {
                // Perform AJAX request to verify OTP
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "backend/process_forgot.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                // If OTP is correct, redirect to reset password page
                                window.location.href = 'changePSword.php';
                            } else {
                                // Handle errors or display messages
                                document.getElementById('error_message').textContent = response.message;
                            }
                        } else {
                            // Handle server error
                            document.getElementById('error_message').textContent = "Error: Failed to verify OTP.";
                        }
                    }
                };
                // Send the request with the OTP
                xhr.send("otp=" + encodeURIComponent(otp));
            } else {
                alert('Please enter the verification code.');
            }
        }

        function resendOTP() {
            var username = getUrlParameter('username'); // Retrieve username from URL
            console.log("Username:", username); // Debugging line
            if (username) {
                // Perform AJAX request to resend OTP
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "backend/process_forgot.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = xhr.responseText.trim(); // Remove leading/trailing whitespace
                            console.log("Response:", response); // Debugging line
                            if (response) {
                                showNotification(response); // Display notification message if not empty
                            } else {
                                console.log("Empty response received.");
                            }
                        } else {
                            console.error("Error:", xhr.statusText); // Log error message
                            alert("Error: " + xhr.statusText); // Display error message
                        }
                    }
                };
                xhr.send("resend=true&username=" + encodeURIComponent(username)); // Send the request with username
            } else {
                console.error("Username not found."); // Log error message
                alert("Error: Username not found.");
            }
        }

        function showNotification(message) {
            var notification = document.getElementById('notification');
            notification.textContent = message;
            notification.style.display = 'block';
            setTimeout(function() {
                notification.style.display = 'none';
            }, 5000); // Hide notification after 5 seconds
        }
        
        function getUrlParameter(parameter) {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(parameter);
        }
    </script>
</body>
</html>
