<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="style_OTP.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>
<body>
<?php include '../header-footer/header.php' ?>
    <div class="wrapper">
        <div class="form">
            <form action="change_password.php" method="post" onsubmit="return validateForm()">
                <h1 class="title">FORGOT PASSWORD</h1>
                <hr>
				
				<p><label>New Password</label></br>
                    <input type="text" name="OTP" required>
                </p>
				
				<p><label>Confirm Password</label></br>
                    <input type="text" name="OTP" required>
                </p>
				
				<div class="button-container">
                    <input type="submit" value="SUBMIT">
                </div>
	</form></div>
	</div>
    <?php include '../header-footer/footer.php' ?>
	<script>
        function validateForm() {
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
