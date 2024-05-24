<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Sulit & Bagasan Dental Office</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src = "validation.js" defer></script>
    <link rel="stylesheet" type="text/css" href="css/style_signup.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>
<body>
<?php include '../header-footer/header.php' ?>
    <div class="wrapper">
    
        <div class="form">
            <form action="process-signup.php"  method="post" id="signup" novalidate>
                <h1 class="title">SIGN UP</h1>
                <hr>

                <p><label>Username:</label></br>
                    <input type="text" id ="username" name="username">
                </p>

                <p><label>Email Address:</label></br>
                    <input type="text" id ="email" name="email">
                </p>

            <label>Password:</label><br>
				<input type="password" id="password" name="password">
                <input id="checkbox-pass1" type="checkbox" onclick="togglePasswordVisibility('passwordInput')"/>
                <label for="checkbox-pass1"> Show Password</label><br>

			<label>Confirm Password:</label><br>
				<input type="password" id="password_confirmation" name="password_confirmation">
				<input id="checkbox-pass2" type="checkbox" onclick="togglePasswordVisibility('confirmPassword')"/>
                <label for="checkbox-pass2"> Show Password</label>

                <div class="button-container">
                <button>Sign up</button>
                </div>
				<p class = "account-login-label">Already have an account?</p>
				<a class="login-link" href="../login-forgot-password/login.php">Login</a>
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
</script>
    <?php include '../header-footer/footer.php' ?>
</body>
</html>
