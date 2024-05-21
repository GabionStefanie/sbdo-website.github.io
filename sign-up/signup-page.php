<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="css/style_signup.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>
<body>
<?php include '../header-footer/header.php' ?>
    <div class="wrapper">
    
        <div class="form">
            <form action="backend/send-OTP.php" method="post" onsubmit="return validateForm()">
                <h1 class="title">SIGN UP</h1>
                <hr>

                <p><label>Username:</label></br>
                    <input type="text" name="user_Name">
                </p>

                <p><label>Email Address:</label></br>
                    <input type="text" name="email_address">
                </p>

            <label>Password:</label><br>
				<input type="password" id="passwordInput" name="password">
                <input id="checkbox-pass1" type="checkbox" onclick="togglePasswordVisibility('passwordInput')"/>
                <label for="checkbox-pass1"> Show Password</label><br>

			<label>Confirm Password:</label><br>
				<input type="password" id="confirmPassword" name="confirmPassword">
				<input id="checkbox-pass2" type="checkbox" onclick="togglePasswordVisibility('confirmPassword')"/>
                <label for="checkbox-pass2"> Show Password</label>

                <div class="button-container">
                    <input type="submit" value="SIGNUP">
                </div>
				<p class = "account-login-label">Already have an account?</p>
				<a class="login-link" "../login/login.php">Login</a>
            </form>
        </div>
        
    </div>
	<script>
	function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

	function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var errorDiv = document.getElementById("passwordError");

    if (password !== confirmPassword) {
        errorDiv.style.display = "block";
        return false; // Prevent form submission
    } else {
        errorDiv.style.display = "none";
        return true; // Allow form submission
    }
}
	</script>
    <?php include '../header-footer/footer.php' ?>
</body>
</html>
