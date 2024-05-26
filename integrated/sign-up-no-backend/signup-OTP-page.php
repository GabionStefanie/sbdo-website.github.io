<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="css/style_OTP.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>

</head>

<body>

    <?php include '../header-footer/header.php' ?>

    <div class="wrapper">
        <div class="form">
            <form action="sign_up.php" method="post" onsubmit="return validateForm()">
                <h1 class="title">SIGN UP</h1>
                <hr>

                <p>
                    <label>OTP:</label><br>
                    <input type="text" name="otp">
                </p>

                <p class="email-label">Please check your email address for the
                    required OTP to verify your account.</p>

                <div class="button-container">
                    <input type="button" value="RESEND OTP" onclick="resendOTP()">
                    <input type="submit" value="SIGNUP">

                </div>
            </form>
        </div>

    </div>

    <script>
        function resendOTP() {
            // Here you can implement the logic to resend OTP
            alert("OTP resent successfully.");
        }

        function validateForm() {
            // Here you can implement client-side validation of the OTP field
            return true; // Return true to submit the form
        }
    </script>

    <?php include '../header-footer/footer.php' ?>


</body>

</html>