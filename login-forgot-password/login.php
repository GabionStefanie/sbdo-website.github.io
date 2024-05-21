<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="css/style_login.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>

<body>
    <?php include '../header-footer/header.php' ?>
    <div class="wrapper">
        <div class="form">
            <form action="signup_OTP.php" method="post" onsubmit="return validateForm()">
                <h1 class="title">LOGIN</h1>
                <hr>

                <p><label>Username:</label></br>
                    <input type="text" name="user_Name">
                </p>

                <p><label>Password:</label><br></p>
                <input type="password" id="passwordInput" name="password"><br>
                <input id="checkbox-pass" type="checkbox" onclick="togglePasswordVisibility('passwordInput')" />
                <label for="checkbox-pass"> Show Password</label><br>
                <p class="forgotPS_link"><a href="forgot-password-page.php">Forgot password?</a></p>
                </p>

                <div class="button-container">
                    <input type="submit" value="LOGIN">
                </div>
                <p class="text">Don't have an account?</p>
                <p class="Signup_link"><a href="../sign-up/signup-page.php">Signup</a></p>

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
    </script>
</body>

</html>