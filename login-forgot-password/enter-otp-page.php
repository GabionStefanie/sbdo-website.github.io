<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Sulit & Bagasan Dental Office</title>
    <link rel="stylesheet" type="text/css" href="style_OTP.css">
    <style>
        <?php include '../header-footer/header-footer.css' ?>
    </style>
</head>
<body>
<?php include '../header-footer/header.php' ?>
    <div class="wrapper">
        <div class="form">
            <form action="backend/psword_OTP.php" method="post" onsubmit="return validateForm()">
                <h1 class="title">FORGOT PASSWORD</h1>
                <hr>
				
				<p><label>OTP</label></br>
                    <input type="text" name="OTP" required>
                </p>
				
				<p class = "Lorem_ipsum">Please check your email address for the 
				required OTP to verify your account.</p>
				
				<div class="button-container">
					<input type="button" value="RESEND OTP" onclick="resendOTP()">
                    <input type="submit" value="SUBMIT">
                </div>
	</form></div>
	</div>
    <?php include '../header-footer/footer.php' ?>
</body>
</html>
