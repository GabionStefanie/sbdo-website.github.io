<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="css/style_OTP.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>

<body>
    <?php include '../header-footer/header.php' ?>
    <div class="wrapper">
        <div class="form">
            <form id="changePasswordForm" action="backend/change_password.php" method="post">
                <h1 class="title">FORGOT PASSWORD</h1>
                <hr>
                <!-- <p> -->
                    <label>New Password</label><br>
                    <input type="password" name="password" id="password" required>

                <!-- </p> -->
                <input id="checkbox-pass1" type="checkbox" onclick="togglePasswordVisibility('password')" />
                <label for="checkbox-pass1"> Show Password</label><br>
                <!-- <p> -->
                    <label>Confirm Password</label><br>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                <!-- </p> -->
                <input id="checkbox-pass2" type="checkbox" onclick="togglePasswordVisibility('confirm_password')" />
                <label for="checkbox-pass2"> Show Password</label>
                <div id="message" style="color:red;"></div>
                <div class="button-container">
                    <input type="submit" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>
    <?php include '../header-footer/footer.php' ?>
    <script>
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

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
                            window.location.href = "../Login/login.php";
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