<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body>
    <div class="wrapper">
        <div class="side">
            <img class="logo" src="D:\SKYE\IMAGES\gato.jpeg" alt="Logo">
        </div>
        <div class="form">
            <form id="forgotForm" action="process_forgot.php" method="post" onsubmit="return appendUsername(event)">
                <h1 class="title">FORGOT PASSWORD</h1>
                <hr>
                <p>
                    <label>Email address/Username:</label><br>
                    <input type="text" name="email_or_username" id="email_or_username" required>
                </p>
                <div class="button-container">
                    <input type="submit" value="SUBMIT">
                </div>
                <div id="error_message" style="color:red;"></div> <!-- Error message display -->
            </form>
        </div>
    </div>

    <script>
        function appendUsername(event) {
            event.preventDefault(); // Prevent the form from submitting immediately
            var username = document.getElementById('email_or_username').value;
            console.log("Username:", username); // Debugging

            if (username) {
                // Perform AJAX request to send OTP
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "process_forgot.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                // If OTP sent successfully, redirect to verification page
                                window.location.href = 'psword_OTP.php?username=' + encodeURIComponent(username);
                            } else {
                                // Handle errors or display messages
                                document.getElementById('error_message').textContent = response.message;
                            }
                        } else {
                            // Handle server error
                            document.getElementById('error_message').textContent = "Error: Failed to send OTP.";
                        }
                    }
                };
                // Send the request with the username
                xhr.send("email_or_username=" + encodeURIComponent(username));
            } else {
                alert('Please enter your email address or username.');
            }
        }
    </script>
</body>
</html>
