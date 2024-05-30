<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Sulit & Bagasan Dental Office</title>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="addaccount-validation.js" defer></script>

    <link rel="stylesheet" type="text/css" href="css/admin-addaccount-css.css">
    <style>
        <?php include '../header-footer/header-footer.css'; ?>
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../header-footer/header.php'; ?>
        <div class="reports-title">Add Records</div>
        <div class="container-clients-services">
            <!-- <div class="undercolor"></div> -->
            <div style="display: flex; flex-direction: column;">
                <div class="clients-and-services-container">
                    <div class="clients-and-services">
                        <div class="clients-text">
                            <a href="admin-add[account]-page.php">
                                <p>ACCOUNT</p>
                            </a>
                        </div>
                    </div>
                    <div class="clients-and-services">
                        <div class="cancelled-text">
                            <a href="admin-add[schedule]-page.php">
                                <p>SCHEDULE</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="APPOINTMENT-FORM-container">
                    <form action="backend/process-addaccount.php" method="post" id="addaccount" novalidate style="text-align: left;">
                        <div class="input-group">
                            <div class="patient-information">Add Admin Accounts</div>
                            <div class="flex-group">
                                <label>Username</label>
                                <input type="text" id="username" name="username" placeholder="Username" required>
                            </div>


                            <div class="input-group flex-group">
                                <label>Email Address</label>
                                <input type="email" id="email" name="email" placeholder="email" required>
                            </div>

                            <div class="input-group flex-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password">

                                <input id="checkbox-pass1" type="checkbox" onclick="togglePasswordVisibility('password')" />
                                <label for="checkbox-pass1"> Show Password</label><br>
                            </div>

                            <div class="input-group flex-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation">

                                <div>
                                    <input class="password_toggle" id="checkbox-pass2" type="checkbox" onclick="togglePasswordVisibility('password_confirmation')" />
                                    <label for="checkbox-pass2"> Show Password</label><br>
                                </div>
                            </div>
                        <!-- </div> -->

                        <div class="button-group">
                            <button type="submit">SUBMIT</button>
                            <button type="reset">RESET INFO</button>
                        </div>
                    </form>
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
                </div>

            </div>
        </div>
    </div>
    </div>
    <?php include '../header-footer/footer.php'; ?>
    </div>
    <script>
    </script>

</body>

</html>