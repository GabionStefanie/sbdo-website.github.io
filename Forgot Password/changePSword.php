<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Change Password | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="style_OTP.css">
</head>
<body>
    <div class="wrapper">
        <div class="side">
            <img class="logo" src="D:\SKYE\IMAGES\gato.jpeg">
        </div>
        <div class="form">
            <form id="changePasswordForm" action="change_password.php" method="post">
                <h1 class="title">FORGOT PASSWORD</h1>
                <hr>
                <p>
                    <label>New Password</label><br>
                    <input type="password" name="password" required>
                </p>
                <p>
                    <label>Confirm Password</label><br>
                    <input type="password" name="confirm_password" required>
                </p>
                <div class="button-container">
                    <input type="submit" value="SUBMIT">
                </div>
                <div id="message" style="color:red;"></div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById("changePasswordForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission
            var form = this;
            var formData = new FormData(form);
            fetch("change_password.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var messageElement = document.getElementById("message");
                messageElement.textContent = data.message;

                if (data.success) {
                    messageElement.style.color = "green";
                    // Wait 3 seconds before redirecting to allow user to read the message
                    setTimeout(function() {
                        window.location.href = "Login/login.php";
                    }, 3000);
                } else {
                    messageElement.style.color = "red";
                    // Reload the page after displaying the error message
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                var messageElement = document.getElementById("message");
                messageElement.textContent = "An unexpected error occurred.";
                messageElement.style.color = "red";
                // Reload the page after displaying the error message
                setTimeout(function() {
                    location.reload();
                }, 3000);
            });
        });
    </script>
</body>
</html>
