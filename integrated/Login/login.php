<?php include '../header-footer/header.php' ?>
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

    <div class="wrapper">
        <div class="form">
            <form action="process_login.php" method="post" onsubmit="return validateForm()">
                <h1 class="title">LOGIN</h1>
                <hr>

                <p><label>Username:</label></br>
                    <input type="text" name="user_Name">
                </p>

                <p><label>Password:</label><br>
                    <input type="password" id="passwordInput" name="password"><br>
                    <input id="checkbox-pass" type="checkbox" onclick="togglePasswordVisibility('passwordInput')" />
                    <label for="checkbox-pass"> Show Password</label><br>

                    <?php if (isset($_GET['error'])) { ?>
                    <p class="text" style = "color: red"> Error: <?php echo $_GET['error'] ?></p>

                <?php } ?>

                <p class="forgotPS_link"><a href="../Forgot Password/forgot_PS.php">Forgot password?</a></p>
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
            const loginValidation = new JustValidate("#loginForm", {
                rules: {
                    username_or_email: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    username_or_email: {
                        required: "Email or username is required",
                    },
                    password: {
                        required: "Password is required",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                },
                invalidFormCallback: function(errors) {
                    errors.forEach((field) => {
                        const fieldContainer = document.querySelector(field.selector).parentNode;
                        fieldContainer.classList.add('invalid');
                        const errorMessage = fieldContainer.querySelector(`[data-validate-field="${field.field}"]`);
                        if (errorMessage) {
                            errorMessage.textContent = field.errorMessage;
                        }
                    });
                }
            });

        }
    </script>
</body>

</html>