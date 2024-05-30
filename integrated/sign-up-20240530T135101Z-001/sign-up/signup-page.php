<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Sulit & Bagasan Dental Office</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="validation.js" defer></script>
    <link rel="stylesheet" type="text/css" href="style_signup.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>

<body>
    <?php include '../header-footer/header.php' ?>
    <div class="wrapper">

        <div class="form">
            <form action="process-signup.php" method="post" id="signup" novalidate>
                <h1 class="title">SIGN UP</h1>
                <hr>

                <p><label>Username:</label></br>
                    <input type="text" id="username" name="username">
                </p>


             
                <p><label>Name:</label></br>
                        <input type="text" id="fname" name="fname" placeholder="First Name"><br><br>
                        <input type="text" id="lname" name="lname" placeholder="Last Name">
                </p>
                    

                <p><label>Email Address:</label></br>
                    <input type="text" id="email" name="email">
                </p>


                <p><label>Phone:</label></br>
                    <input type="text" id="pnum" name="pnum">
                </p>

            
                <p><label>Gender:</label></br></p>
                <div class="input-group">
                    <select id="gender" name="gender">
                        <option value="" disabled selected>Select an option</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <label>Password:</label><br>
                <input type="password" id="password" name="password" >
                <input id="checkbox-pass1" type="checkbox" onclick="togglePasswordVisibility('password')" />
                <label for="checkbox-pass1"> Show Password</label><br>

                <label>Confirm Password:</label><br>
                <input type="password" id="password_confirmation" name="password_confirmation">
                <input id="checkbox-pass2" type="checkbox" onclick="togglePasswordVisibility('password_confirmation')" />
                <label for="checkbox-pass2"> Show Password</label><br>
                <div class="button-container">
                    <button>Sign up</button>
                </div>
                <p class="account-login-label">Already have an account?</p>
                <a class="login-link" href="../Login/login.php">Login</a>
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